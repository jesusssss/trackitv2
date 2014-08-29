<?php

namespace Controller {
    class BaseController extends DatabaseController {

        private $data = array();

        public function isLoggedIn() {

        }

        public function render($render) {
            $view = new ViewController($this->data);
            $view->render($render);
        }

        public function assign($data) {
            foreach($data as $key => $value) {
                $this->data[$key] = $value;
            }
        }

        public function pget($get) {
            if(isset($_REQUEST[$get]) && !empy($_REQUEST[$get])) {
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
    }
}