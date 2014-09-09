<?php

use Controller\Router\RouterController as Router;

/**
 * Index and logout allready exists, dont make more of those:
 * //Router::create('/', 'HomeController@index');
 * //Router::create('/logout', 'UserController@logout');
 *
 * Router::submit() will be called from the global router dir
 */

//TODO Fix så man på en måde kan pakke routes væk bag login - så guests kan se nogle routes, og logins kan se andre routes

/* Front page */
