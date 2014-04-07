<?php
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

