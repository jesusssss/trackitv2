<?php

/**
 * Bootstrap is requiring and getting the essentials for my system to work
 */

require_once("config.php");
require_once(LIBS."autoloader.php");
spl_autoload_register('\Libs\Autoloader::loader');

require_once(LIBS."routes.php");