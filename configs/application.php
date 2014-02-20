<?php

/* Change this during production */
error_reporting( E_ALL ^ E_NOTICE );

/* Derived Constants */
define( 'APP_PATH', dirname( dirname( __FILE__ ) ) . '/' ); //absolute path to root folder
define( 'WWW_BASE_PATH', str_replace( 'index.php', '', $_SERVER[ 'SCRIPT_NAME' ] ) ); //relative path from root folder
define( 'WWW_CSS_PATH', WWW_BASE_PATH . 'assets/css/' );
define( 'WWW_JS_PATH', WWW_BASE_PATH . 'assets/js/' );
define( 'WWW_IMAGE_PATH', WWW_BASE_PATH . 'assets/img/' );
define( 'USER_IMAGE_DIR', APP_PATH . 'assets/users/' );
define( 'USER_IMAGE_PATH', WWW_BASE_PATH . 'assets/users/' );
define( 'USER_IMAGE_PREFIX', '' );
define( 'USER_THUMB_PREFIX', 'thumb_' );
define( 'USER_DEFAULT_IMAGE', 'default.png' );
define( 'DEVELOPMENT', true );
define( 'SALT', 'wzADU3+!X5kfFHB' );
define( 'DB_DSN', 'mysql:host=localhost;dbname=spomi' );
define( 'DB_USER', 'root' );
define( 'DB_PASS', 'root' );



/* set_include_path(get_include_path() . PATH_SEPARATOR . APP_PATH . PATH_SEPARATOR . SHARED_PATH); */
/* set_include_path(get_include_path() . PATH_SEPARATOR . APP_PATH); */
/* Include and configure the LighVC framework (http://lightvc.org/) */


include(APP_PATH . 'configs/routes.php');
include_once(APP_PATH . 'cores/class.LightVc.php');
include(APP_PATH . 'classes/class.Autoloader.php');

Lvc_Config::addControllerPath( APP_PATH . 'controllers/' );
Lvc_Config::addControllerViewPath( APP_PATH . 'views/' );
Lvc_Config::addLayoutViewPath( APP_PATH . 'views/layouts/' );
Lvc_Config::addElementViewPath( APP_PATH . 'views/elements/' );
Lvc_Config::setViewClassName( 'AppView' );



/* Enable the optional Autoloader and/or SimpleReflector helpers by uncommenting the following: */
Autoloader::setClassFilePrefix( 'class.' );
Autoloader::setClassFileSuffix( '.php' );
Autoloader::setCacheFilePath( null );
Autoloader::excludeFolderNamesMatchingRegex( '#^CVS|\..*$#' );
Autoloader::setClassPaths( array( APP_PATH . 'classes/' ) );
spl_autoload_register( array( 'Autoloader', 'loadClass' ) );


/* Setup SimpleReflector alias (http://anthonybush.com/projects/simplereflector/) */
/* call this to debug a variable/object, e.g. jam($var); */

function jam()
{
    call_user_func_array( array( 'SimpleReflector', 'jam' ), func_get_args() );
}



if ( !is_dir( USER_IMAGE_DIR ) )
    mkdir( USER_IMAGE_DIR, 0777 );

ini_set( 'error_log', APP_PATH . 'logs/log.txt' );
?>