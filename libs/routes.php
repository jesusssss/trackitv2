<?php

use Controller\Router\RouterController as Router;
if(\Controller\BaseController::get()->db->theme != '_noTheme') {
    Router::create('*', 'MenuController@getMenu');
    Router::create('/logout', 'UserController@logout');
}