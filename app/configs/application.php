<?php

#Change this during production
error_reporting( E_ALL ^ E_NOTICE );

#Framework Constants
define( 'BASE_PATH', dirname( dirname( dirname( __FILE__ ) ) ) . '/' );
define( 'APP_PATH', str_replace( 'index.php', '', $_SERVER['SCRIPT_NAME'] ) );
define( 'CSS_PATH', APP_PATH . 'web/css/' );
define( 'JS_PATH', APP_PATH . 'web/js/' );
define( 'IMG_PATH', APP_PATH . 'web/img/' );
define( 'DEVELOPMENT', true );

#Include and configure the framework
include( BASE_PATH . '/app/configs/routes.php' );
include( BASE_PATH . 'sys/cores/autoloader.php' );

Autoloader::setCacheFile( null );
Autoloader::setClassPaths( array( BASE_PATH . 'sys/controllers/', BASE_PATH . 'sys/cores/' ) );
Autoloader::registerAutoload();

LvcConfig::setControllerPath( BASE_PATH . 'app/controllers/' );
LvcConfig::setControllerPath( BASE_PATH . 'sys/controllers/' );

LvcConfig::setControllerViewPath( BASE_PATH . 'app/views/' );
LvcConfig::setControllerViewPath( BASE_PATH . 'sys/views/' );

LvcConfig::setLayoutViewPath( BASE_PATH . 'app/views/layouts/' );
LvcConfig::setLayoutViewPath( BASE_PATH . 'sys/views/layouts/' );

LvcConfig::setElementViewPath( BASE_PATH . 'app/views/elements/' );
LvcConfig::setElementViewPath( BASE_PATH . 'sys/views/elements/' );
LvcConfig::setViewClassName( 'AppView' );
