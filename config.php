<?php

/**
 * Array with global dirs to be defined
 */
$globalDirs  = array(
    "LIBS" => "libs/",
    "CONTROLLER" => "controller/",
    "MODEL" => "model/",
    "VIEW" => "view/"
);

/**
 * Define each Directory Globally
 */
foreach($globalDirs as $key => $value) {
    define($key, __DIR__."/".$value);
}