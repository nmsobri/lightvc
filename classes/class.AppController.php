<?php

class AppController extends Lvc_PageController
{

    protected $layout = 'main';



    protected function beforeAction()
    {
        $this->registry->set( 'session', new Session );
        $this->registry->set( 'cookie', new Cookie );
        $this->requireJsInHead( 'jquery.js' );
    }



    public function requireCss( $cssFile )
    {
        $this->layoutVars[ 'requiredCss' ][ ] = $cssFile;
    }



    public function requireJs( $jsFile )
    {
        $this->layoutVars[ 'requiredJs' ][ ] = $jsFile;
    }



    public function requireJsInHead( $jsFile )
    {
        $this->layoutVars[ 'requiredJsInHead' ][ ] = $jsFile;
    }



    protected function loadPageNotFound()
    {
        $this->sendHttpStatusHeader( '404' );
        $this->loadView( 'error/404' );
    }



    public function sendHttpStatusHeader( $code )
    {
        include_once('class.HttpStatusCode.php');
        $statusCode = new HttpStatusCode( $code );
        header( 'HTTP 1.1 ' . $statusCode->getCode() . ' ' . $statusCode->getDefinition() );
        return $statusCode;
    }



    public function redirectToAction( $actionName )
    {
        $this->redirect( WWW_BASE_PATH . $this->getControllerPath() . '/' . $actionName );
    }



}




?>