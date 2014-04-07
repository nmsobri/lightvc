<?php
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