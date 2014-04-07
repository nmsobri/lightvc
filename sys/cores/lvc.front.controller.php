<?php

/**
 * FrontController takes a Request object and invokes the appropriate controller
 * and action.
 * */
class LvcFrontController
{

    protected $routers = array();


    /**
     * Add a router to give it a chance to route the request.
     * The first router to return true to the {@link route()} call
     * will be the last router called, so add them in the order you want them
     * to run
     *
     * @param LvcRouter $router
     * @return void
     */
    public function addRouter( LvcRouter $router )
    {
        $this->routers[] = $router;
    }


    /**
     * Processes the request data by instantiating the appropriate controller and
     * running the appropriate action.
     *
     * @param LvcRequest $request
     * @return void
     * @throws LvcException
     */
    public function processRequest( LvcRequest $request )
    {
        #Give routers a chance to (re)route the request
        foreach( $this->routers as $router )
        {
            if( $router->route( $request)) break;
        }

        $controllerName = $this->getControllerName( $request );
        $actionName = $this->getActionName( $request );
        $controller  = $this->getController( $request );

        if( is_null( $controller ) )
        {
            $this->controllerNotFound( $controllerName, $actionName );
        }

        $controller->setControllerParams( $request->getControllerParams() );
        $controller->runAction( $actionName, $request->getActionParams() );
    }


    /**
     * Get controller name
     *
     * @param LvcRequest $request
     * @return string
     */
    public function getControllerName(LvcRequest $request)
    {
        $controllerName = $request->getControllerName();

        if( empty( $controllerName ) )
        {
            $controllerName = LvcConfig::getDefaultControllerName();

            $actionParams = $request->getActionParams() +
                LvcConfig::getDefaultControllerActionParams();

            $request->setActionParams( $actionParams );
        }

        return $controllerName;
    }


    /**
     * Get action name
     *
     * @param LvcRequest $request
     * @return array
     */
    public function getActionName( LvcRequest $request )
    {
        $controllerName = $request->getControllerName();

        if( empty( $controllerName ) )
        {
            $actionName = LvcConfig::getDefaultControllerActionName();
        }
        else
        {
            $actionName = $request->getActionName();
            if( empty( $actionName ) )
            {
                $actionName = LvcConfig::getDefaultActionName();
            }
        }
        return $actionName ;
    }


    /**
     * Get controller instance
     *
     * @param LvcRequest $request
     * @return array
     */
    public function getController( LvcRequest $request )
    {
        $controllerSubPath = $request->getControllerSubPath();

        if( !empty( $controllerSubPath ) )
        {
            $controllerSubPath .= '/';
        }

        $controllerName = $this->getControllerName($request);

        if( $request->getController() == null )
        {
            $controller = LvcConfig::getController( $controllerName,
                $controllerSubPath
            );
        }
        else
        {
            $controller = $request->getController();
        }
        return $controller;
    }


    /**
     * Controller not found
     *
     * @param $controllerName
     * @param $actionName
     * @throws LvcControllerException
     */
    public function controllerNotFound( $controllerName, $actionName )
    {
        $controllerPath = LvcConfig::getControllerPaths();
        $controllerPath = $controllerPath[0];

        $msg = sprintf( 'Unable to load controller "%s" %s', $controllerName,
            PHP_EOL
        );

        $msg .= sprintf( 'Controller is "%s" %s', $controllerName, PHP_EOL );

        $msg .= sprintf( 'Action is "%s" %s', $actionName, PHP_EOL );

        $msg .= sprintf('Please create class %s in file %s %s %s',
            LvcConfig::getControllerClassName( $controllerName),
            $controllerPath, $controllerName,
            LvcConfig::getControllerSuffix()
        );

        throw new LvcControllerException( nl2br( $msg ) );
    }


}

