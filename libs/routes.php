<?php

use Controller\Router\RouterController as Router;
/* Themes to skip cms */
$skip = array("_noTheme", "cpanel");
if(!in_array(\Controller\BaseController::get()->db->theme, $skip)) {
    Router::create('*', 'MenuController@getMenu');
    Router::create('*', 'CmsController@getPage');
}

Router::create('/logout', 'UserController@logout');