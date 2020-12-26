<?php
    /**
     * Основной шаблон
     * ===============
     * $title - заголовок
     * $content - HTML страницы
     * $error - ошибки
     */

    session_start();
    include "m/config.php";
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style/style.css" /> 
        <title><?=$title?></title>	
    </head>
    <body>

        <div class="container">

            <div id="header">
                <h1><?=$title?></h1>
            </div>
            
            <div id="menu">
                <a href="index.php" class="menu_link"><li class="menu_item">ГЛАВНАЯ</li></a>
                <? if (isset($_SESSION['userName'])){
                        $login = $_SESSION['userName'];
                        if ($login !== 1 && $login !== 2 && $login !== 3) { ?>
                            <a href="index.php?c=User&act=account" class="menu_link"><li class="menu_item">ЛИЧНЫЙ КАБИНЕТ</li></a>        
                    <?php 
                        } else { ?>
                        <a href="index.php?c=User&act=auth" class="menu_link"><li class="menu_item">АВТОРИЗАЦИЯ</li></a>
                    <?}
                    } else { ?>
                        <a href="index.php?c=User&act=auth" class="menu_link"><li class="menu_item">АВТОРИЗАЦИЯ</li></a>
                <? } ?>
            </div>
            
            <div id="content">

                <div id="error">
                    <h1 style="color:red; height:25px;"><?=$error?></h1>
                </div>

                <?=$content?>

            </div>
            
            <div id="footer">
                Все права защищены. Адрес. Телефон.
            </div>

        </div>
        
    </body>
    </html>