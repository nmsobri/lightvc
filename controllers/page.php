<?php

class PageController extends AppController
{

    public function actionView( $pageName = 'home' )
    {
        if( strpos( $pageName, '../' ) !== false )
        {
            throw new LvcException( 'File Not Found: ' . $sourceFile );
        }

        $this->loadView( 'page/' . rtrim( $pageName, '/' ) );
    }
}

?>