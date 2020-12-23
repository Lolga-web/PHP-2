<?php

    include 'Twig/Autoloader.php';
    Twig_Autoloader::register();

    //подключаемся к БД
    try {
    $dbh = new PDO('mysql:dbname=php_2_lesson_4;host=localhost', 'root', 'root');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //получаем данные
        // $pageLimit - количество отображаемых данных из БД
        // $category - категория товара
        // $page - текущая страница
        // $productsCount - количество записей в БД по категории
        // $pagesCount - количество страниц
        // $startPosition - начальная позиция, для запроса к БД
        // $arrowLeft - стрелка назад
        // $arrowRight - стрелка вперед
        // $goods - массив товаров на текущей странице
        try {
            $pageLimit = 10;
            $category = $_GET['category']; 

            if (empty(@$_GET['page']) || ($_GET['page'] <= 0)) {
                $page = 1;
            } else {
                $page = (int) $_GET['page']; 
            }

            $sql = "SELECT * FROM goods WHERE `category`=$category";
            $sth = $dbh->query($sql);
            while ($row = $sth->fetchObject()) {
                $productsCount = $productsCount+1;
            }

            $pagesCount = ceil($productsCount / $pageLimit); 

            // Если номер страницы оказался больше количества страниц
            if ($page > $pagesCount) $page = $pagesCount;

            $startPosition = ($page - 1) * $pageLimit;  

            $sql = "SELECT * FROM goods WHERE `category`=$category limit $startPosition, $pageLimit";
            $sth = $dbh->query($sql);
            while ($row = $sth->fetchObject()) {
                $goods[] = $row;
            }

            $arrowLeft = $page - 1;  
            $arrowRight = $page + 1; 

            //закрываем соединение
            unset($dbh);

            //подгружаем шаблон
            $loader = new Twig_Loader_Filesystem('templates');
            $twig = new Twig_Environment($loader);
            $template = $twig->loadTemplate('catalog.tmpl');

            //передаем данные и выводим содержимое
            echo $template->render(array(
                'pageLimit' => $pageLimit,
                'category' => $category,
                'page' => $page,
                'productCount' => $productsCount,
                'pagesCount' => $pagesCount,
                'startPosition' => $startPosition,
                'arrowLeft' => $arrowLeft,
                'arrowRight' => $arrowRight,
                'goods' => $goods
            ));
        } catch (Exception $e) {
            die('ERROR: ' . $e->getMessage());
        }

    } catch (PDOException $e) {
    echo "Error: Could not connect. " . $e->getMessage();
    }