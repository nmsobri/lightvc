<?php
/**
 * The base class that all other PageControllers should extend. Depending on the setup,
 * you might want an AppController to extend this one, and then have all your controllers
 * extend your AppController.
 * */
class LvcPageController
{


    /**
     * Params is typically a combination of:
     *     _GET (stored in params['get'])
     *     _POST (stored in params['post'])
     * @var array
     * */
    protected $params = array();


    /**
     * Reference to post data (i.e. $this->params['post'])
     * @var array
     * */
    protected $post = array();


    /**
     * Reference to get data (i.e. $this->params['get'])
     * @var array
     * */
    protected $get = array();


    /**
     * Controller Name (e.g. controller_name, not ControllerNameController)
     * @var string
     * */
    protected $controllerName = null;


    /**
     * Controller Subpath. (e.g., if filesystem has /controllers/reports/report.php,
     * value = "reports")
     * @var string
     * */
    protected $controllerSubPath = null;


    /**
     * Action Name (e.g. action_name, not actionActionName)
     * @var string
     * */
    protected $actionName = null;


    /**
     * Variables we will pass to the view.
     * @var array()
     * */
    protected $viewVars = array();


    /**
     * Have we loaded the view yet?
     * @var boolean
     * */
    protected $hasLoadedView = false;


    /**
     * Specifies whether or not to load the default view for the action. If the
     * action should not render any view, set it to false in the sub controller.
     * @var boolean
     * */
    protected $loadDefaultView = true;


    /**
     * Don't set this yourself. It's used internally by parent controller /
     * actions to determine whether or not to use the layout value in
     * $layoutOverride rather than in $layout when requesting a sub action.
     * @var string
     * @see setLayoutOverride(), $layoutOverride
     * */
    protected $useLayoutOverride = false;


    /**
     * Don't set this yourself. It's used internally by parent controller /
     * actions to determine which layout to use when requesting a sub action.
     * @var string
     * @see setLayoutOverride(), $useLayoutOverride, requestAction()
     * */
    protected $layoutOverride = null;


    /**
     * Set this in your controller to use a layout.
     * @var string
     * */
    protected $layout = null;


    /**
     * An array of view variables specifically for the layout file.
     * @var array
     * */
    protected $layoutVars = array();


    /**
     * Constructor method
     */
    public function __construct()
    {

    }


    /**
     * Set the parameters of the controller
     * Actions will get their parameters through params['get']
     * Actions can access the post data as needed
     *
     * @param array $params an array of [paramName] => [paramValue] pairs
     * @return void
     * */
    public function setControllerParams( &$params )
    {
        $this->params = $params;
        #Make a reference to the form data so we can get to it easier
        if( isset( $this->params['post'] ) )
        {
            $this->post = & $this->params['post'];
        }
        if( isset( $this->params['get'] ) )
        {
            $this->get = & $this->params['get'];
        }
    }


    /**
     * Don't call this yourself. It's used internally when creating new
     * controllers so the controllers are aware of their name without
     * needing any help from a user setting a member variable or from some
     * reflector class
     *
     * @param $controllerName
     * @return void
     */
    public function setControllerName( $controllerName )
    {
        $this->controllerName = $controllerName;
    }


    /**
     * Don't call this yourself. It's used internally when creating new
     * controllers so the controllers are aware of their sub path without
     * needing any help from a user setting a member variable or from some
     * reflector class
     *
     * @param $controllerSubPath
     * @return void
     * */
    public function setControllerSubPath( $controllerSubPath )
    {
        $this->controllerSubPath = $controllerSubPath;
    }


    /**
     * Set a variable for the view to use
     *
     * @param string $varName variable name to make available in the view
     * @param string $value value of the variable
     * @return void
     * */
    public function setVar( $varName, $value )
    {
        $this->viewVars[$varName] = $value;
    }


    /**
     * Set variables for the view in masses
     *
     * @param mixed $varArray an array of [varName] => [value] pairs
     * @return void
     * */
    public function setVars( &$varArray )
    {
        $this->viewVars = $varArray + $this->viewVars;
    }


    /**
     * Get the current value for a view variable
     *
     * @param string $varName
     * @return mixed
     * */
    public function getVar( $varName )
    {
        return ( $this->viewVars[$varName] ) ? $this->viewVars[$varName] : null;
    }


    /**
     * Set a variable for the layout view
     *
     * @param string $varName variable name to make available in the view
     * @param string $value value of the variable
     * @return void
     * */
    public function setLayoutVar( $varName, $value )
    {
        $this->layoutVars[$varName] = $value;
    }


    /**
     * Get the current value for a layout variable
     *
     * @param string $varName
     * @return mixed

     * */
    public function getLayoutVar( $varName )
    {
        if( isset( $this->layoutVars[$varName] ) )
        {
            return $this->layoutVars[$varName];
        }
        else
        {
            return null;
        }
    }


    /**
     * Set the layout to use for the view
     *
     * @param string $layout
     * @return void
     * */
    public function setLayout( $layout )
    {
        $this->layout = $layout;
    }


    /**
     * Get layout name
     *
     * @return string
     * */
    public function getLayout()
    {
        return $this->layout;
    }


    /**
     * Don't call this yourself. It's used internally when requesting sub
     * actions in order to avoid loading the layout multiple times.
     *
     * @param string $layout
     * @return void
     * @see $useLayoutOverride, $layoutOverride
     * @author Anthony Bush
     * */
    public function setLayoutOverride( $layout )
    {
        $this->useLayoutOverride = true;
        $this->layoutOverride = $layout;
    }


    /**
     * Set whether or not to load the default view for the action
     *
     * @return void
     */
    public function disableDefaultView()
    {
        $this->loadDefaultView = false;
    }


    /**
     * Set whether or not to load the default layout for the action
     * Typically use with ajax request, you want to load view only but
     * not the layout
     *
     * @return void
     */
    public function disableDefaultLayout()
    {
        $this->layout = null;
    }


    /**
     * Returns the action name of this controller
     *
     * @return string
     * @author lzhang
     * */
    public function getActionName()
    {
        return $this->actionName;
    }


    /**
     * Determine whether or not the the controller has the specified action.
     *
     * @param string $actionName the action name to check for.
     * @return boolean
     * */
    public function hasAction( $actionName )
    {
        $actionName = LvcConfig::getActionFunctionName( $actionName );
        return method_exists( $this, $actionName );
    }


    /**
     * Runs the requested action and returns the output from it.
     * Typically called by the FrontController.
     *
     * @param string $actionName the action name to run.
     * @param array $actionParams the parameters to pass to the action.
     * @return string output from running the action.
     * */
    public function getActionOutput( $actionName, &$actionParams = array() )
    {
        ob_start();
        $this->runAction( $actionName, $actionParams );
        return ob_get_clean();
    }


    /**
     * Runs the requested action and outputs its results
     * Typically called by the FrontController
     *
     * @param string $actionName the action name to run.
     * @param array $actionParams the parameters to pass to the action.
     * @return void
     * @throws LvcException
     * */
    public function runAction( $actionName, &$actionParams = array() )
    {
        $this->actionName = $actionName;
        $func = LvcConfig::getActionFunctionName( $actionName );

        if( method_exists( $this, $func ) )
        {
            $this->before();
            $this->run( $actionParams, $func );

            if( !$this->hasLoadedView )
            {
                $view = $this->getControllerPath() . '/' . $actionName;
                $this->loadView( $view );
            }

            $this->after();
        }
        else
        {
            $this->actionNotFound( $actionName, $func );
        }
    }


    /**
     * @param $actionParams
     * @param $func
     * @return array
     * @throws LvcException
     */
    public function run( &$actionParams, $func )
    {
        if( LvcConfig::getSendActionParamsAsArray() )
        {
            $this->$func( $actionParams );
        }
        else
        {
            $actionParams = $this->setupParams( $actionParams, $func );
            @call_user_func_array( array( $this, $func ), $actionParams );
        }
    }


    /**
     * @param $actionName
     * @param $func
     * @throws LvcActionException
     */
    public function actionNotFound( $actionName, $func )
    {
        $controllerPath = LvcConfig::getControllerPaths();
        $controllerPath = $controllerPath[0];
        $controllerName = $this->getControllerName();
        $controllerSuffix = LvcConfig::getControllerSuffix();
        $className = LvcConfig::getControllerClassName($controllerName );
        $fileName = $controllerPath . $controllerName . $controllerSuffix;

        $msg = sprintf('Unable to load action "%s"%s',$actionName,PHP_EOL);
        $msg .= sprintf('Controller is "%s"%s', $controllerName, PHP_EOL );
        $msg .= sprintf('Action is "%s"%s', $actionName, PHP_EOL );
        $msg .= sprintf('Please write "%s" method inside class', $func);
        $msg .= sprintf(' %s in file %s%s', $className , $fileName, PHP_EOL);

        throw new LvcActionException( nl2br( $msg ) );
    }


    /**
     * @param $actionParams
     * @param $func
     * @return array
     */
    public function setupParams( &$actionParams, $func )
    {
        $paramCount = count( $actionParams );
        $actionParams = @array_values( $actionParams);
        $reflectionMethod = new ReflectionMethod( $this, $func );
        $reflectionParams = $reflectionMethod->getParameters();
        $totalParams = $reflectionMethod->getNumberOfParameters();
        $optionalParamCount = $this->getOptionalParamCount( $reflectionParams );
        $actionParams = $this->mergeParams( $actionParams, $reflectionParams );

        if( $paramCount + $optionalParamCount < $totalParams )
        {
            $this->insufficientParameter( $totalParams, $paramCount,
                $optionalParamCount
            );
        }

        return $actionParams;
    }


    /**
     * @param ReflectionParameter $reflectionParams
     * @return int
     */
    public function getOptionalParamCount( $reflectionParams )
    {
        $count = 0;
        foreach( $reflectionParams as $key => $args )
        {
            if( $args->isOptional() ) $count++;
        }
        return $count;
    }


    /**
     * @param $actionParams
     * @param $reflectionParams
     * @return mixed
     */
    public function mergeParams( $actionParams, $reflectionParams )
    {
        foreach( $reflectionParams as $key => $args )
        {
            if( $actionParams[$key] == null )
            {
                if( $args->isOptional() )
                {
                    $actionParams[$key] = $args->getDefaultValue();
                }
            }
        }
        return $actionParams;
    }


    /**
     * @param $totalParams
     * @param $param_count
     * @param $optionalParamCount
     * @throws LvcException
     */
    public function insufficientParameter( $totalParams, $param_count,
        $optionalParamCount )
    {
        $msg = sprintf( 'Insufficient method parameter' );
        $msg .= sprintf( ' ( Needed %s, Optional %s, Supplied %s )%s',
            $totalParams, $optionalParamCount,$param_count, PHP_EOL
        );

        throw new LvcException( nl2br( $msg ) );
    }


    /**
     * Load the requested controller view.
     *
     * For example, you can load another view in your controller with:
     *     $this->loadView( $this->getControllerPath() . '/some_other_action' );
     *
     * Or some other controller with:
     *     $this->loadView('some_other_controller/some_other_action');
     *
     * Remember, the view for your action will be rendered automatically.
     *
     * @param string $controllerViewName 'controller_name/action_name' format.
     * @return void
     * @throws LvcException
     * */
    protected function loadView( $controllerViewName )
    {
        $view = LvcConfig::getControllerView( $controllerViewName,
            $this->viewVars
        );

        if( is_null( $view ) )
        {
            $this->ControllerViewNotFound( $controllerViewName );
        }

        $view->setController( $this );
        $this->renderView( $view );
        $this->hasLoadedView = true;
    }


    /**
     * @param $controllerViewName
     * @throws LvcViewException
     */
    protected function ControllerViewNotFound( $controllerViewName )
    {
        $controllerViewPath = LvcConfig::getControllerViewPaths();
        $controllerViewPath = $controllerViewPath[0];
        $viewFile = $controllerViewPath . $controllerViewName . LvcConfig::getControllerViewSuffix();

        $msg = sprintf( 'Unable to load controller view "%s"%s',
            $controllerViewName, PHP_EOL
        );

        $msg .= sprintf( 'Controller is "%s"%s', $this->controllerName, PHP_EOL);
        $msg .= sprintf( 'Action is "%s"%s', $this->actionName, PHP_EOL );
        $msg .= sprintf( 'Please create file %s%s' ,$viewFile, PHP_EOL);

        throw new LvcViewException( nl2br( $msg ) );
    }


    /**
     * @param $view
     */
    protected function renderView( $view )
    {
        $viewContents =  $this->loadDefaultView ? $view->getOutput() : null;

        if( $this->useLayoutOverride ) $this->layout = $this->layoutOverride;

        if( !empty( $this->layout ) )
        {
            $this->layoutVars[LvcConfig::getLayoutContentVarName()] = $viewContents;

            $layoutView = LvcConfig::getLayoutView( $this->layout,
                $this->layoutVars
            );

            if( is_null( $layoutView ) ) $this->ControllerLayoutNotFound();

            $layoutView->setController( $this );
            $layoutView->output();
        }
        else
        {
            echo $viewContents;
        }
    }


    /**
     * @throws LvcViewException
     */
    protected function ControllerLayoutNotFound()
    {
        $layoutViewPath = LvcConfig::getLayoutViewPaths();
        $layoutViewPath = $layoutViewPath[0];
        $layoutFile =  $layoutViewPath . $this->layout . LvcConfig::getLayoutViewSuffix();

        $msg = sprintf( 'Unable to load layout "%s" for controller "%s"%s',
            $this->layout, $this->controllerName, PHP_EOL
        );

        $msg .= sprintf('Controller is "%s"%s', $this->controllerName,
            PHP_EOL
        );

        $msg .= sprintf('Action is "%s"%s', $this->actionName, PHP_EOL );
        $msg .= sprintf('Please create file %s', $layoutFile );

        throw new LvcViewException( nl2br( $msg ) );
    }


    /**
     * Redirect to the specified url. NOTE that this function stops execution.
     * @param string $url URL to redirect to.
     * @return void
     * @author Anthony Bush
     * */
    protected function redirect( $url )
    {
        header( 'Location: ' . $url );
        $this->afterAction();
        exit();
    }


    /**
     * wrapper for beforeAction, so child class automatically call it
     * parent::beforeAction without explicitly call it in child class
     */
    public function before()
    {
        $parent = get_parent_class( $this );
        $parent::beforeAction();
        $this->beforeAction();
    }


    /**
     * wrapper for afterAction, so child class automatically call it
     * parent::afterAction without explicitly call it in child class
     */
    public function after()
    {
        $parent = get_parent_class( $this );
        $parent::afterAction();
        $this->afterAction();
    }


    /**
     * Execute code before every action.
     * Override this in sub classes
     *
     * @return void
     * */
    protected function beforeAction()
    {

    }


    /**
     * Execute code after every action.
     * Override this in sub classes
     *
     * @return void
     * */
    protected function afterAction()
    {

    }


    /**
     * Use this inside a controller action to get the output from another
     * controller's action. By default, the layout functionality will be
     * disabled for this "sub" action.
     *
     * Example Usage:
     *  $enrollmentVerifyBox = $this->requestAction('enrollment_verify');
     *
     * @param string $actionName name of action to invoke.
     * @param array $actionParams parameters to invoke the action with.
     * @param string $controllerName optional controller name. Current controller will be used if not specified.
     * @param array $controllerParams optional controller params. Current controller params will be passed on if not specified.
     * @param string $layout optional layout to force for the sub action.
     * @return string output from requested controller's action.
     * @throws LvcException
     * */
    protected function requestAction( $actionName, $actionParams = array(),
        $controllerName = null, $controllerParams = null, $layout = null
    )
    {
        if( empty( $controllerName ) ) $controllerName = $this->controllerName;

        if( is_null( $controllerParams ) ) $controllerParams = $this->params;

        $controller = LvcConfig::getController( $controllerName );

        if( is_null( $controller ) )
        {
            $this->controllerNotFound( $actionName, $controllerName );
        }

        $controller->setControllerParams( $controllerParams );
        $controller->setLayoutOverride( $layout );
        return $controller->getActionOutput( $actionName, $actionParams );
    }


    /**
     * Get the controller name. Mostly used internally...
     * @return string controller name
     * */
    public function getControllerName()
    {
        return $this->controllerName;
    }


    /**
     * Get the controller sub path. Mostly used internally...
     * @return string controller sub path
     * */
    public function getControllerSubPath()
    {
        return $this->controllerSubPath;
    }


    /**
     * Get the controller path (sub path + controller name). Mostly used internally...
     * @return string controller path
     * */
    public function getControllerPath()
    {
        return $this->controllerSubPath . $this->controllerName;
    }


    /**
     * Get the controller params. Mostly used internally...
     * @return array controller params
     * @author Anthony Bush
     * */
    public function getControllerParams()
    {
        return $this->params;
    }


    /**
     * @param $actionName
     * @param $controllerName
     * @throws LvcControllerException
     */
    protected function controllerNotFound( $actionName, $controllerName )
    {
        $controllerPath = LvcConfig::getControllerPaths();
        $controllerPath = $controllerPath[0];
        $class = LvcConfig::getControllerClassName( $controllerName );
        $file = $controllerPath . $controllerName . LvcConfig::getControllerSuffix();

        $msg = sprintf( 'Unable to load controller "%s"%s', $controllerName,PHP_EOL );
        $msg .= sprintf( 'Controller is "%s"%s', $controllerName,PHP_EOL );
        $msg .= sprintf( 'Action is "%s"%s', $actionName,PHP_EOL );
        $msg .= sprintf( 'Please create class "%s" in file %s%s', $class, $file, PHP_EOL );

        throw new LvcControllerException( nl2br( $msg ) );
    }


}