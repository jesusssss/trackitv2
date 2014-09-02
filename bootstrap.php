<?php

/**
 * Bootstrap is requiring and getting the essentials for my system to work
 */

/* Config.php contains define()'d of dicretories */
require_once("config.php");

/* Composer autoloader (Class autoloader) */
require_once("vendor/autoload.php");

/* Routes loading Router::('/', 'HomeController@index') */
require_once(LIBS."routes.php");

/* Post commands getting run Action-Controller-Function */

require_once(LIBS."app.php");