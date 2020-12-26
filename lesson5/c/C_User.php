<?php
include_once "m/M_User.php";

    class C_User extends C_Base {
        
        public function action_auth(){
            $this->title .= '::Авторизация';
            if($_GET['error'] == 1) {
                $this->error = 'Неверный логин или пароль!';
            }
            $this->content = $this->Template('v/v_auth.php');
        }

        public function action_reg(){
            $this->title .= '::Регистрация';
            if($_GET['error'] == 2) {
                $this->error = 'Такой логин уже зарегистрирован!';
            }
            if($_GET['error'] == 3) {
                $this->error = 'Такой адрес электронной почты уже зарегистрирован!';
            }
            $this->content = $this->Template('v/v_reg.php');	
        }

        public function action_account(){
            $this->title .= '::Личный кабинет';
            $this->content = $this->Template('v/v_account.php');
        }
    }