<?php

class BaseController {

    private $data = array();

    public function __construct() {

    }

    public function render($render) {
        $view = new ViewController($this->data);
        $view->render($render);
    }

    public function assign($key, $value) {
        $this->data[$key] = $value;
    }
}