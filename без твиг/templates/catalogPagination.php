
<div class="catalog_pagination">
    <div class="catalog_pagination_list">

        <?php  
            $page = pageCount()[0];
            $pageLimit = pageCount()[1]; 
            $pagesCount = pageCount()[2]; 
            $startPosition = pageCount()[3];
            $category = pageCount()[4]; 

            if ($pagesCount != 0) {
                pageNumbers($page, $pagesCount, $category); 
            };         
        ?>

    </div>
</div>