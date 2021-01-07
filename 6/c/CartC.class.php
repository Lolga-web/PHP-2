<?php

    class CartC extends BaseC {
        public function cart() {
            $this -> title .= ' | Корзина';

            $get_user = new UserM();
            if (isset($_SESSION['user_id'])) {
                $user_info = $get_user -> getUser($_SESSION['user_id']);
            } else {
                $user_info['name'] = false;
            }

            $get_cart = new CartM();
            $cart = $get_cart -> getCartGoods();
            $goods = $cart[0];
            $cartCount = $cart[1];
            $cartSum = $cart[2];           

            $loader = new Twig_Loader_Filesystem('v'); 
            $twig = new Twig_Environment($loader); 
            $template = $twig -> loadTemplate('cart.twig');
            $this->content = $template -> render(array(
                'goods' => $goods, 
                'user' => $user_info['name'],
                'cartCount' => $cartCount,
                'cartSum' => $cartSum
            ));
        }

        public function add() {
            $add_good = new CartM();
            $cartGoods = $add_good -> add();

            $backLink = $_SERVER["HTTP_REFERER"];
            header("location: $backLink");
        }

        public function delete() {
            $delete_good = new CartM();
            $cartGoods = $delete_good -> delete();

            $backLink = $_SERVER["HTTP_REFERER"];
            header("location: $backLink");
        }
    
    }