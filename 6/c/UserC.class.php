<?php

    class UserC extends BaseC{
        public function getUser(){
            $get_user = new UserM();
            $user_info = $get_user -> getUser($_SESSION['user_id']);
            $this -> title .= ' | Личный кабинет | ' . $user_info['name'];
            
            $loader = new Twig_Loader_Filesystem('v'); 
            $twig = new Twig_Environment($loader); 
            $template = $twig -> loadTemplate('user_info.twig');
            $vars = array(
                'username' => $user_info['name'],
                'userlogin' => $user_info['login']
            );
            $this->content = $template -> render($vars);        
        }
        
        public function regUser() {		
            $this -> title .= ' | Регистрация'; 

            $loader = new Twig_Loader_Filesystem('v'); 
            $twig = new Twig_Environment($loader);
            $template = $twig -> loadTemplate('user_reg.twig');
                
            if($this->isPost()) {
                $new_user = new UserM();
                $res = $new_user -> regUser($_POST['name'], $_POST['login'], $_POST['password']);
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
            $template = $twig -> loadTemplate('user_login.twig');
            
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