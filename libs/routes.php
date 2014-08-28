<?php

Router::create('/', 'HomeController@index');

Router::create('/about', 'AboutController');

Router::submit();