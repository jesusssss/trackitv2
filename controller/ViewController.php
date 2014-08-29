<?php

namespace Controller {
    class ViewController extends DatabaseController {
        private $data = array();

        public function __construct($data = array()) {
            //Get the users ip address from function to put in as standard data
            $ip = $this->getIp();

            //Is the user logged in from function to put in as standard data
            $userController = new UserController();
            if($user = $userController->getCurrentUser()) {
                $username = $user->getUsername();
                $userId = $user->getId();
            } else {
                $username = "Guest";
                $userId = null;
            }

            /*
             * Get url and posts / gets
             */
            $url = $this->getUrlAndRequests();

            /*
             * Assign configurations variables to the data set
             */
            $variables = array(
                "config" => array(
                    "url" => $url[0],
                    "requests" => "?".$url[1],
                    "timestamp" => date("Y-m-d H:i:s"),
                    "userIp" => $ip,
                    "userId" => $userId,
                    "username" => $username,
                )
            );

            /*
             * Assign the variable data to the overall data
             * Assign the posted data too
             */
            $this->assign($variables);
            $this->assign(array(
                "var" => $data
            ));
        }

        /**
         * Render function:
         * Renders the target requested by the user. We allways render "default.phtml" but sends the view as a variable to write our in the default.phtml
         * since this is where we have our layout stored
         * @param $view
         */
        public function render($view) {

            /*
             * If GET key "getdata" isset, show all our current variables sent to this page.
             */
            if(isset($_GET["getdata"])) {
                echo "<pre>";
                print_r($this->data);
            } else {
                /*
                 * If not - show the real page and extract the data to it so its usable as variables on that page.
                 */
                ob_start();
                    extract($this->data);
                    $writemaincontent = VIEW.$view.".phtml";
                    require_once(VIEW."default.phtml");
                ob_end_flush();
            }

        }

        /**
         * Assign function:
         * Assigns the given array of data, to our array property which will be rendered to the view
         * @param array $data
         */
        public function assign($data = array()) {
            foreach($data as $key => $value) {
                $this->data[$key] = $value;
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

        public function isLoggedIn() {
            if(isset($_SESSION["user"]) && !empty($_SESSION["user"])) {
                return $_SESSION["user"];
            } else {
                return false;
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