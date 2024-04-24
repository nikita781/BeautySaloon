<?php
    include "db.php";

    $email = $_POST['email'];
    $password = $_POST['password'];
    $add_user = $_POST['add_user'];

    $str_user = "SELECT * FROM `users` WHERE `email`='$email' AND `password`='$password'";
    
    if ($add_user) {
        $run_user = mysqli_query($connect, $str_user);
        $user = mysqli_num_rows($run_user);
        if ($user != 0) {
            $_SESSION['user']=$email;
            header("Location:/");
        } else {
            $_SESSION['error']="Данные неверны!";
            header("Location:/auvt.php");
        }
    }
?>