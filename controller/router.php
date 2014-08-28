<?php


class Router extends BaseController {

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


        $uri = (isset($_GET["uri"]) ? "/" . trim($_GET["uri"],'/') : '/');

        if(in_array($uri, self::getUri())) {
            foreach(self::getUri() as $key => $value) {
                if($uri == $value) {
                    if(is_array(self::getMethods()[$key])) {
                        $controller = self::getMethods()[$key][0];
                        $function = self::getMethods()[$key][1];

                        $run = new $controller();
                        $run->$function();
                    } else {
                        $controller = self::getMethods()[$key];
                        $run = new $controller();
                    }
                }
            }
        } else {
            $run = new ErrorController();
        }
    }

}
