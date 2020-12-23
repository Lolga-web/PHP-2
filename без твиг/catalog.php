<?php 
    include "config/config.php";
    include "models/pagination.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Ювелирная мастерская</title>
</head>
<body>

    <div class="container">

            <?php include 'templates/nav.php'; ?>

            <div class="catalog">

                <?php include "templates/catalogPagination.php"; ?>

                <div class="catalog_list">
                    <?php
                        $result = mysqli_query($connect, 'select * from goods where category='.$category.' limit '.$startPosition.', '.$pageLimit);
                        if ($result) {
                            while ($data = mysqli_fetch_assoc($result)) {
                                $productCategories = explode(',', $data['category']);
                                if(in_array($category, $productCategories)){ ?>
                                    <a class="catalog_item_link" href="#">
                                        <div class="catalog_item_wrp" id="id_<?= $data['id_good']?>">
                                            <div class="catalog_item_img_wrp">
                                                <img class="catalog_item_img" src="img/catalog/<?= $data['img']?>">
                                            </div>
                                            <p class="catalog_item_articul">Цена: <?=$data['price']?> p.</p>
                                        </div> 
                                    </a>
                            <?            
                                }
                            }
                        } else { ?>
                            <p class="empty_catalog_message">В данной категории ничего не найдено</p>
                        <? 
                        }                           
                    ?>
                </div>

            <?php include "templates/catalogPagination.php"; ?>
            
        </div>

    </div>

    
                                
</body>
</html>