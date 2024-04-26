<?php
    include "db.php";

    $id = $_POST['id'];
    $surname = $_POST['surname'];
    $name_s = $_POST['name'];
    $specialist = $_POST['specialist'];
    $service = $_POST['service'];
    $experience = $_POST['experience'];
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
            $str_spec = "UPDATE `staff` SET `surname`='$surname',`name`='$name_s',`id_specialist`='$specialist',`id_services`='$service',`photo`='$full_name',`experience`='$experience',`desc`='$desc' WHERE `id`='$id'";
            
            $run_spec = mysqli_query($connect, $str_spec);
            if ($run_spec) {
                header("Location:/adminka_spec.php");
            } else {
                $_SESSION['error'] = "Ошибка добавления!";
            }
        } else {
            $_SESSION['error'] = "Ошибка перемещения файла в папку назначения!";
        }
    } else {
        $_SESSION['error'] = "Файл не был загружен или размер файла равен нулю!";
    }

    header("Location:/adminka_spec.php");
?>
