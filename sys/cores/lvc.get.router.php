<?php
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
