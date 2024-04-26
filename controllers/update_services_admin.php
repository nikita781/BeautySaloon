<?php
    include "db.php";

    $id = $_POST['id'];
    $name_c = $_POST['name'];
    $desc = $_POST['desc'];
    $add_user = $_POST['add_user'];

    $name = $_FILES['avatar']['name'];
    $type = $_FILES['avatar']['type'];
    $tmp_path = $_FILES['avatar']['tmp_name'];
    $size = $_FILES['avatar']['size'];

    $rand = rand(200,600);
    $Ext = explode('.', $name);
    $name = $Ext['0'];
    $Ext = $Ext['1'];
    $full_name = "$name" . "_$rand" . ".$Ext";
    $path = "/assets/img/$full_name";

    if ($add_user && $size > 0) {
        if (move_uploaded_file($tmp_path, $_SERVER['DOCUMENT_ROOT'] . $path)) {
            $str_spec = "UPDATE `services` SET `name_services`='$name_c',`description`='$desc',`photo`='$full_name' WHERE `id`='$id'";
            
            $run_spec = mysqli_query($connect, $str_spec);
            if ($run_spec) {
                header("Location:/adminka_serv.php");
                exit();
            } else {
                $_SESSION['error'] = "Ошибка добавления!";
            }
        } else {
            $_SESSION['error'] = "Ошибка перемещения файла в папку назначения!";
        }
    } else {
        $_SESSION['error'] = "Файл не был загружен или размер файла равен нулю!";
    }

    header("Location:/adminka_serv.php");
?>
