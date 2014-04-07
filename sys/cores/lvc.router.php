<?php
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
