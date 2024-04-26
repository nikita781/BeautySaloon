<?php
    include "controllers/db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/index.css">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    <title>Салон красоты</title>
</head>
<body>
    <div class="page_contant">
    <div class="header__glush"></div>
    <div class="header" id="header">
        <div class="header-container">
            <div class="header__head">
                <a href="tel:+71234567890" class="header__phone-container">
                    <img src="/assets/img/call.svg" alt="call">
                    <p class="header__phone">+7 (123) 456 78 90</p>
                </a>
                <div class="header__contact">
                    <div class="header__contact-callback openDialog">
                        <img src="/assets/img/callback.svg" alt="call">
                        <p>Обратный звонок</p>
                    </div>
                    <div class="dialog">
                    <div class="dialog__content">
                        <div class="dialog__title-cont">
                            <div class="dialog__title">Обратный звонок</div>
                            <img id="closeDialog" src="/assets/img/close.svg" alt="">
                        </div>
                        <form class="auvt__form" action="/controllers/add_callback.php" method="POST">
                            <input class="auvt__form-cont-input" type="text" name="name" placeholder="Ваше имя" required>
                            <input class="auvt__form-cont-input" type="number" name="phone" placeholder="Телефон" required>
                            <textarea class="auvt__form-cont-input auvt__form-cont-textarea" name="desc" placeholder="Сообщение" required></textarea>
                            <input class="auvt__form-submit" type="submit" name="add_user" value="Отправить" required>
                        </form>
                    </div>
                </div>
                </div>
            </div>
            <div class="header__main">
                <a href="/" class="header__logo">
                    <img src="/assets/img/logo.svg" alt="logo">
                    <p class="header__logo-name">BeautySaloon</p>
                </a>
                <div class="header__menu">
                    <ul>
                        <li><a href="/specialists.php">Специалисты</a></li>
                        <li><a href="/stock.php">Акции</a></li>
                        <li><a href="/contacts.php">Контакты</a></li>
                        <li><a href="/blog.php">Блог</a></li>
                        <?php
                            if ($_SESSION['user']) {
                                echo "
                                    <li><a href=/profile.php>Профиль</a></li>
                                ";
                                $user_email = $_SESSION['user'];
                                $str_email = "SELECT * FROM `users` WHERE `email`='$user_email'";
                                $run_email = mysqli_query($connect, $str_email);
                                $user = mysqli_fetch_array($run_email);

                                if ($user['role'] == 4) {
                                    echo "
                                        <li><a href=/adminka.php>Админ-панель</a></li>
                                    ";
                                } elseif ($user['role'] == 2) {
                                    echo "
                                        <li><a href=/work.php>Работа</a></li>
                                    ";
                                }
                            } else {
                                echo "
                                    <li><a href=/auvt.php>Войти</a></li>
                                ";
                            }
                        ?>
                    </ul>
                </div>
                <div id="burger_button" class="header__burger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
        <div id="menu_container" class="header__menu-phone">
            <div class="header__small">
                <a href="tel:+71234567890" class="header__phone-container">
                    <img src="/assets/img/call.svg" alt="call">
                    <p class="header__phone">+7 (123) 456 78 90</p>
                </a>
                <div class="header__contact-callback openDialog">
                    <img src="/assets/img/callback.svg" alt="call">
                    <p>Обратный звонок</p>
                </div>
                <div class="dialog">
                    <div class="dialog__content">
                        <div class="dialog__title-cont">
                            <div class="dialog__title">Обратный звонок</div>
                            <img id="closeDialog" src="/assets/img/close.svg" alt="">
                        </div>
                        <form class="auvt__form" action="/controllers/add_callback.php" method="POST">
                            <input class="auvt__form-cont-input" type="text" name="name" placeholder="Ваше имя" required>
                            <input class="auvt__form-cont-input" type="number" name="phone" placeholder="Телефон" required>
                            <textarea class="auvt__form-cont-input auvt__form-cont-textarea" name="desc" placeholder="Сообщение" required></textarea>
                            <input class="auvt__form-submit" type="submit" name="add_user" value="Отправить" required>
                        </form>
                    </div>
                </div>
                <div class="header__small-menu">
                    <ul>
                        <li><a href="/specialists.php">Специалисты</a></li>
                        <li><a href="/stock.php">Акции</a></li>
                        <li><a href="/contacts.php">Контакты</a></li>
                        <li><a href="/blog.php">Блог</a></li>
                        <?php
                            if ($_SESSION['user']) {
                                echo "
                                    <li><a href=/profile.php>Профиль</a></li>
                                ";
                                $user_email = $_SESSION['user'];
                                $str_email = "SELECT * FROM `users` WHERE `email`='$user_email'";
                                $run_email = mysqli_query($connect, $str_email);
                                $user = mysqli_fetch_array($run_email);

                                if ($user['role'] == 4) {
                                    echo "
                                        <li><a href=/adminka.php>Админ-панель</a></li>
                                    ";
                                }
                            } else {
                                echo "
                                    <li><a href=/auvt.php>Войти</a></li>
                                ";
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>