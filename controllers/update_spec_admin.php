<?php
    include "db.php";

    $id = $_POST['id'];
    $name = $_POST['name'];
    $add_user = $_POST['add_user'];

    $str_user = "UPDATE `specialist` SET `name`='$name' WHERE `id`='$id'";
    
    if ($add_user) {
        $run_user = mysqli_query($connect, $str_user);
        if ($run_user) {
            header("Location:/adminka_spec.php");
        }
        else {
            $_SESSION['error']="Ошибка добавления!";
            header("Location:/adminka_spec.php");
        }
    }
?>