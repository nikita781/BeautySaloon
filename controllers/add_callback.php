<?php
    include "db.php";

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $desc = $_POST['desc'];
    $add_user = $_POST['add_user'];

    $str_user = "INSERT INTO `callback`(`name`, `phone`, `description`) VALUES ('$name','$phone','$desc')";
    
    if ($add_user) {
        $run_user = mysqli_query($connect, $str_user);
        if ($run_user) {
            header("Location:/");
        }
    }
?>