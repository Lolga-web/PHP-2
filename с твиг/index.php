<?php

  include 'Twig/Autoloader.php';
  Twig_Autoloader::register();

  try {
    $loader = new Twig_Loader_Filesystem('templates');
  
    $twig = new Twig_Environment($loader);

    echo $twig->render('main.tmpl');

  } catch (PDOException $e) {
    echo "Error: Could not connect. " . $e->getMessage();
  }