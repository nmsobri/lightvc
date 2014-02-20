<?php

/* Change this during production */
error_reporting( E_ALL ^ E_NOTICE );

/* Derived Constants */
define( 'BASE_PATH', dirname( dirname( __FILE__ ) ) . '/' ); //absolute path to root folder
define( 'APP_PATH', str_replace( 'index.php', '', $_SERVER[ 'SCRIPT_NAME' ] ) ); //relative path from root folder
define( 'CSS_PATH', APP_PATH . 'assets/css/' );
define( 'JS_PATH', APP_PATH . 'assets/js/' );
define( 'IMG_PATH', APP_PATH . 'assets/img/' );
define( 'DEVELOPMENT', true );


/* Include and configure the LighVC framework (http://lightvc.org/) */


include(BASE_PATH . 'configs/routes.php');
include_once(BASE_PATH . 'cores/class.LightVc.php');
include(BASE_PATH . 'classes/class.Autoloader.php');

Lvc_Config::addControllerPath( BASE_PATH . 'controllers/' );
Lvc_Config::addControllerViewPath( BASE_PATH . 'views/' );
Lvc_Config::addLayoutViewPath( BASE_PATH . 'views/layouts/' );
Lvc_Config::addElementViewPath( BASE_PATH . 'views/elements/' );
Lvc_Config::setViewClassName( 'AppView' );



/* Enable the optional Autoloader and/or SimpleReflector helpers by uncommenting the following: */
Autoloader::setClassFilePrefix( 'class.' );
Autoloader::setClassFileSuffix( '.php' );
Autoloader::setCacheFilePath( null );
Autoloader::excludeFolderNamesMatchingRegex( '#^CVS|\..*$#' );
Autoloader::setClassPaths( array( BASE_PATH . 'classes/' ) );
spl_autoload_register( array( 'Autoloader', 'loadClass' ) );


/* Setup SimpleReflector alias (http://anthonybush.com/projects/simplereflector/) */
/* call this to debug a variable/object, e.g. jam($var); */

function jam()
{
    call_user_func_array( array( 'SimpleReflector', 'jam' ), func_get_args() );
}

?>