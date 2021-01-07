<?php

    class UserM { 
        protected $good_id, $user_login, $user_name, $user_password;
        
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