<?php

class ErrorController extends AppController
{

    public function actionView( $errorNum = '404', $msg = null )
    {
        if ( is_array( $errorNum ) )
        {
            $errorNum = $errorNum[ 'error' ];
        }
        else
        {
            if ( strpos( $errorNum, '../' ) !== false )
            {
                $errorNum   = '404';
            }
        }
        include_once('./classes/class.HttpStatusCode.php');
        $statusCode = new HttpStatusCode( $errorNum );
        $this->setLayoutVar( 'pageTitle', $statusCode->getDefinition() );
        $this->setVar( 'error_msg', $msg == null ? $statusCode->getDefinition() : $msg );
        $this->loadView( $this->getControllerName() . '/' . $statusCode->getCode() );
    }
}

?>