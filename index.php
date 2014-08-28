<?php
session_start();
$_SESSION["userid"] = 1;
error_reporting(E_ALL);
ini_set("display_errors", "1");

require_once("bootstrap.php");