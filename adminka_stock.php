<?php
    include "controllers/db.php";

    if (!isset($_SESSION['user'])) {
        header("Location: /");
    } else {
        $user_email = $_SESSION['user'];
        $str_email = "SELECT * FROM `users` WHERE `email`='$user_email'";
        $run_email = mysqli_query($connect, $str_email);
        $user = mysqli_fetch_array($run_email);
        if ($user['role'] != 4) {
            header("Location: /");
        }
    }

    include 'components/header.php';
    include 'components/adminka_stock.php';
    include 'components/footer.php';
?>