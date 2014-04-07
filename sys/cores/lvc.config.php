<?php

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
