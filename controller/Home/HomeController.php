<?php

namespace Controller\Home {
    use Controller\BaseController;

    class HomeController extends BaseController {

        public function index() {
            $this->render("index");
        }
    }
}