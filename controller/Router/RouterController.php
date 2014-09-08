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

        public static function create($uri, $method, $data = null) {
            if($data !== null) {
                if(self::setUri($uri) && self::setMethod($method, $data)) {
                    return true;
                } else {
                    throw new \Exception("Router got error when trying to add data. Maybe something is missing?");
                }
            } else {
                if(self::setUri($uri) && self::setMethod($method)) {
                    return true;
                } else {
                    throw new \Exception("Router need both URI and METHOD to create the route!");
                }
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

        private static function setMethod($method, $data = null) {
            if(!empty($method)) {
                if(strpos($method,'@') !== false) {
                    if($data !== null) {
                        $method = array(explode('@', $method), $data);
                    } else {
                        $method = explode('@', $method);
                    }
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
            if(self::getPostAction($_POST)) {
                self::runFunction(self::getPostAction($_POST));
            }
            self::runFunction(self::getUriAction());
        }

        public static function runFunction($array) {
            if(is_array($array[0])) {
                foreach($array as $ar) {
                    if(class_exists($ar[0])) {
                        if(is_array($ar)) {
                            if(isset($ar[2])) {
                                $run = new $ar[0]();
                                $run->$ar[1]("$ar[2]");
                            } else if(isset($ar[1])) {
                                $run = new $ar[0]();
                                $run->$ar[1]();
                            } else {
                                $run = new $ar[0]();
                            }
                        } else {
                            $run = new $ar[0]();
                        }
                    } else {
                        throw new \Exception("Class ".$ar[0]." does not exist and cannot be run from funFunction in RouteController");
                    }
                }
            } else {
                if(isset($array[1])) {
                    $run = new $array[0]();
                    $run ->$array[1]();
                } else {
                    $run = new $array[0];
                }
            }
        }

        public static function getUriAction() {
            $result = array();
            foreach(self::getUri() as $key => $value) {
                if($value == '*') {
                    if(is_array(self::getMethods()[$key][0])) {
                        $namespace = explode("Controller", self::getMethods()[$key][0][0]);
                        $controller = "Controller\\".$namespace[0]."\\".self::getMethods()[$key][0][0];
                        $function = self::getMethods()[$key][0][1];
                        $parse = self::getMethods()[$key][1];
                        $data = array($controller, $function, $parse);
                    } else {
                        $namespace = explode("Controller", self::getMethods()[$key][0]);
                        $controller = "Controller\\".$namespace[0]."\\".self::getMethods()[$key][0];
                        if(is_array(self::getMethods()[$key])) {
                            $function = self::getMethods()[$key][1];
                            $data = array($controller, $function);
                        } else {
                            $data = $controller;
                        }
                    }
                    $result[] = $data;
                }
            }

            $uri = (isset($_GET["uri"]) ? "/" . trim($_GET["uri"],'/') : '/');
            if(in_array($uri, self::getUri())) {
                foreach(self::getUri() as $key => $value) {
                    if($uri == $value) {
                        if(is_array(self::getMethods()[$key][0])) {
                            $namespace = explode("Controller", self::getMethods()[$key][0][0]);
                            $controller = "Controller\\".$namespace[0]."\\".self::getMethods()[$key][0][0];
                            $function = self::getMethods()[$key][0][1];
                            $parse = self::getMethods()[$key][1];
                            $data = array($controller, $function, $parse);
                        } else {
                            $namespace = explode("Controller", self::getMethods()[$key][0]);
                            $controller = "Controller\\".$namespace[0]."\\".self::getMethods()[$key][0];
                            if(is_array(self::getMethods()[$key])) {
                                $function = self::getMethods()[$key][1];
                                $data = array($controller, $function);
                            } else {
                                $data = $controller;
                            }
                        }
                        $result[] = $data;
                    }
                }
            } else {
                $result[] = array("Controller\\Error\\ErrorController");
            }

            return $result;
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
