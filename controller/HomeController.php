<?php

namespace Controller {
    class HomeController extends BaseController {

        public function __construct() {
            parent::__construct();
        }

        public function index() {
            $this->render("dashboard");
        }
    }
}