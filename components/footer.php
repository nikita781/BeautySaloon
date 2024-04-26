</div>
<div class="footer container">
    <div class="footer__main">
        <div class="footer__logo">
            <img src="/assets/img/logo.svg" alt="logo">
            <p class="footer__logo-name">BeautySaloon</p>
        </div>
        <div class="footer__menu">
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
    </div>
    <div class="footer__contact">
        <div class="footer__contact-cont">
            <a href="#"><img src="/assets/img/facebook.png" alt=""></a>
            <a href="#"><img src="/assets/img/instagram.png" alt=""></a>
            <a href="#"><img src="/assets/img/twitter.png" alt=""></a>
        </div>
        <p>© 2024. «BeautySaloon» | ДИС213/21.Б</p>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="/js/slider.js"></script>
<script src="/js/accordion.js"></script>
<script src="/js/dialog.js"></script>
<script src="/js/header.js"></script>
</body>
</html>