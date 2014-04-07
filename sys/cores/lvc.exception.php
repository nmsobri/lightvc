<?php


/**
 * Lvc classes throw this type of exception.
 * @package lightvc
 * @author Anthony Bush
 * @since 2007-04-20
 * */
class LvcException extends Exception
{

    public function handleException( LvcRequest $r )
    {
        try
        {
            /* Get a request for the 404 error page. */
            $request = new LvcRequest();
            $request->setControllerName( 'error' );
            $request->setActionName( 'view' );

            $controller = LvcConfig::getController(
                $request->getControllerName()
            );

            $request->setController( $controller );
            $error_msg = DEVELOPMENT ? ( $this->getMessage() . $r->getAdditionalErrorInfo() ) : null;

            /* load view using preset layout in AppController */
            /* Get a new front controller without any routers, and have it process our handmade request. */
            $request->setActionParams( array(
                    'error' => '404', 'msg' => $error_msg
                )
            );

            $fc = new LvcFrontController();
            $fc->processRequest( $request );
            error_log( $this->getMessage() );
        }
        catch( Exception $e )
        {
            echo $e->getMessage();
        }
    }


}



class LvcControllerException extends LvcException
{

}



class LvcActionException extends LvcException
{

}



class LvcViewException extends LvcException
{

}
