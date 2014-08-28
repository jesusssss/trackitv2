<?php

class HomeController extends BaseController {

    public function __construct() {
        echo "YO HOMECONTROLLER";
    }

    public function index() {
        echo "You just ran: HomeController@index";
    }

}