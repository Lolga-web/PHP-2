<?php

    abstract class BaseC extends Controller {
        protected $title; 
        protected $content; 
        protected $text;
        
        public function before(){
            $this -> title = 'САЙТ';
            $this -> content = '';
            $this -> text = '';
        }
        
        public function render(){
            $get_user = new UserM();            
            if (isset($_SESSION['user_id'])) {
                $user_info = $get_user -> getUser($_SESSION['user_id']);
            } else {
                $user_info['name'] = false;
            }

            $get_cart = new CartM();
            $cart = $get_cart -> getCartGoods();
            // $goods = $cart[0];
            $cartCount = $cart[1];
            // $cartSum = $cart[2];
            
            $loader = new Twig_Loader_Filesystem('v'); 
            $twig = new Twig_Environment($loader); 
            $template = $twig -> loadTemplate('main.twig');
            $vars = array(
                'title' => $this->title,
                'content' => $this->content, 
                'text' => $this->text,
                'user' => $user_info['name'],
                'cartCount' => $cartCount
            );
            echo $template -> render($vars);
        }
    }
