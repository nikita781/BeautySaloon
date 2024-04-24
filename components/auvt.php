<div class="auvt">
    <div class="auvt__contant">
        <a href="/" class="auvt__logo">
            <img src="/assets/img/logo.svg" alt="logo">
            <p class="auvt__logo-name">BeautySaloon</p>
        </a>
        <div class="auvt__form-cont">
            <div class="auvt__form-title">
                <img src="/assets/img/reg.svg" alt="">
                <strong>Авторизация</strong>
            </div>
            <form class="auvt__form" action="/controllers/auth_user.php" method="POST">
                <input class="auvt__form-cont-input" type="email" name="email" placeholder="Email" required>
                <input class="auvt__form-cont-input" type="password" name="password" placeholder="Пароль" required>
                <input class="auvt__form-submit" type="submit" name="add_user" value="Авторизация" required>
                <p style="color: red;"><?php
                    if ($_SESSION['error']) {
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    }
                ?></p>
            </form>
        </div>
        <div class="auvt__form-cont">
            <div class="auvt__form-title">
                <img src="/assets/img/person.svg" alt="">
                <strong>У вас еще нет аккаунта?</strong>
            </div>
            <p>Вы можете <a href="/reg.php">зарегистрироваться</a> на сайте</p>
        </div>
    </div>
    <div class="auvt__image">

    </div>
</div>