<?php

namespace Controller\Home {
    use Controller\BaseController;

    class HomeController {

        public function render($page) {
            BaseController::get()->render($page);
        }
    }
}