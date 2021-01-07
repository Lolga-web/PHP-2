<?php

    class PageM { 

        public function getGoods() {
            $query = "SELECT * FROM goods";
            $res = PdoM::Instance() -> Select($query);
            return $res;
        }
        
    }