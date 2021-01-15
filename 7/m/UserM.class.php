<?php

    class UserM { 
        
        public function setPass($name, $password) {
            return strrev(md5($name)) . md5($password);
        }
        
        public function getUser($id) {
            $query = "SELECT * FROM users WHERE id=" . $id;
            $res = PdoM::Instance() -> Select($query);
            foreach ($res as $key => $val) {
                return $val;
            }
        }

        public function getUserOrders($id) {
            $userOrders = PdoM::Instance() -> Select("SELECT * FROM orders WHERE id_user=" . $id); //все заказы пользователя

            $ordersIdArr = []; //массив id заказов пользователя         
            foreach ($userOrders as $key => $val){
                $ordersIdArr[] = $val['id_order'];
            }

            $userGoods = []; //массив товаров в заказах пользователя
            if (!empty($ordersIdArr)){
                //находим сумму и список товаров в каждом заказе
                foreach ($ordersIdArr as $key => $val){
                    $orderId = $val;
                    $query = "SELECT o.id_order, o.id_good, o.good_count, g.title, g.img, g.price 
                                FROM order_goods o, goods g WHERE o.id_good = g.id AND id_order=" . $orderId;
                    $res = PdoM::Instance() -> Select($query);

                    $orderSum = 0; //сумма каждого заказа
                    foreach ($res as $key => $val){
                        $userGoods[] = $val;
                        $orderSum += $val['good_count'] * $val['price'];
                    }
                    foreach ($userOrders as $key => $val){
                        if ($val['id_order'] === $orderId){
                            $userOrders[$key]['sum'] = $orderSum;                       
                        }
                    }
                }
            }
            return array($userOrders, $userGoods);
        }
        
        public function regUser($name, $login, $password) {
            $query = "SELECT * FROM users WHERE login = '" . $login . "'";
            $res = PdoM::Instance() -> Select($query);

            if (!$res) {
                $password = $this -> setPass($login, $password);
                $object = [
                    'name' => $name,
                    'login' => $login,
                    'password' => $password
                ];
                $res = PdoM::Instance() -> Insert('users', $object);

                if (is_numeric($res)) {
                    return 'Регистрация прошла успешно. Войдите в <a href="index.php?class=user&method=login">личный кабинет</a>';
                } else {
                    return "Регистрация прервалась ошибкой.";
                }
            } else {
                return "Пользователь уже существует.";
            }
        }
        
        public function login($login, $password) {
            $query = "SELECT * FROM users WHERE login='" . $login . "'";
            $res = PdoM::Instance() -> Select($query);

            foreach ($res as $key => $val) {
                if ($val) {
                    if ($val['password'] == $this -> setPass($login, $password)) {
                        $_SESSION['user_id'] = $val['id'];
                        header('Location: index.php?class=user&method=getUser');
                    } else {
                        return 'Пароль не верный!';
                    }
                } else {
                    return 'Пользователь с таким логином не зарегистрирован!';
                } 
            } 
        }
        
        public function logout() {
            unset($_SESSION["user_id"]); 
        }             
    }