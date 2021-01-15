<?php

    class UserC extends BaseC{
        public function getUser(){
            $getUser = new UserM();
            $user = $getUser -> getUser($_SESSION['user_id']);
            $this -> title .= ' | Личный кабинет | ' . $user['name'];

            $ordersInfo = $getUser -> getUserOrders($user['id']);
            $userOrders = $ordersInfo[0];
            $orderGoods = $ordersInfo[1];

            $loader = new Twig_Loader_Filesystem('v'); 
            $twig = new Twig_Environment($loader); 
            $template = $twig -> loadTemplate('userAccaunt.twig');
            $vars = array(
                'user' => $user,
                'orders' => $userOrders,
                'order_goods' => $orderGoods,
            );

            $this->content = $template -> render($vars);        
        }
        
        public function regUser() {		
            $this -> title .= ' | Регистрация'; 

            $loader = new Twig_Loader_Filesystem('v'); 
            $twig = new Twig_Environment($loader);
            $template = $twig -> loadTemplate('userReg.twig');
                
            if($this->isPost()) {
                $newUser = new UserM();
                $res = $newUser -> regUser($_POST['name'], $_POST['login'], $_POST['password']);
                $this -> text = $res;
                $this->content = $template -> render(array('text' => $this->text));
            } else {
                $this->content = $template -> render(array());
            }
        }

        public function login() {
            $this->title .= ' | Вход';

            $loader = new Twig_Loader_Filesystem('v'); 
            $twig = new Twig_Environment($loader); 
            $template = $twig -> loadTemplate('userLogin.twig');
            
            if($this->isPost()) {
                $login = new UserM();
                $res = $login -> login($_POST['login'], $_POST['password']);
                $this -> text = $res;
                $this->content = $template -> render(array('text' => $this->text));
            } else {
                $this->content = $template -> render(array());
            }
        }
        
        public function logout() {
            $logout = new UserM();
            $result = $logout->logout();

            header("location: index.php?class=page&method=index"); 
        }	                    
    }