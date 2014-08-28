<?php

class ErrorController extends BaseController {

    public function __construct() {
        $this->assign("text", "noget text");
        $this->assign("another", "noget andet");
        $this->render("404");
    }

}