<div class="auvt">
    <div class="auvt__contant">
        <a href="/" class="auvt__logo">
            <img src="/assets/img/logo.svg" alt="logo">
            <p class="auvt__logo-name">BeautySaloon</p>
        </a>
        <div class="auvt__form-cont">
            <div class="auvt__form-title">
                <img src="/assets/img/reg.svg" alt="">
                <strong>Редактирование данных</strong>
            </div>
            <?php
                $user_email = $_SESSION['user'];
                $str_email = "SELECT * FROM `users` WHERE `email`='$user_email'";
                $run_email = mysqli_query($connect, $str_email);
                $user = mysqli_fetch_array($run_email);
            ?>
            <form class="auvt__form" action="/controllers/update_user.php" method="POST">
                <input class="auvt__form-cont-input" type="email" name="email" placeholder="Email" value="<?=$user['email']?>" required>
                <input class="auvt__form-cont-input" type="password" name="oldpassword" placeholder="Старый пароль" required>
                <input class="auvt__form-cont-input" type="password" name="password" placeholder="Новый пароль" required>
                <input class="auvt__form-cont-input" type="password" name="repassword" placeholder="Повторите пароль" required>
                <div class="auvt__form-name">
                    <input class="auvt__form-cont-input" type="text" name="name" placeholder="Имя" value="<?=$user['name']?>" required>
                    <input class="auvt__form-cont-input" type="text" name="surname" placeholder="Фамилия" value="<?=$user['surname']?>" required>
                </div>
                <input class="auvt__form-cont-input" type="number" name="phone" placeholder="Телефон" value="<?=$user['number']?>" required>
                <input class="auvt__form-submit" type="submit" name="add_user" value="Редактировать" required>
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
                <strong>Не хотите менять данные?</strong>
            </div>
            <p>Вы можете перейти в <a href="/profile.php">профиль</a> на сайте</p>
        </div>
    </div>
    <div class="auvt__image">

    </div>
</div>