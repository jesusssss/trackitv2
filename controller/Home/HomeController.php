<?php

namespace Controller\Home {
    use Controller\BaseController;

    class HomeController {

        public function index() {
            BaseController::get()->render("index");
        }
    }
}