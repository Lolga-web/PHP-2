<?php

    class CartC extends BaseC {

        public function cart() {
            $this -> title .= ' | Корзина';

            $getUser = new UserM();
            if (isset($_SESSION['user_id'])) {
                $user = $getUser -> getUser($_SESSION['user_id']);
            } else {
                $user['name'] = false;
            }

            $getCart = new CartM();
            $cart = $getCart -> getCartGoods();
            $goods = $cart[0];
            $cartCount = $cart[1];
            $cartSum = $cart[2];           

            $loader = new Twig_Loader_Filesystem('v'); 
            $twig = new Twig_Environment($loader); 
            $template = $twig -> loadTemplate('cart.twig');
            $this->content = $template -> render(array(
                'goods' => $goods, 
                'user' => $user['name'],
                'cartCount' => $cartCount,
                'cartSum' => $cartSum
            ));
        }

        public function add() {
            $addGood = new CartM();
            $cartGoods = $addGood -> add();

            $backLink = $_SERVER["HTTP_REFERER"];
            header("location: $backLink");
        }

        public function delete() {
            $deleteGood = new CartM();
            $cartGoods = $deleteGood -> delete();

            $backLink = $_SERVER["HTTP_REFERER"];
            header("location: $backLink");
        }

        public function buy() {
            $buyGood = new CartM();
            $cartGoods = $buyGood -> buy();

            $backLink = $_SERVER["HTTP_REFERER"];
            header("location: $backLink");
        }
    
    }