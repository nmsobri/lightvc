<?php
/**
 * Abstract away main code from index.php
 * @author slier
 */
class LvcDispatcher
{

    /**
     * Reference to LvcRouter instance
     * @var array
     * */
    protected $routers = array();


    /**
     * Construct a dispatcher
     *
     * @param LvcRouter $router
     */
    public function __construct( LvcRouter $router = null )
    {
        if( !is_null( $router ) )
        {
            $this->routers[] = $router;
        }
    }


    /**
     * Add a router to give it a chance to route the request.
     * The first router to return true to the call of
     * {@link Lvc_RouterInterface::route()} call will be the last
     * router called, so add them in the order you want them to run
     *
     * @return void
     * @param LvcRouter $router
     */
    public function addRouter( LvcRouter $router )
    {
        $this->routers[] = $router;
    }


    /**
     * Start the framework
     *
     * @return void
     * @author slier
     */
    public function go()
    {
        #prevent multiple request by browser, causing inconsistent in session data
        if( trim( $_SERVER['REQUEST_URI'], '/' ) != 'favicon.ico' )
        {
            try
            {
                $request = new LvcHttpRequest();
                $front_controller = new LvcFrontController();

                foreach( $this->routers as $router )
                {
                    $front_controller->addRouter( $router );
                }

                $front_controller->processRequest( $request );
            }
            catch( LvcControllerException $e )
            {
                $e->handleException( $request );
            }
            catch( LvcActionException $e )
            {
                $e->handleException( $request );
            }
            catch( LvcViewException $e )
            {
                $e->handleException( $request );
            }
            catch( LvcException $e )
            {
                $e->handleException( $request );
            }
            catch( Exception $e )
            {
                #Some other error, output "technical difficulties" message to user
                error_log( $e->getMessage() );
            }
        }
    }


}

