<?php

#Load core application config
include( 'configs/application.php' );


/**
 * @example Starting the framework
 *
 * $framework = new LvcDispatcher( new LvcGetRouter() );
 * $framework->go();
 *
 * $framework = new LvcDispatcher( new LvcRewriteRouter() );
 * $framework->go();
 *
 * $framework = new LvcDispatcher( new LvcRegexRewriteRouter( $regexRoutes ) );
 * $framework->go();
 *
 * Using chain of responsibility, whichever router return true first, it will route the request to appropriate controller
 * Add them in orders the less will route the request to the most will route the request
 *
 * $framework = new Framework( new LvcGetRouter() );
 * $framework->addRouter( new LvcRewriteRouter() );
 * $framework->addRouter( new LvcRegexRewriteRouter( $regexRoutes ) );
 * $framework->go();
 *
 */


$dispatcher = new LvcDispatcher( new LvcRegexRewriteRouter( $regex_routes ) );
$dispatcher->go();