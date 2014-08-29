<?php

use Controller\Router as Router;
Router::create('/', 'HomeController@index');
Router::create('/about', 'AboutController@index');
Router::create('/logout', 'UserController@logout');
Router::submit();