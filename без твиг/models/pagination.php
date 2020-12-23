<?php

    // Функция получает данные для формирования пагинации страниц каталога, возвращает массив с переменными:
    // $pageLimit - количество отображаемых данных из БД
    // $category - категория товара
    // $page - текущая страница
    // $productsCount - количество записей в БД по категории
    // $pagesCount - количество страниц
    // $startPosition - начальная позиция, для запроса к БД
    function pageCount() {
        include "config/config.php";

        $pageLimit = 10;
        $category = $_GET['category']; 

        if (empty(@$_GET['page']) || ($_GET['page'] <= 0)) {
            $page = 1;
        } else {
            $page = (int) $_GET['page']; 
        }

        $productsCount = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM goods WHERE `category`=$category"));
        $pagesCount = ceil($productsCount / $pageLimit); 

        // Если номер страницы оказался больше количества страниц
        if ($page > $pagesCount) $page = $pagesCount;

        $startPosition = ($page - 1) * $pageLimit;

        return array($page, $pageLimit, $pagesCount, $startPosition, $category);
    }
    
    // Функция выводит пагинацию
    function pageNumbers($page, $pagesCount, $category){         

        if ($page == 1) { ?> 
            <a class="catalog_pagination_prev">&laquo</a>
        <? } else {
            $arrowLeft = $page - 1; ?>
            <a class="catalog_pagination_prev" href="?category=<?=$category?>&page=<?=$arrowLeft?>">&laquo</a>
        <? } 

        for ($i = 1; $i <= $pagesCount; $i++){
            if ($i == $page) { ?>
                <a class="catalog_pagination_link catalog_pagination_active show"><?=$i?></a>
            <? } elseif ($page <= 5) {
                    if ($i <= 9){ ?>
                        <a class="catalog_pagination_link show" href="?category=<?=$category?>&page=<?=$i?>"><?=$i?></a>
                    <? } else { ?>
                        <a class="catalog_pagination_link hide" href="?category=<?=$category?>&page=<?=$i?>"><?=$i?></a>
                        <? }    
            } elseif ($page > 5 && $page <= ($pagesCount - 4)){
                if(($page - 5) < $i && $i < ($page + 5)) { ?>
                    <a class="catalog_pagination_link show" href="?category=<?=$category?>&page=<?=$i?>"><?=$i?></a>
                <? } else { ?>
                    <a class="catalog_pagination_link hide" href="?category=<?=$category?>&page=<?=$i?>"><?=$i?></a>
                <? } 
            } elseif ($page > ($pagesCount - 4)) {
                if(($pagesCount - 9) < $i && $i <= $pagesCount) { ?>
                    <a class="catalog_pagination_link show" href="?category=<?=$category?>&page=<?=$i?>"><?=$i?></a>
                <? } else { ?>
                    <a class="catalog_pagination_link hide" href="?category=<?=$category?>&page=<?=$i?>"><?=$i?></a>
                <? }     
            }
        }

        if ($page == $pagesCount) { ?>
            <a class="catalog_pagination_next">&raquo;</a>
        <? } else {
            $arrowRight = $page + 1; ?>
            <a class="catalog_pagination_next" href="?category=<?=$category?>&page=<?=$arrowRight?>">&raquo;</a>
        <? }
        
        return true;
    }
?>