<?php

/**
 * LightVC - A lightweight view-controller framework.
 * http://lightvc.org/
 *
 * You provide your own model/ORM. We recommend Cough <http://coughphp.com>.
 *
 * The purpose of this framework is to provide just a "view-controller"
 * setup without all the other junk. Ideally, the classes from other frameworks
 * should be reusable but instead they are mostly coupled with their frameworks.
 * It's up to you to go get those classes if you need them, or provide your own.
 *
 * Additionally, we've decoupled it from any sort of Model so that you can use
 * the one you already know and love. And if you don't know one, now is a great
 * time to check out CoughPHP. Other ORMs can be found at:
 *
 * http://en.wikipedia.org/wiki/List_of_object-relational_mapping_software#PHP
 *
 * By providing just the VC, we increase the reusability of not only the
 * framework itself, but non-framework components as well.
 *
 * The framework is fast. Currently the speed of this framework is unmatched by
 * any other PHP framework available today.
 *
 * You get to use the classes you've already been using without worrying about
 * naming conflicts or inefficiencies from loading both your classes and the
 * classes from some other framework.
 *
 * LightVC aims to be easier to use, more configurable, and light in footprint.
 * */


/**
 * Configuration class for the LVC suite of classes.
 * @package lightvc
 * @author Anthony Bush
 **/
class LvcConfig
{

    /**
     * Controller path
     *
     * @var array
     */
    protected static $controllerPaths = array();


    /**
     * Controller suffix eg:_controller.php
     *
     * @var string
     */
    protected static $controllerSuffix = '.php';


    /**
     * Controller view path
     *
     * @var array
     */
    protected static $controllerViewPaths = array();


    /**
     * Controller view suffix eg:.tpl.php
     *
     * @var string
     */
    protected static $controllerViewSuffix = '.php';


    /**
     * Layout view path
     *
     * @var array
     */
    protected static $layoutViewPaths = array();


    /**
     * Layout view suffix eg:.tpl.php
     *
     * @var string
     */
    protected static $layoutViewSuffix = '.php';


    /**
     * Element view path
     *
     * @var array
     */
    protected static $elementViewPaths = array();


    /**
     * Element view suffix eg:.tpl.php
     *
     * @var string
     */
    protected static $elementViewSuffix = '.php';


    /**
     * View class name eg:AppView
     *
     * @var string
     */
    protected static $viewClassName = 'LvcView';


    /**
     * Variable name for layout content eg:content_for_layout
     *
     * @var string
     */
    protected static $layoutContentVarName = 'layoutContent';


    /**
     * Sets whether or not to send action params as an array or as arguments
     * to the function.
     *
     * true => action($params)
     * false => action($param1, $param2, $param3, ...)
     * @var boolean
     * */
    protected static $sendActionParamsAsArray = false;


    /**
     * The controller name to use if no controller name can be gathered
     * from the request.
     *
     * @var string
     * */
    protected static $defaultControllerName = 'page';


    /**
     * The action name to call on the defaultControllerName if no controller
     * name can be gathered from the request.
     *
     * @var string
     * */
    protected static $defaultControllerActionName = 'view';


    /**
     * The action params to use when calling defaultControllerActionName if
     * no controller name can be gathered from the request.
     *
     * @var string
     * */
    protected static $defaultControllerActionParams = array(
        'pageName' => 'home'
    );


    /**
     * The default action name to call on a controller if the controller name
     * was gathered from the request, but the action name could not be.
     *
     * @var string
     * */
    protected static $defaultActionName = 'index';


    ###########################################################################
    ##############################Setter Method################################
    ###########################################################################
    /**
     * Set controller path
     *
     * @param string $controllerPath
     */
    public static function setControllerPath( $controllerPath )
    {
        self::$controllerPaths[] = $controllerPath;
    }


    /**
     * Set controller suffix
     *
     * @param string $controllerSuffix
     */
    public static function setControllerSuffix( $controllerSuffix )
    {
        self::$controllerSuffix = $controllerSuffix;
    }


    /**
     * Set controller view path
     *
     * @param string $controllerViewPath
     */
    public static function setControllerViewPath( $controllerViewPath )
    {
        self::$controllerViewPaths[] = $controllerViewPath;
    }


    /**
     * Set controller view suffix
     *
     * @param string $controllerViewSuffix
     */
    public static function setControllerViewSuffix( $controllerViewSuffix )
    {
        self::$controllerViewSuffix = $controllerViewSuffix;
    }


    /**
     * Set layout view path
     *
     * @param string $layoutViewPath
     */
    public static function setLayoutViewPath( $layoutViewPath )
    {
        self::$layoutViewPaths[] = $layoutViewPath;
    }


    /**
     * Set layout view suffix
     *
     * @param string $layoutViewSuffix
     */
    public static function setLayoutViewSuffix( $layoutViewSuffix )
    {
        self::$layoutViewSuffix = $layoutViewSuffix;
    }


    /**
     * Set element view path
     *
     * @param string $elementViewPath
     */
    public static function setElementViewPath( $elementViewPath )
    {
        self::$elementViewPaths[] = $elementViewPath;
    }


    /**
     * Set element view suffix
     *
     * @param string $elementViewSuffix
     */
    public static function setElementViewSuffix( $elementViewSuffix )
    {
        self::$elementViewSuffix = $elementViewSuffix;
    }


    /**
     * Set layout content variable name
     *
     * @param string $layoutContentVarName
     */
    public static function setLayoutContentVarName( $layoutContentVarName )
    {
        self::$layoutContentVarName = $layoutContentVarName;
    }


    /**
     * Set flag whether to send action params as array or single variable
     *
     * @param bool $bool
     */
    public static function setSendActionParamsAsArray( $bool )
    {
        self::$sendActionParamsAsArray = $bool;
    }


    /**
     * Set default controller name
     *
     * @param string $controllerName
     */
    public static function setDefaultControllerName( $controllerName )
    {
        self::$defaultControllerName = $controllerName;
    }


    /**
     * Set default controller action name
     *
     * @param string $controllerActionName
     */
    public static function setDefaultControllerActionName(
        $controllerActionName
    )
    {
        self::$defaultControllerActionName = $controllerActionName;
    }


    /**
     * Set default controller action params
     *
     * @param array $controllerActionParams
     */
    public static function setDefaultControllerActionParams(
        $controllerActionParams
    )
    {
        self::$defaultControllerActionParams = $controllerActionParams;
    }


    /**
     * Set default action name
     *
     * @param string $actionName
     */
    public static function setDefaultActionName( $actionName )
    {
        self::$defaultActionName = $actionName;
    }


    /**
     * Set view class name
     *
     * @param string $viewClassName
     */
    public static function setViewClassName( $viewClassName )
    {
        self::$viewClassName = $viewClassName;
    }


    ###########################################################################
    ##############################Getter Method################################
    ###########################################################################
    /**
     * Get controller path
     *
     * @return array
     */
    public static function getControllerPaths()
    {
        return self::$controllerPaths;
    }


    /**
     * Get controller suffix
     *
     * @return string
     */
    public static function getControllerSuffix()
    {
        return self::$controllerSuffix;
    }


    /**
     * Get controller view path
     *
     * @return array
     */
    public static function getControllerViewPaths()
    {
        return self::$controllerViewPaths;
    }


    /**
     * Get controller view suffix
     *
     * @return string
     */
    public static function getControllerViewSuffix()
    {
        return self::$controllerViewSuffix;
    }


    /**
     * Get layout view path
     *
     * @return array
     */
    public static function getLayoutViewPaths()
    {
        return self::$layoutViewPaths;
    }


    /**
     * Get layout view suffix
     *
     * @return string
     */
    public static function getLayoutViewSuffix()
    {
        return self::$layoutViewSuffix;
    }


    /**
     * Get element view path
     *
     * @return array
     */
    public static function getElementViewPaths()
    {
        return self::$elementViewPaths;
    }


    /**
     * Get element view suffix
     *
     * @return string
     */
    public static function getElementViewSuffix()
    {
        return self::$elementViewSuffix;
    }


    /**
     * Get layout content variable name
     *
     * @return string
     */
    public static function getLayoutContentVarName()
    {
        return self::$layoutContentVarName;
    }


    /**
     * Get flag on how to send action params
     *
     * @return bool
     */
    public static function getSendActionParamsAsArray()
    {
        return self::$sendActionParamsAsArray;
    }


    /**
     * Get default controller name
     *
     * @return string
     */
    public static function getDefaultControllerName()
    {
        return self::$defaultControllerName;
    }


    /**
     * Get default controller action name
     *
     * @return string
     */
    public static function getDefaultControllerActionName()
    {
        return self::$defaultControllerActionName;
    }


    /**
     * Get default controller action params
     *
     * @return string
     */
    public static function getDefaultControllerActionParams()
    {
        return self::$defaultControllerActionParams;
    }


    /**
     * Get default action name
     *
     * @return string
     */
    public static function getDefaultActionName()
    {
        return self::$defaultActionName;
    }


    /**
     * @return string
     */
    public static function getViewClassName()
    {
        return self::$viewClassName;
    }


    /**
     * Get controller
     *
     * @param string $controllerName
     * @param string $controllerSubPath
     * @return null|PageController
     */
    public static function getController( $controllerName,
        $controllerSubPath = null
    )
    {
        foreach( self::$controllerPaths as $controllerPath )
        {
            $path = $controllerPath . $controllerSubPath;
            $file = $path . $controllerName . self::$controllerSuffix;

            if( !file_exists( $file ) ) continue;

            include_once( $file );
            $controllerClass = self::getControllerClassName( $controllerName );
            $controller = new $controllerClass();
            $controller->setControllerName( $controllerName );
            $controller->setControllerSubPath( $controllerSubPath );
            return $controller;
        }
        return null;
    }


    /**
     * Get controller class name
     *
     * @param string $name
     * @return string
     */
    public static function getControllerClassName( $name )
    {
        $words = str_replace( array( '_', '/' ), ' ', $name );
        return str_replace( ' ', '', ucwords( $words ) ) . 'Controller';
    }


    /**
     * Get action function name
     *
     * @param string $name
     * @return string
     */
    public static function getActionFunctionName( $name )
    {
        $words = str_replace( '_', ' ', $name );
        return 'action' . str_replace( ' ', '', ucwords( $words ) );
    }


    /**
     * Get controller view
     *
     * @param string $view
     * @param array $data
     * @return null|LvcView
     */
    public static function getControllerView( $view, &$data = array() )
    {
        return self::getView( $view, $data, self::$controllerViewPaths,
            self::$controllerViewSuffix
        );
    }


    /**
     * Get element view
     *
     * @param $element
     * @param array $data
     * @return null|LvcView
     */
    public static function getElementView( $element, &$data = array() )
    {
        return self::getView( $element, $data, self::$elementViewPaths,
            self::$elementViewSuffix
        );
    }


    /**
     * Get layout view
     *
     * @param string $layout
     * @param array $data
     * @return null|LvcView
     */
    public static function getLayoutView( $layout, &$data = array() )
    {
        return self::getView( $layout, $data, self::$layoutViewPaths,
            self::$layoutViewSuffix
        );
    }


    /**
     * Get view
     *
     * @param string $viewName
     * @param array $data
     * @param array $paths
     * @param string $suffix
     * @return null|LvcView
     *
     * @see getControllerView(), getElementView(), getLayoutView(),
     *      setViewClassName()
     *
     * As an Lvc developer, you'll probably want to use getControllerView,
     * getElementView, or getLayoutView.
     *
     * Example usage:
     *
     *     #Pass the whole file name and leave off the last parameters
     *     getView('/full/path/to/file/file.php', $data);
     *
     *     #Pass the view name and specify the paths to scan and
     *      the suffix to append.
     *     getView('file', $data, array('/full/path/to/file/'), '.php');
     */
    public static function getView( $viewName, &$data = array(),
        &$paths = array(), $suffix = null
    )
    {
        foreach( $paths as $path )
        {
            $file = $path . $viewName . $suffix;
            if( file_exists( $file ) )
            {
                $viewClassName = self::getViewClassName();
                return new $viewClassName( $file, $data );
            }
        }
        return null;
    }


    /**
     * Dump config variable
     */
    public static function dump()
    {
        echo '<pre>';

        echo '<b>Controller Paths:</b>' . PHP_EOL;
        print_r( self::$controllerPaths );
        echo '<b>Controller Suffix:</b> ' . self::$controllerSuffix;
        echo PHP_EOL . PHP_EOL;

        echo '<b>Layout View Paths:</b>' . PHP_EOL;
        print_r( self::$layoutViewPaths );
        echo '<b>Layout View Suffix:</b> ' . self::$layoutViewSuffix;
        echo PHP_EOL . PHP_EOL;

        echo '<b>Controller View Paths:</b>' . PHP_EOL;
        print_r( self::$controllerViewPaths );
        echo '<b>Controller View Suffix:</b> ' . self::$controllerViewSuffix;
        echo PHP_EOL . PHP_EOL;

        echo '<b>Element View Paths:</b>' . PHP_EOL;
        print_r( self::$elementViewPaths );
        echo '<b>Element View Suffix:</b> ' . self::$elementViewSuffix;

        echo '</pre>';
    }


}



/**
 * A request provides information about what controller and action to run and
 * what parameters to run them with.
 **/
class LvcRequest
{

    /**
     * Controller instance
     *
     * @var LvcPageController
     */
    protected $controller = null;


    /**
     * Controller name
     *
     * @var string
     */
    protected $controllerName = null;


    /**
     * Controller sub path
     *
     * @var string
     */
    protected $controllerSubPath = null;


    /**
     * Controller params( GET, POST )
     *
     * @var array
     */
    protected $controllerParams = array();


    /**
     * Action name
     *
     * @var string
     */
    protected $actionName = null;


    /**
     *Action params
     *
     * @var array
     */
    protected $actionParams = array();


    ###########################################################################
    ##############################Setter Method################################
    ###########################################################################
    /**
     * Set controller instance
     *
     * @param $controller
     */
    public function setController( $controller )
    {
        $this->controller = $controller;
    }


    /**
     * Set controller name
     *
     * @param $controllerName
     */
    public function setControllerName( $controllerName )
    {
        $this->controllerName = trim( $controllerName );
    }


    /**
     * Set controller sub path
     *
     * @param $controllerSubPath
     */
    public function setControllerSubPath( $controllerSubPath )
    {
        $this->controllerSubPath = trim( $controllerSubPath );
    }



    /**
     * Set controller params
     *
     * @param $controllerParams
     */
    public function setControllerParams( &$controllerParams )
    {
        $this->controllerParams = $controllerParams;
    }


    /**
     * Set action name
     *
     * @param $actionName
     */
    public function setActionName( $actionName )
    {
        $this->actionName = trim( $actionName );
    }


    /**
     * Set action params
     *
     * @param $actionParams
     */
    public function setActionParams( $actionParams )
    {
        $this->actionParams = $actionParams;
    }


    ###########################################################################
    ##############################Getter Method################################
    ###########################################################################
    /**
     * Get controller instance
     *
     * @return null|LvcPageController
     */
    public function getController()
    {
        return $this->controller;
    }


    /**
     * Get controller name
     *
     * @return string
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }


    /**
     * Get controller sub path
     *
     * @return string
     */
    public function getControllerSubPath()
    {
        return $this->controllerSubPath;
    }


    /**
     * Get controller params
     *
     * @return array
     */
    public function &getControllerParams()
    {
        return $this->controllerParams;
    }


    /**
     * Get action name
     *
     * @return string
     */
    public function getActionName()
    {
        return $this->actionName;
    }


    /**
     * Get action params
     *
     * @return array
     */
    public function &getActionParams()
    {
        return $this->actionParams;
    }


    /**
     * Override this in sub request objects to have custom error messages
     * appended to LightVC messages.For example, when HTTP Requests error,
     * it might be useful to put the requested URL in the error log with the
     * "Unable to load controller" message.
     *
     * @return string
     */
    public function getAdditionalErrorInfo()
    {
        return null;
    }


}



/**
 * An HTTP request contains parameters from the GET, POST, PUT, and
 * DELETE arena.
 * */
class LvcHttpRequest extends LvcRequest
{

    /**
     * Hold URL, GET, POST data
     *
     * @var array
     */
    protected $params = array();


    public function __construct()
    {
        $params = array();

        $params['uri'] = $this->getRequestUri();
        $params['get'] = &$_GET;
        $params['post'] = &$_POST;

        #Set params that will be used by routers
        $this->setRequestParams( $params );

        #Make Http request data available to controller
        $this->setControllerParams( $params );
    }


    /**
     * Set http request data
     *
     * @param $params
     */
    public function setRequestParams( &$params )
    {
        $this->params = $params;
    }


    /**
     * Get http request data
     *
     * @return array
     */
    public function &getRequestParams()
    {
        return $this->params;
    }


    /**
     * Get request uri
     *
     * @return null|string
     */
    public function getRequestUri()
    {
        if( !isset( $_SERVER['REQUEST_URI'] ) ) return null;

        $requestUri = $_SERVER['REQUEST_URI'];

        $base_dir = trim( APP_PATH, '/' );

        if( $base_dir != '' ) #subfolder
        {
            $uri = preg_replace( "#/$base_dir(/.+)#", '\1', $requestUri );
            $uri = trim( $uri, '/');
            return ( $uri  == $base_dir ) ? null : $uri;
        }

        return $requestUri = trim( $requestUri, '/' );
    }


    /**
     * Provides additional error information that might be useful when
     * debugging errors.
     *
     * @return string
     **/
    public function getAdditionalErrorInfo()
    {
        $url = @$_SERVER['REQUEST_URI'];
        if( $url )
        {
            $msg = sprintf('Request Url was %s%s', $url, PHP_EOL );
            return nl2br( $msg );
        }
        else
        {
            return parent::getAdditionalErrorInfo();
        }
    }


}



/**
 * A router interface must at least provide a route() function that takes a
 * request object.
 **/
interface LvcRouter
{

    /**
     * Set the appropriate controller, action, and action parameters to use on
     * the request object and return true. If no appropriate controller info
     * can be found, return false.
     *
     * @param mixed $request A request object to route.
     * @return boolean
     **/
    public function route( $request );
}



/**
 * Routes a request using only GET data.
 * You can change the default keys for controller and action detection using
 * {@link setControllerKey()} and {@link setActionKey()} respectively.
 * @package lightvc
 * */
class LvcGetRouter implements LvcRouter
{

    /**
     * Controller key name
     *
     * @var string
     */
    protected $controllerKey = 'controller';


    /**
     * Action key name
     *
     * @var string
     */
    protected $actionKey = 'action';


    /**
     * Empty constructor
     */
    public function __construct()
    {

    }


    /**
     * Set controller key name
     *
     * @param string $controllerKey
     */
    public function setControllerKey( $controllerKey )
    {
        $this->controllerKey = $controllerKey;
    }


    /**
     * Set action key name
     *
     * @param string $actionKey
     */
    public function setActionKey( $actionKey )
    {
        $this->actionKey = $actionKey;
    }


    /**
     * Attempts to routes a request using the GET data.
     *
     * @param LvcHttpRequest $request A request object to route.
     * @return boolean
     **/
    public function route( $request )
    {
        $params = $request->getRequestParams();

        if( !isset( $params['get'][$this->controllerKey] ) ) return false;

        $actionName = isset( $params['get'][$this->actionKey] ) ?
            $params['get'][$this->actionKey] :
            LvcConfig::getDefaultActionName();

        $request->setControllerName( $params['get'][$this->controllerKey] );
        $request->setActionName( $actionName );
        $request->setActionParams( $this->getUriSegment( $params ) );
        return true;
    }


    /**
     * Get uri segment excluding controller and action segment
     *
     * @param $params
     * @return array
     */
    public function getUriSegment( $params )
    {
        $actionParams = array();

        $parts = explode( '&', substr( $params['uri'], strpos(
            $params['uri'], '?' ) + 1 )
        );

        foreach( $parts as $part )
        {
            list( $segKey, $segVal ) = explode( '=', $part );

            if( $segKey != $this->controllerKey && $segKey != $this->actionKey )
            {
                $actionParams[$segKey] = $segVal;
            }
        }

        return $actionParams;
    }


}



/**
 * Attempts to route a request using the value for the 'uri' param, which
 * should be set by the web server. Any additional "directories" are
 * used as parameters for the action (using numeric indexes). Any extra GET
 * data is also amended to the action parameters.
 * If you need the numeric indexes to map to specific parameter names, use
 * the {@link Lvc_ParamOrderRewriteRouter} instead.
 * */
class LvcRewriteRouter implements LvcRouter
{

    /**
     * Empty contructor
     */
    public function __construct()
    {

    }


    /**
     * Attempts to route a request using the value for the 'uri' param, which
     * should be set by the web server. Any additional "directories" are
     * used as parameters for the action (using numeric indexes). Any extra GET
     * data is also amended to the action parameters.
     *
     * @param LvcHttpRequest $request
     * @return boolean
     * @author Anthony Bush
     * */
    public function route( $request )
    {
        $params = $request->getRequestParams();
        $url = explode( '/', $params['uri'] );
        $count = count( $url );

        if( !isset( $params['uri'] ) || !$count > 0 ) return false;

        $request->setControllerName( $url[0] );
        $actionParams = array();

        if( $count > 1 )
        {
            $request->setActionName( $url[1] );
            if( $count > 2 )
            {
                for( $i = 2; $i < $count; $i++ )
                {
                    if( !empty( $url[$i] ) )
                    {
                        $actionParams[] = $url[$i];
                    }
                }
            }
        }

        $request->setActionParams( $actionParams );
        return true;
    }


}



/**
 * Routes a request using REQUEST_URI data and regular expressions specified by
 * the LightVC user.Specify routes using {@link addRoute()}.
 * */
class LvcRegexRewriteRouter implements LvcRouter
{

    protected $routes = array();


    /**
     * Construct the router and set all routes at once.
     * See {@link setRoutes()} for more info.
     *
     * @param null|array $routes
     */
    public function __construct( &$routes = null )
    {
        if( !is_null( $routes ) )
        {
            $this->setRoutes( $routes );
        }
    }


    /**
     * Specify a regular expression and how it should be routed.
     * Example:
     *      $regexRouter->addRoute('#^wee/([^/]+)/?$#', array(
     *         'controller' => 'hello_world',
     *         'action' => 'index',
     *         'action_params' => array(1, 'constant_value')
     *     ));
     *
     * Would map "wee/anything" and "wee/anything/" to:
     *     HelloWorldController::actionIndex('anything', 'constant_value');
     *
     * But would not map "wee/anything/anything_else".
     *
     * The format of the $parsingInfo parameter is as follows:
     *
     *     'controller' => a hard coded controller name or an integer specifying
     *      which match in the regex to use.
     *
     *      'action' => a hard coded action name or an integer specifying which
     *      match in the regex to use.
     *
     *      'action_params' => array(
     *          a hard coded action value or an integer specifying which match
     *          in the regex to use,repeat above line as needed,
     *      ),
     *
     *      'additional_params' => a hard coded integer specifying which match
     *      in the regex to use for additional parameters.These will be exploded
     *      by "/" and added to the action params.
     *
     *      Or
     *
     *      'redirect' => a replacement string that will be used to redirect to
     *      You can use parts of the original url mapped into the new url(Eg:Ids)
     *      See http://www.php.net/manual/en/function.preg-replace.php's
     *      documentation for the replacement parameter.
     *
     * You can specify as much or as little as you want in the $parsingInfo.
     * That is, if you don't specify the controller name or action name, then
     * the defaults will be used by the Lvc_FrontController.
     *
     * @param string $regex regular expression to match the REQUEST_URI with.
     * @param array $parsingInfo
     * @return void
     */
    public function addRoute( $regex, $parsingInfo = array() )
    {
        $this->routes[$regex] = $parsingInfo;
    }


    /**
     * Set all routes at once. Useful if you want to specify routes in a
     * config file and then pass them to this router all at once.
     * See {@link addRoute()} for routing specifications.
     *
     * @param array $routes
     * @return void
     */
    public function setRoutes( &$routes )
    {
        $this->routes = $routes;
    }


    /**
     * Routes like {@link Lvc_RewriteRouter} does, with the additional check to
     * routes for specifying custom routes based on regular expressions.
     *
     * @param LvcHttpRequest $request A request object to route.
     * @return boolean
     * */
    public function route( $request )
    {

        $params = $request->getRequestParams();

        if( isset( $params['uri'] ) )
        {
            $matches = array();
            $url = $params['uri'];

            foreach( $this->routes as $regex => $parsingInfo )
            {
                if( preg_match( $regex, $url, $matches ) )
                {
                    $this->parseRedirect( $parsingInfo, $regex, $url);

                    $this->parseController( $request, $parsingInfo, $matches );

                    $this->parseControllerSubPath( $request, $parsingInfo,
                        $matches
                    );

                    $this->parseAction( $request, $parsingInfo, $matches );

                    $actionParams = $this->parseActionParams( $parsingInfo,
                            $matches
                        ) +

                        $this->parseAdditionalActionParams( $parsingInfo,
                            $matches
                        );

                    $request->setActionParams( $actionParams );

                    return true;
                }
            }
        }
        return false;
    }


    /**
     * Parse redirect information
     *
     * @param $parsingInfo
     * @param $regex
     * @param $url
     * @return void
     */
    public function parseRedirect( $parsingInfo, $regex, $url )
    {
        if( isset( $parsingInfo['redirect'] ) )
        {
            $redirectUrl = preg_replace( $regex, $parsingInfo['redirect'],
                $url
            );

            #Output any custom/additional headers
            if( isset( $parsingInfo['headers'] ) )
            {
                if( is_array( $parsingInfo['headers'] ) )
                {
                    foreach( $parsingInfo['headers'] as $header )
                    {
                        header( $header );
                    }
                }
                else
                {
                    header( $parsingInfo['headers'] );
                }
            }
            header( 'Location: ' . $redirectUrl );
            exit();
        }
    }


    /**
     * Parse controller infromation
     *
     * @param $request
     * @param $parsingInfo
     * @param $matches
     * @return void
     */
    public function parseController( $request, $parsingInfo, $matches )
    {
        if( isset( $parsingInfo['controller'] ) )
        {
            if( is_int( $parsingInfo['controller'] ) )
            {
                $request->setControllerName(
                    @$matches[$parsingInfo['controller']]
                );
            }
            else
            {
                $request->setControllerName( $parsingInfo['controller'] );
            }
        }
    }


    /**
     * Parse sub controller subpath information
     *
     * @param $request
     * @param $parsingInfo
     * @param $matches
     * @return void
     */
    public function parseControllerSubPath( $request, $parsingInfo, $matches )
    {
        if( isset( $parsingInfo['sub_path'] ) )
        {
            if( is_int( $parsingInfo['sub_path'] ) )
            {
                $request->setControllerSubPath(
                    @$matches[$parsingInfo['sub_path']]
                );
            }
            else
            {
                $request->setControllerSubPath( $parsingInfo['sub_path'] );
            }
        }
    }


    /**
     * Parse controller action information
     *
     * @param $request
     * @param $parsingInfo
     * @param $matches
     * @return void
     */
    public function parseAction( $request, $parsingInfo, $matches )
    {
        if( isset( $parsingInfo['action'] ) )
        {
            if( is_int( $parsingInfo['action'] ) )
            {
                $request->setActionName( @$matches[$parsingInfo['action']] );
            }
            else
            {
                $request->setActionName( $parsingInfo['action'] );
            }
        }
    }


    /**
     * Parse controller action parameters
     *
     * @param $parsingInfo
     * @param $matches
     * @return array
     */
    public function parseActionParams( $parsingInfo, $matches)
    {
        $params = array();

        if( isset( $parsingInfo['action_params'] ) )
        {
            foreach( $parsingInfo['action_params'] as $key => $value )
            {
                if( is_int( $value ) )
                {
                    if( isset( $matches[$value] ) && $matches[$value] != '' )
                    {
                        $params[$key] = $matches[$value];
                    }
                    else
                    {
                        $params[$key] = null;
                    }
                }
                else
                {
                    $params[$key] = $value;
                }
            }
        }
        return $params;
    }


    /**
     * Parse controller action additional parameters
     *
     * @param $parsingInfo
     * @param $matches
     * @return array
     */
    public function parseAdditionalActionParams( $parsingInfo, $matches )
    {
        $params = array();
        $matchesParsing = $matches[$parsingInfo['additional_params']];

        if( isset( $parsingInfo['additional_params'] ) )
        {
            if( is_int( $parsingInfo['additional_params'] ) )
            {
                if( isset( $matchesParsing )  && $matchesParsing !='')
                {
                    $params = explode( '/', $matchesParsing );
                }
            }
        }
        return $params;
    }


}



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
     * to run.
     *
     * @return void
     * */
    public function addRouter( LvcRouter $router )
    {
        $this->routers[] = $router;
    }


    /**
     * Processes the request data by instantiating the appropriate controller and
     * running the appropriate action.
     *
     * @params LvcRequest $request
     * @return void
     * @throws LvcException
     * */
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



/**
 * The base class that all other PageControllers should extend. Depending on the setup,
 * you might want an AppController to extend this one, and then have all your controllers
 * extend your AppController.
 * */
class LvcPageController
{

    /**
     * Hold instance of registry
     */
    protected $registry = null;


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
     * @return void
     */
    public function __construct()
    {
        $this->registry = LvcRegistry::getInstance();
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
     * @return void
     * */
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
     * @param $varArray an array of [varName] => [value] pairs
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
     * @param boolean $status
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
     * @param boolean $status
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
     * @param $reflectionParams
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
     * @param $optionalParamCount
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
     * @param $reflection_method
     * @param $param_count
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
     * @param $viewContents
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



/**
 * A View can be outputted or have its output returned (i.e. it's renderable).
 * It can not be executed.
 * $inc = new LvcView('foo.php', array());
 * $inc->output();
 * $output = $inc->getOutput();
 * */
class LvcView
{

    /**
     * Full path to file name to be included.
     * @var string
     * */
    protected $fileName;


    /**
     * Data to be exposed to the view template file.
     * @var array
     * */
    protected $data;


    /**
     * A reference to the parent controller
     * @var Lvc_Controller
     * */
    protected $controller;


    /**
     * Construct a view to be rendered.
     * @param string $fileName Full path to file name of the view template file.
     * @param array $data an array of [varName] => [value] pairs. Each varName will be made available to the view.
     * @return void
     * @author Anthony Bush
     * */
    public function __construct( $fileName, &$data )
    {
        $this->fileName = $fileName;
        $this->data = $data;
    }


    /**
     * Output the view (aka render).
     * @return void
     * @author Anthony Bush
     * */
    public function output()
    {
        extract( $this->data, EXTR_SKIP );
        include( $this->fileName );
    }


    /**
     * Return the output of the view.
     * @return string output of view
     * @author Anthony Bush
     * */
    public function getOutput()
    {
        ob_start();
        $this->output();
        return ob_get_clean();
    }


    /**
     * Render a sub element from within a view.
     * Views are not allowed to have business logic, but they can call upon
     * other generic, shared, views, called elements here.
     * @param string $elementName name of element to render
     * @param array $data optional data to pass to the element.
     * @return void
     * @throws LvcException
     * @author Anthony Bush
     * */
    protected function renderElement( $elementName, $data = array() )
    {
        $view = LvcConfig::getElementView( $elementName, $data );

        if( !is_null( $view ) )
        {
            $view->setController( $this->controller );
            $view->output();
        }
        else
        {
            $elementViewPath = LvcConfig::getElementViewPaths();
            $elementViewSuffix = LvcConfig::getElementViewSuffix();
            $elementViewPath = $elementViewPath[0];

            $msg = sprintf( 'Unable to render element "%s"%s', $elementName,
                PHP_EOL
            );

            $msg .= sprintf('Please create file %s',
                $elementViewPath . $elementName . $elementViewSuffix
            );

            #cannot throw Lvc_ViewException, because it will give an error
            #regarding cannot load layout instead of element due to element
            #reside inside layout
            trigger_error( $msg, E_USER_WARNING );
        }
    }


    /**
     * Set the controller when constructing a view if you want
     * {@link setLayoutVar()} to be callable from a view.
     * @return void
     * @author Anthony Bush
     * @since 2007-05-17
     * */
    public function setController( $controller )
    {
        $this->controller = $controller;
    }


    /**
     * Set a variable for the layout file.  You can set the page title from
     * a static page's view file this way.
     * @param $varName variable name to make available in the view
     * @param $value value of the variable.
     * @return void
     * @author Anthony Bush
     * @since 2007-05-17
     * */
    public function setLayoutVar( $varName, $value )
    {
        $this->controller->setLayoutVar( $varName, $value );
    }


}



class LvcRegistry
{

    /**
     * The instance of the registry
     * @access private
     */
    private static $instance = null;


    /**
     * Registry array of objects
     * @access private
     */
    private static $objects = array();


    private function __construct()
    {

    }


    private function __clone()
    {

    }


    public static function getInstance()
    {
        if( self::$instance == null )
        {
            self::$instance = new self();
        }
        return self::$instance;
    }


    /**
     * Get value from key given
     * @param string $key
     * @return misc
     */
    public static function get( $key )
    {
        return isset( self::$objects[$key] ) ? self::$objects[$key] : null;
    }


    /**
     * Set inside registry a value identified by key
     * @param string $key
     * @param misc $val
     */
    public static function set( $key, $val )
    {
        self::$objects[$key] = $val;
    }


    /**
     * Delete a value key paired from registry
     * @param string $key
     * @return bool
     */
    public static function delete( $key )
    {
        $return = false;
        if( isset( self::$objects[$key] ) )
        {
            unset( self::$objects[$key] );
            $return = true;
        }
        return $return;
    }


    /**
     * Check for existence for given key
     * @param string $key
     * @return boolean
     */
    public static function isExist( $key )
    {
        $return = false;
        if( self::getInstance()->$key )
        {
            $return = true;
        }
        return $return;
    }


    public function __set( $key, $val )
    {
        self::$objects[$key] = $val;
    }


    public function __get( $key )
    {
        return self::$objects[$key];
    }


}



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
     * @param LvcRouter $router
     * @return void
     * @author slier
     * */
    public function __construct( LvcRouter $router = null )
    {
        if( !is_null( $router ) )
        {
            $this->routers[] = $router;
        }
    }


    /**
     * Add a router to give it a chance to route the request.
     * The first router to return true to the {@link Lvc_RouterInterface::route()} call
     * will be the last router called, so add them in the order you want them to run.
     * @return void
     * @author Anthony Bush
     * */
    public function addRouter( LvcRouter $router )
    {
        $this->routers[] = $router;
    }


    /**
     * Start the framework
     * @return void
     * @author slier
     */
    public function go()
    {
        /* prevent multiple request by browser, causing inconsistent in session data */
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
                /* Some other error, output "technical difficulties" message to user */
                error_log( $e->getMessage() );
            }
        }
    }


}



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



?>