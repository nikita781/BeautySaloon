<?php
    include "db.php";

    $email = $_POST['email'];
    $oldpassword = $_POST['oldpassword'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $phone = $_POST['phone'];
    $add_user = $_POST['add_user'];

    $user_email = $_SESSION['user'];
    $str_email = "SELECT * FROM `users` WHERE `email`='$user_email'";
    $run_email = mysqli_query($connect, $str_email);
    $user = mysqli_fetch_array($run_email);

    $str_user = "UPDATE `users` SET `name`='$name',`surname`='$surname',`email`='$email',`number`='$phone',`password`='$password',`updated_up`=CURRENT_TIMESTAMP WHERE $user[id]";
    
    if ($add_user) {
        if ($oldpassword == $user['password']) {
            if ($password == $repassword) {
                $run_user = mysqli_query($connect, $str_user);
                if ($run_user) {
                    $_SESSION['user']=$email;
                    header("Location:/profile.php");
                }
                else {
                    $_SESSION['error']="Ошибка добавления!";
                    header("Location:/update.php");
                }
            }
            else {
                $_SESSION['error']="Пароли не совпадают!";
                header("Location:/update.php");
            }
        } else {
            $_SESSION['error']="Неверный старый пароль!";
            header("Location:/update.php");
        }
    }
?>