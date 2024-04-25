<div class="auvt">
    <div class="auvt__contant">
        <a href="/" class="auvt__logo">
            <img src="/assets/img/logo.svg" alt="logo">
            <p class="auvt__logo-name">BeautySaloon</p>
        </a>
        <div class="auvt__form-cont">
            <div class="auvt__form-title">
                <img src="/assets/img/reg.svg" alt="">
                <strong>Заявка специалиста</strong>
            </div>
            <form class="auvt__form" action="/controllers/add_spec.php" method="POST" enctype="multipart/form-data">
                <input class="auvt__form-cont-input" type="file" name="avatar" placeholder="Ваша фотография" required>
                <textarea class="auvt__form-cont-input auvt__form-cont-textarea" name="desc" placeholder="Описание специалиста" required></textarea>
                <input class="auvt__form-cont-input" type="number" name="experience" placeholder="Опыт работы" required>
                <select class="service__form-input" name="specialist" style=width:100%; required>
                    <option value="" disabled selected>Выберите квалификацию</option>
                    <?php
                        $str_specialist = "SELECT * FROM `specialist`";
                        $run_specialist = mysqli_query($connect, $str_specialist);
                        while ($specialist = mysqli_fetch_array($run_specialist)) {
                            echo '
                            <option value='.$specialist['id'].'>'.$specialist['name'].'</option>
                            ';
                        }
                    ?>
                </select>
                <select class="service__form-input" name="services" style=width:100%; required>
                    <option value="" disabled selected>Выберите категорию услуг</option>
                    <?php
                        $str_services = "SELECT * FROM `services`";
                        $run_services = mysqli_query($connect, $str_services);
                        while ($services = mysqli_fetch_array($run_services)) {
                            echo '
                            <option value='.$services['id'].'>'.$services['name_services'].'</option>
                            ';
                        }
                    ?>
                </select>
                <input class="auvt__form-submit" type="submit" name="add_spec" value="Подать заявку" required>
                <p style="color: red;"><?php
                    if ($_SESSION['error']) {
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    }
                ?></p>
            </form>
        </div>
    </div>
    <div class="auvt__image">

    </div>
</div>