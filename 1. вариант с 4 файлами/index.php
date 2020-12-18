<?php

  include 'Twig/Autoloader.php';
  Twig_Autoloader::register();

  //подключаемся к БД
  try {
    $dbh = new PDO('mysql:dbname=php-2;host=localhost', 'root', 'root');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //получаем данные
    try {
      $sql = "SELECT * FROM gallery";
      $sth = $dbh->query($sql);
      while ($row = $sth->fetchObject()) {
        $data[] = $row;
      }

      //закрываем соединение
      unset($dbh);

      //подгружаем шаблон
      $loader = new Twig_Loader_Filesystem('templates');
      $twig = new Twig_Environment($loader);
      $template = $twig->loadTemplate('gallery.tmpl');

      //передаем данные и выводим содержимое
      echo $template->render(array(
        'data' => $data
      ));
    } catch (Exception $e) {
      die('ERROR: ' . $e->getMessage());
    }

  } catch (PDOException $e) {
    echo "Error: Could not connect. " . $e->getMessage();
  }

  
