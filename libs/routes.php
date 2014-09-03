<?php

use Controller\Router\RouterController as Router;
Router::create('/logout', 'UserController@logout');
Router::submit();