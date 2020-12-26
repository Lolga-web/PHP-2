<?php

    // Конттроллер страницы чтения.

    class C_Page extends C_Base {
        // нет конструктора в C_BASE, поэтому убрали конструктор из текущего класса
        
        public function action_index(){
            $this->title .= '::Главная';
            $this->content = $this->Template('v/v_index.php');	
        }

    }