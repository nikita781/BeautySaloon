<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: /");
}

include 'components/header.php';
include 'components/slider.php';
include 'components/profile.php';
include 'components/miniblog.php';
include 'components/footer.php';
?>