<?php

/* Load core application config */
include_once('./configs/application.php');


/**
 * @example Starting the framework
 *
 * $framework = new Framework( new Lvc_GetRouter() );
 * $framework->go();
 *
 * $framework = new Framework( new Lvc_RewriteRouter() );
 * $framework->go();
 *
 * $framework = new Framework( new Lvc_RegexRewriteRouter( $regexRoutes ) );
 * $framework->go();
 *
 *
 * Using chain of responsibility, whichever router return true first, it will route the request to appropriate controller
 * Add them in orders the less will route the request to the most will route the request
 *
 * $framework = new Framework( new Lvc_GetRouter() );
 * $framework->addRouter( new Lvc_RewriteRouter() );
 * $framework->addRouter( new Lvc_RegexRewriteRouter( $regexRoutes ) );
 * $framework->go();
 *
 */
$dispatcher = new Dispatcher( new Lvc_RegexRewriteRouter( $regexRoutes ) );
$dispatcher->go();
?>