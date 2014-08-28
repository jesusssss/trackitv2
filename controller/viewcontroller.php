<?php

class ViewController {
    private $data = array();

    public function __construct($data = array()) {
        $this->assign("conf_url", $_SERVER["REQUEST_URI"]);
        $this->assign("conf_timestamp", date("Y-m-d H:i:s"));
        foreach($data as $key => $value) {
            $this->assign($key, $value);
        }
    }

    public function render($view) {
        ob_start();
            extract($this->data);
            //php view get function to cunstruct other views as includes (Main layouts)
            $writemaincontent = VIEW.$view.".phtml";
            require_once(VIEW."default.phtml");
        ob_end_flush();
    }

    public function assign($key, $value) {
        $this->data[$key] = $value;
    }
}