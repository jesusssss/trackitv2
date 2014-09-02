<?php

namespace Controller\Error {
    use Controller\BaseController;

    class ErrorController extends BaseController {

        public function __construct() {
            parent::__construct();
            self::assign(array(
                "text" => "Some text",
                "another" => "Another text"
            ));
            $this->render("404");
        }

    }
}