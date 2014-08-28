<?php

class BaseController extends DatabaseController {

    private $data = array();

    public function __construct() {
        parent::__construct();
    }

    public function isLoggedIn() {

    }

    public function render($render) {
        $view = new ViewController($this->data);
        $view->render($render);
    }

    public function assign($data) {
        foreach($data as $key => $value) {
            $this->data[$key] = $value;
        }
    }
}