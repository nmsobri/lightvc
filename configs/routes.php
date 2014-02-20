<?php

// Format of regex => parseInfo
$regexRoutes = array(
    // Map nothing to the home page.
    '#^$#' => array(
        'controller'=> 'home',
        'action'=> 'index'
    ),
    // Map this specific string to controller home. including its query
    '#^(login|register|activation|send_activation|forgot_password)(/?.*)$#' => array(
        'controller'=> 'home',
        'action'=> 1
    ),
    //Allow direct access to all pages via a "/page/page_name" URL.
    '#^page/?(.*)$#' => array(
        'controller'=> 'page',
        'action'=> 'view',
        'action_params' => array('page_name'=> 1,),
    ),
    // Map controler/action/params
    '#^(\w+)/(\w+)/?(.*)$#' => array(
        'controller'=> 1,
        'action'=> 2,
        'additional_params'=> 3,
    ),
    // Map controller without action with/without /?post to its controller and default action. [add whitelist controller here before it will always catch by last rules]
    '#^(?=(user|home)(?:/|(?:/\?post=t))?$).*$#' => array(
        'controller'=> 1,
    ),
    //Map random string to profiles controller
    '#^(?!(?:login|register|activation|send_activation|forgot_password)$)(.+)#' => array(
        'controller'    => 'profile',
        'action'        => 'index',
        'action_params' => array( 'profiles' => 1 )
    ),
);
?>