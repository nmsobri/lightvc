<?php

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

