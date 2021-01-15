<?php

    class PageC extends BaseC {
        public function index() {
            $this -> title .= ' | Главная';
            $this -> content = 'главный контент';
        }

        public function catalog() {
            $this -> title .= ' | Каталог';
            $getGoods = new PageM();
            $goods = $getGoods -> getGoods();

            $loader = new Twig_Loader_Filesystem('v'); 
            $twig = new Twig_Environment($loader); 
            $template = $twig -> loadTemplate('catalog.twig');
            $this->content = $template -> render(array('goods' => $goods));
        }

        public function good() {
            $getGood = new PageM();
            $good = $getGood -> getGood();

            $this -> title .= ' | Каталог | ' . $good['title'];

            $loader = new Twig_Loader_Filesystem('v'); 
            $twig = new Twig_Environment($loader); 
            $template = $twig -> loadTemplate('good.twig');
            $this->content = $template -> render(array('good' => $good));
        }
        
    }
