<?php
    include "db.php";

    $id = $_POST['id'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $phone = $_POST['phone'];
    $add_user = $_POST['add_user'];

    $str_user = "UPDATE `users` SET `name`='$name',`surname`='$surname',`email`='$email',`number`='$phone',`password`='$password',`updated_up`=CURRENT_TIMESTAMP WHERE `id`='$id'";
    
    if ($add_user) {
        $run_user = mysqli_query($connect, $str_user);
        if ($run_user) {
            header("Location:/adminka.php");
        }
        else {
            $_SESSION['error']="Ошибка добавления!";
            header("Location:/adminka.php");
        }
    }
?>