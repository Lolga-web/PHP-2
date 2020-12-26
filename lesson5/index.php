<?php
 
    spl_autoload_register(function($className){
        include_once "c/$className.php";
    });

    //site.ru/index.php?act=auth&c=User

    $action = 'action_';
    $action .=(isset($_GET['act'])) ? $_GET['act'] : 'index';

    switch ($_GET['c'])
    {
        case 'articles':
            $controller = new C_Page();
        case 'User':
            $controller = new C_User();
            break;
        default:
            $controller = new C_Page();
    }

    $controller->Request($action);