<?php

namespace Controller {
    use Controller\Database\DatabaseController;
    use Controller\User\UserController;
    use Controller\View\ViewController;

    class BaseController {

        private $data = array();
        public $db;
        public $viewData = array();
        /** @var \Doctrine\ORM\EntityManager $em */
        public $em;

        public static $instance;

        public static function get() {
            if(!isset(self::$instance)) {
                self::$instance = new BaseController();
            }
            return self::$instance;
        }

        private function __construct() {

            $this->db = DatabaseController::getInstance();
            $this->em = $this->db->em;

            $ip = $this->getIp();

            $url = $this->getUrlAndRequests();
            if(isset($_GET["theme"]) == "admin") {
                $this->db->theme = "admin";
            }

            $variables = array(
                "url" => $url[0],
                "requests" => "?".$url[1],
                "timestamp" => date("Y-m-d H:i:s"),
                "userIp" => $ip,
                "theme" => $this->db->theme,
                "dir" => "/view/".$this->db->theme."/"
            );

            $this->assign("config", $variables);
            $this->assign("user", $this->getUser());

        }

        public function render($render) {
            $view = new ViewController($this->viewData);
            $view->render($render);
        }

//        public function assign($data) {
//            foreach($data as $key => $value) {
//                $this->data[$key] = $value;
//            }
//        }

        public function pget($get) {
            if(isset($_REQUEST[$get]) && !empty($_REQUEST[$get])) {
                return preg_replace('/\s+/', '', $_REQUEST[$get]);
            } else {
                return false;
            }
        }

        public function sget($get) {
            if(isset($_SESSION[$get]) && !empty($_SESSION[$get])) {
                return $_SESSION[$get];
            } else {
                return false;
            }
        }

        public function skill($target) {
            if($this->sget($target)) {
                unset($_SESSION[$target]);
            } else {
                throw new \Exception("Trying to kill SESSION:".$target." [DOES NOT EXIST]");
            }
        }

        public function redirect($toRoute) {
            header("Location: ".$toRoute);
        }

        public function refresh() {
            $this->redirect($_SERVER['REQUEST_URI']);
        }

        public function getUser() {
             if($this->sget("user")) {
                $user = $this->em->find("Model\\User\\User", $this->sget("user"));
                $user = array(
                    "id" => $user->getId(),
                    "username" => $user->getUsername(),
                    "firstname" => $user->getFirstName(),
                    "lastname" => $user->getLastName(),
                    "email" => $user->getEmail(),
                    "admin" => $user->getAdmin()
                );
              } else {
                 $user = array(
                     "username" => "Guest",
                     "admin" => 0
                 );
          }
            return $user;
        }

        public function assign($treename, $data = array(), $fixName = false) {
            if(isset($this->viewData[$treename])) {
                if($fixName === true) {
                    foreach($data as $key => $value) {
                        if(isset($this->viewData[$treename][$key])) {
                            array_push($this->viewData[$treename][$key], $value);
                        } else {
                            $this->viewData[$treename][$key] = $value;
                        }
                    }
                } else {
                    array_push($this->viewData[$treename], $data);
                }
            } else {
                $this->viewData[$treename] = $data;
            }
        }

        public function getIp() {
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                return $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                return $_SERVER['REMOTE_ADDR'];
            }
        }

        public function getUrlAndRequests() {
            if(strpos($_SERVER["REQUEST_URI"], '?') !== false) {
                $fullUrl = explode('?', $_SERVER["REQUEST_URI"]);
                return array($fullUrl[0], $fullUrl[1]);
            } else {
                return array($_SERVER["REQUEST_URI"], null);
            }
        }
    }
}