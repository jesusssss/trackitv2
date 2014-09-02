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

        public function __construct() {

            $this->db = DatabaseController::getInstance();
            $this->em = $this->db->em;

            $ip = $this->getIp();

            $url = $this->getUrlAndRequests();

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
                return $_REQUEST[$get];
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

        public function getUser() {
             if($this->sget("user")) {
                $user = $this->em->find("Model\\User\\User", $this->sget("user"));
                $user = array(
                    "username" => $user->getUsername(),
                    "password" => $user->getPassword(),
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

        public function assign($treename, $data = array()) {
            $this->viewData[$treename] = $data;
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