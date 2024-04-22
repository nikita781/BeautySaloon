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
    <div class="header__glush"></div>
    <div class="header" id="header">
        <div class="header-container">
            <div class="header__head">
                <a href="tel:+71234567890" class="header__phone-container">
                    <img src="/assets/img/call.svg" alt="call">
                    <p class="header__phone">+7 (123) 456 78 90</p>
                </a>
                <div class="header__contact">
                    <div class="header__contact-callback">
                        <img src="/assets/img/callback.svg" alt="call">
                        <p>Обратный звонок</p>
                    </div>
                    <div class="header__contact-callback">
                        <img src="/assets/img/mail.svg" alt="callback">
                        <p>Напишите нам</p>
                    </div>
                </div>
            </div>
            <div class="header__main">
                <a href="/" class="header__logo">
                    <img src="/assets/img/logo.svg" alt="logo">
                    <p class="header__logo-name">Название</p>
                </a>
                <div class="header__menu">
                    <ul>
                        <li><a href="/specialists.php">Специалисты</a></li>
                        <li><a href="/stock.php">Акции</a></li>
                        <li><a href="/contacts.php">Контакты</a></li>
                        <li><a href="/blog.php">Блог</a></li>
                        <li>Страница</li>
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
                <div class="header__contact-callback">
                    <img src="/assets/img/callback.svg" alt="call">
                    <p>Обратный звонок</p>
                </div>
                <div class="header__contact-callback">
                    <img src="/assets/img/mail.svg" alt="callback">
                    <p>Напишите нам</p>
                </div>
                <div class="header__small-menu">
                    <ul>
                        <li><a href="/specialists.php">Специалисты</a></li>
                        <li><a href="/stock.php">Акции</a></li>
                        <li><a href="/contacts.php">Контакты</a></li>
                        <li><a href="/blog.php">Блог</a></li>
                        <li>Страница</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>