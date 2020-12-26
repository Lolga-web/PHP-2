<?php
session_start();

include "M_User.php";

$login = $_POST['login'] ? strip_tags($_POST['login']) : "";
$pass = $_POST['pass'] ? strip_tags($_POST['pass']) : "";
$pass = md5($pass);
$user = new M_User();
$user->auth($login,$pass);
