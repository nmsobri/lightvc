<?php
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

