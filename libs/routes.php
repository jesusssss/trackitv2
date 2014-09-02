<?php

use Controller\Router\RouterController as Router;
Router::create('/', 'HomeController@index');
Router::create('/logout', 'UserController@logout');
//Router::create('/about', 'AboutController@index');
//Router::create('/logout', 'UserController@logout');
Router::submit();