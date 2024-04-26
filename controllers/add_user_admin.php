<?php
    include "db.php";

    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $phone = $_POST['phone'];
    $add_user = $_POST['add_user'];

    $str_user = "INSERT INTO `users` (`name`, `surname`, `email`, `number`, `password`, `role`, `created_at`, `updated_up`) VALUES ('$name', '$surname', '$email', '$phone', '$password', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);";

    $out_email = "SELECT * FROM `users` WHERE `email`='$email' OR `number`='$phone'";
    
    if ($add_user) {
        $run_email = mysqli_query($connect, $out_email);
        $ep = mysqli_num_rows($run_email);
        if ($ep == 0) {
            $run_user = mysqli_query($connect, $str_user);
            if ($run_user) {
                header("Location:/adminka.php");
            }
            else {
                $_SESSION['error']="Ошибка добавления!";
                header("Location:/adminka.php");
            }
        } else {
            $_SESSION['error']="Такой пользователь уже существует!";
            header("Location:/adminka.php");
        }
    }
?>