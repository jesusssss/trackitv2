<?php

Router::create('/', 'HomeController@index');

Router::create('/about', 'AboutController@index');

Router::submit();