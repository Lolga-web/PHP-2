<?php

    class CartM { 

        public function getCartGoods() {
            $goods = [];
            if (isset($_SESSION['cart_goods'])) {
                $cartGood = $_SESSION['cart_goods'];
                foreach ($cartGood as $key => $val) {
                    $idGood = $key;
                    $goodCount = $val;
                    $query = "SELECT * FROM goods WHERE id='$idGood'";
                    $res = PdoM::Instance() -> Select($query);
                    foreach ($res as $key => $val) {
                        $val['quantity'] = $goodCount;
                        $goods[] = $val;
                    }                    
                }
                $cartCount = 0;
                $cartSum = 0;
                foreach ($goods as $key => $val) {
                    $cartCount += $val['quantity'];
                    $cartSum += $val['price'] * $val['quantity'];
                }   
            }
            return array ($goods, $cartCount, $cartSum);
        }

        public function add() {
            $idGood = $_GET['id'];           
            $cartGoods = [];

            if (isset($_SESSION['cart_goods'])) {
                $cartGoods = $_SESSION['cart_goods'];
            }
            if (array_key_exists($idGood, $cartGoods)) {
                $cartGoods[$idGood] = $cartGoods[$idGood] + 1;
            } else {
                $cartGoods[$idGood] = 1;
            }

            $_SESSION['cart_goods'] = $cartGoods;
            return $cartGoods;
        }

        public function delete() {
            $idGood = $_GET['id'];
            unset($_SESSION['cart_goods'][$idGood]);
        }
    }