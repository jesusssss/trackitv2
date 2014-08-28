<?php

class DatabaseController {

    private $db;

    public function __construct() {
        $this->db = new mysqli("localhost","root","1871rene","trackit");
    }

    public function query($query, $params = array()) {
        foreach($params as $param) {
            //TODO find ud af hvorfor escape string ikke virker som tiltænkt.
            $param = $this->db->escape_string($param);
            $query = preg_replace('/\?/', $param, $query, 1);
        }

        print_r($query);
    }

}