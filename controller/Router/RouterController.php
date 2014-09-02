<?php

namespace Controller\Router {
    use Controller\Error\ErrorController;

    class RouterController {

        private static $_uri;
        private static $_methods;

        public function __construct() {
            self::$_uri = array();
            self::$_methods = array();
        }

        public static function create($uri, $method) {
            if(self::setUri($uri) && self::setMethod($method)) {
                return true;
            } else {
                throw new \Exception("Router need both URI and METHOD to create the route!");
            }

        }


        private static function setUri($uri) {
            if(!empty($uri)) {
                self::$_uri[] = $uri;
                return true;
            } else {
                return false;
            }
        }

        private static function setMethod($method) {
            if(!empty($method)) {
                if(strpos($method,'@') !== false) {
                    $method = explode('@', $method);
                    self::$_methods[] = $method;
                } else {
                    self::$_methods[] = $method;
                }
                return true;
            } else {
                return false;
            }
        }

        private static function getUri() {
            return self::$_uri;
        }

        private static function getMethods() {
            return self::$_methods;
        }

        public static function submit() {
            /* Run function based on URI */
            if(self::getPostAction($_POST)) {
                self::runFunction(self::getPostAction($_POST));
            }
            self::runFunction(self::getUriAction());
        }

        public static function runFunction($array) {
            if(class_exists($array[0])) {
                if(is_array($array)) {
                    $run = new $array[0]();
                    $run->$array[1]();
                } else {
                    $run = new $array();
                }
            } else {
                $run = new ErrorController();
            }
        }

        public static function getUriAction() {
            $uri = (isset($_GET["uri"]) ? "/" . trim($_GET["uri"],'/') : '/');

            if(in_array($uri, self::getUri())) {
                foreach(self::getUri() as $key => $value) {
                    if($uri == $value) {
                        $namespace = explode("Controller", self::getMethods()[$key][0]);
                        $controller = "Controller\\".$namespace[0]."\\".self::getMethods()[$key][0];
                        if(is_array(self::getMethods()[$key])) {
                            $function = self::getMethods()[$key][1];
                            $data = array($controller, $function);
                        } else {
                            $data = $controller;
                        }
                        return $data;
                    }
                }
            } else {
                $controller = "Controller\\Error\\ErrorController";
                return $controller;
            }
        }

        public static function getPostAction($posts) {
            $data = false;
            foreach($posts as $key => $value) {
                if(strpos($key, "Action-") !== false) {
                    $command = explode("-",$key);
                    $controller = "Controller\\".$command[1]."\\".$command[1]."Controller";
                    $function = $command[2];

                    $data = array($controller, $function);
                }
            }
            return $data;
        }
    }
}
