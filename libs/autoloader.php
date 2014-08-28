<?php

namespace Libs {
    class Autoloader {

        public static function loader($class) {
            if(file_exists(CONTROLLER.strtolower($class).".php")) {
                include(CONTROLLER.strtolower($class).".php");
            } else {
                throw new \Exception("Controller: '".$class."' not found in Autoloader");
            }
        }

    }
}