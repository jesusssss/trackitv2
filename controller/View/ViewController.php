<?php

namespace Controller\View {

    use Controller\BaseController;
    use Controller\Database\DatabaseController;
    use Controller\User\UserController;

    class ViewController extends BaseController {
        private $data = array();

        public function __construct($data = array()) {
            //Construct parrent (Basecontroller)
            parent::__construct();

            $this->data = $data;

            //Get the users ip address from function to put in as standard data

            /*
             * Assign the variable data to the overall data
             * Assign the posted data too
             */
//            self::assign($variables);
//            print_r($data);
//            self::assign(array(
//                "var" => $data
//            ));
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
                    $writemaincontent = VIEW.$this->db->theme."/".$view.".phtml";
                    require_once(VIEW.$this->db->theme."/"."layout.phtml");
                ob_end_flush();
            }

        }

        /**
         * Assign function:
         * Assigns the given array of data, to our array property which will be rendered to the view
         * @param array $data
         */
//        public static function assign($data = array()) {
//            foreach($data as $key => $value) {
//                self::$data = $data[$key] = $value;
//            }
//        }

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