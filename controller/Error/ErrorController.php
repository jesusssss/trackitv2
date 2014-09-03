<?php

namespace Controller\Error {
    use Controller\BaseController;

    class ErrorController {

        public function __construct() {
            BaseController::get()->render("404");
        }
    }
}