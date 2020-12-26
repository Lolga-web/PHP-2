<?
class M_User {
	function auth($login,$pass){
        include "config.php";

        $sql = "select id from users where login='$login' and pass='$pass'";
        $res = mysqli_query($connect,$sql) or die("Error: ".mysqli_error($connect));

        if(mysqli_num_rows($res) == 1){
            $_SESSION['userName'] = $login;
            header("Location: ../index.php?act=account&c=User");
        }
        else{
            $_SESSION['userName'] = 1; // "Неверный логин или пароль!"
            header("Location: ../index.php?act=auth&c=User&error=1");
        }
    }

    function reg($login,$pass,$name,$email){
        include "config.php";

        $result = mysqli_query($connect, "SELECT id FROM users WHERE login='$login';");
        $myrow = mysqli_fetch_array($result);
        if (!empty($myrow['id'])) {
            $_SESSION['userName'] = 2; // "Такой логин уже зарегистрирован!"
            header("location: ../index.php?act=reg&c=User&error=2");
            exit();
        }

        $result = mysqli_query($connect, "SELECT id FROM users WHERE email='$email';");
        $myrow = mysqli_fetch_array($result);
        if (!empty($myrow['id'])) {
            $_SESSION['userName'] = 3; // "Такой адрес электронной почты уже зарегистрирован!"
            header("location: ../index.php?act=reg&c=User&error=3");
            exit();
        }

        mysqli_query($connect, "INSERT INTO users(login, pass, name, email, status) VALUES ('$login', '$pass', '$name', '$email', 'user')");
        $_SESSION['userName'] = $login;
        header("location: ../index.php?act=account&c=User");
    }

}