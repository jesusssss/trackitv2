<?php

namespace Controller {
    class ErrorController extends BaseController {

        public function __construct() {
            parent::__construct();
            $this->assign(array(
                "text" => "Some text",
                "another" => "Another text"
            ));
            $this->render("404");
        }

    }
}