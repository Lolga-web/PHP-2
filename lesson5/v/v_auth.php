<?php
/**
 * Шаблон авторизации
 * ================
 * $error - ошибки
 */
?>

<form class="login_form" action="m/m_auth.php" method="post">
    <p><?=$error?></p>
   
    <p class="login_form_title">Авторизация</p>

    <p class="login_form_text">Логин</p>
    <input class="login_form_input" type="text" name="login" value="<?= $_SESSION['login']?>" required="required">

    <p class="login_form_text">Пароль</p>
    <input class="login_form_input" type="password" name="pass" value="<?= $_SESSION['pass']?>" required="required">

    <input class="btn" type="submit" value="Войти">

    <a href="index.php?c=User&act=reg" id="reg" class="reg_link modal__btn">Регистрация</a>
</form>