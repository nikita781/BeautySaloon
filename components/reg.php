<div class="auvt">
    <div class="auvt__contant">
        <a href="/" class="auvt__logo">
            <img src="/assets/img/logo.svg" alt="logo">
            <p class="auvt__logo-name">BeautySaloon</p>
        </a>
        <div class="auvt__form-cont">
            <div class="auvt__form-title">
                <img src="/assets/img/reg.svg" alt="">
                <strong>Регистрация</strong>
            </div>
            <form class="auvt__form" action="/controllers/add_user.php" method="POST">
                <input class="auvt__form-cont-input" type="email" name="email" placeholder="Email" required>
                <input class="auvt__form-cont-input" type="password" name="password" placeholder="Пароль" required>
                <input class="auvt__form-cont-input" type="password" name="repassword" placeholder="Повторите пароль" required>
                <div class="auvt__form-name">
                    <input class="auvt__form-cont-input" type="text" name="name" placeholder="Имя" required>
                    <input class="auvt__form-cont-input" type="text" name="surname" placeholder="Фамилия" required>
                </div>
                <input class="auvt__form-cont-input" type="number" name="phone" placeholder="Телефон" required>
                <input class="auvt__form-submit" type="submit" name="add_user" value="Зарегистрироваться" required>
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
                <strong>У вас уже есть аккаунт?</strong>
            </div>
            <p>Вы можете <a href="/auvt.php">авторизоваться</a> на сайте</p>
        </div>
    </div>
    <div class="auvt__image">

    </div>
</div>