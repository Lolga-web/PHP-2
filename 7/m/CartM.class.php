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

        public function buy() {
            if (isset($_SESSION['cart_goods']) && isset($_SESSION['user_id'])) {
                $idUser = $_SESSION['user_id'];

                $res = PdoM::Instance() -> Insert('orders', ['id_user' => $idUser, 'date_order' => date("d/m/Y"), 'status_order' => 'Активен']);

                $idOrder = PdoM::Instance() -> lastIndex();

                $orderGood = $_SESSION['cart_goods'];
                foreach ($orderGood as $key => $val) {
                    $idGood = $key;
                    $goodCount = $val;
                    $res = PdoM::Instance() -> Insert('order_goods', ['id_order' => $idOrder, 'id_good' => $idGood, 'good_count' => $goodCount]);  
                }

                unset($_SESSION['cart_goods']);
            }        
        }
    }