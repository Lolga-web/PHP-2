<?php
    CONST SERVER = "localhost";
    CONST DB = "php_2_lesson_5";
    CONST LOGIN = "root";
    CONST PASS = "root";
  
    $connect = mysqli_connect(SERVER, LOGIN, PASS, DB) or die ("Ошибка при подключении к базе данных");
?>