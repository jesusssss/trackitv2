<?php

/**
 * Bootstrap is requiring and getting the essentials for my system to work
 */

/* Config.php contains define()'d of dicretories */
require_once("config.php");

/* Composer autoloader (Class autoloader) */
require_once("vendor/autoload.php");

/* Start the instance of BaseController (Singleton) so we can find the correct dir */

/* Global routs */
require_once(LIBS."routes.php");

/* Routes loading Router::('/', 'HomeController@index') */
require_once(VIEW.\Controller\BaseController::get()->db->theme."/php/routes.php");

\Controller\Router\RouterController::submit();

\Controller\BaseController::get()->render();