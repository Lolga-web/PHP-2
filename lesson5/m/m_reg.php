<?php

session_start();

include "M_User.php";

if (isset($_POST['submit'])) {
    
    $login = trim( strip_tags ($_POST['login']));
    $pass = trim( strip_tags ($_POST['pass']));
    $pass = md5($pass);
    $name = trim( strip_tags ($_POST['name']));
    $email = trim( strip_tags ($_POST['email']));

    $user = new M_User();
    $user->reg($login,$pass,$name,$email);
   
}