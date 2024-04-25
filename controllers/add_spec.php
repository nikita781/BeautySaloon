<?php
    include "db.php";

    $desc = $_POST['desc'];
    $experience = $_POST['experience'];
    $specialist = $_POST['specialist'];
    $services = $_POST['services'];
    $add_spec = $_POST['add_spec'];

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

    // Перемещаем файл в папку только если загрузка прошла успешно и была нажата кнопка "Добавить специалиста"
    if ($add_spec && $size > 0) {
        // Перемещаем файл в папку
        if (move_uploaded_file($tmp_path, $_SERVER['DOCUMENT_ROOT'] . $path)) {
            $user_email = $_SESSION['user'];
            $str_email = "SELECT * FROM `users` WHERE `email`='$user_email'";
            $run_email = mysqli_query($connect, $str_email);
            $user = mysqli_fetch_array($run_email);

            $str_spec = "INSERT INTO `application_spec`(`name`, `surname`, `id_specialist`, `id_services`, `photo`, `experience`, `desc`, `id_user`) VALUES ('$user[name]','$user[surname]','$specialist','$services','$full_name','$experience','$desc','$user[id]')";
            
            // Выполняем запрос на добавление специалиста в базу данных
            $run_spec = mysqli_query($connect, $str_spec);
            if ($run_spec) {
                header("Location:/profile.php");
                exit(); // Завершаем скрипт после перенаправления
            } else {
                $_SESSION['error'] = "Ошибка добавления!";
            }
        } else {
            $_SESSION['error'] = "Ошибка перемещения файла в папку назначения!";
        }
    } else {
        $_SESSION['error'] = "Файл не был загружен или размер файла равен нулю!";
    }

    // Если что-то пошло не так, перенаправляем пользователя на страницу с формой регистрации специалиста
    header("Location:/reg_spec.php");
?>
