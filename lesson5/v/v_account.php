
<?php session_start(); ?>

<div class="account">

    <? if (isset($_SESSION['userName'])){
            $login = $_SESSION['userName'];
            if ($login !== 1 && $login !== 2 && $login !== 3) { ?>
                <p>Привет, <?=$login?></p>  
                <a class="btn account_logout" href="m/m_logout.php">Выйти</a>     
        <?php 
            } else { ?>
                <p style="color: red;">Необходимо авторизоваться</p>
        <?}
        } else { ?>
            <p style="color: red;">Необходимо авторизоваться</p>
    <? } ?>

</div>