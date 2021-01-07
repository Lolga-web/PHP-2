<?php

    class PageC extends BaseC {
        public function index() {
            $this -> title .= ' | Главная';
            $this -> content = 'главный контент';
        }

        public function catalog() {
            $this -> title .= ' | Каталог';
            $get_goods = new PageM();
            $goods = $get_goods -> getGoods();

            $loader = new Twig_Loader_Filesystem('v'); 
            $twig = new Twig_Environment($loader); 
            $template = $twig -> loadTemplate('catalog.twig');
            $this->content = $template -> render(array('goods' => $goods));
        }
        
    }
