<?php

class AboutController extends BaseController {

    public function __construct() {

    }

    public function index() {
        $this->render("about");
    }

}