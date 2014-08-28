<?php

class UserController extends BaseController {

    private $id;
    private $username;
    private $password;
    private $email;


    public function __construct() {

    }

    public function getUserById($id) {
        $this->query("SELECT username, password FROM Users WHERE id = ? AND username = ? AND sillyshit = ?", array($id, "someusername"));
    }

    public function getUsername() {
        return $this->username;
    }

}