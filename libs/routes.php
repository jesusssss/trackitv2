<?php

use Controller\Router\RouterController as Router;
Router::create('*', 'MenuController@getMenu');
Router::create('/logout', 'UserController@logout');