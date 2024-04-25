<div class="container">
    <div class="profile">
        <div class="profile__title">Профиль</div>
        <div class="profile__cont">
            <div class="profile__record">
                <div class="profile__subtitle">Ваши бронирования</div>
                <?php
                    $user_email = $_SESSION['user'];
                    $str_email = "SELECT * FROM `users` WHERE `email`='$user_email'";
                    $run_email = mysqli_query($connect, $str_email);
                    $user = mysqli_fetch_array($run_email);

                    $str_record = "SELECT * FROM `record` WHERE `id_user`='$user[id]'";
                    $run_record = mysqli_query($connect, $str_record);
                    $count_record = mysqli_num_rows($run_record);
                    if ($count_record != 0) {
                        while ($record = mysqli_fetch_array($run_record)) {
                            $str_staff = "SELECT * FROM `staff` WHERE `id`='$record[id_staff]'";
                            $run_staff = mysqli_query($connect, $str_staff);
                            $staff = mysqli_fetch_array($run_staff);
                            $str_serv = "SELECT * FROM `service_item` WHERE `id`='$record[id_services]'";
                            $run_serv = mysqli_query($connect, $str_serv);
                            $serv = mysqli_fetch_array($run_serv);
                            $timeSl = substr($record['time'], 0, 5);
                            echo '
                            <div class=profile__record-item>
                                <img src=/assets/img/'.$staff['photo'].' alt=>
                                <div class=profile__record-info>
                                    <p>'.$serv['name'].'</p>
                                    <p>'.$timeSl.'  '.$record['data'].'</p>
                                </div>
                            </div>
                            ';                        
                        }
                    } else {
                        echo '
                        <div class=profile__record-item>
                            <p>Записей пока нет</p>
                        </div>
                        ';  
                    }
                ?>
            </div>
            <div class="profile__info">
                <div class="profile__subtitle">Ваши данные</div>
                <div class="profile__info-cont">
                    <div class="profile__info-contact">
                        <p><strong><?=$user['name']?> <?=$user['surname']?></strong></p>
                        <p>Номер телефона: <strong><?=$user['number']?></strong></p>
                        <p>Почта: <strong><?=$user['email']?></strong></p>
                    </div>
                    <div class="profile__info-btns">
                        <a href="/update.php" class="profile__info-btn-update">Изменить</a>
                        <a href="/controllers/exit.php" class="profile__info-btn-exit">Выйти</a>
                    </div>
                </div>
                <?php
                    if ($user['role'] == 1) {
                ?>
                    <div class="service__form-cont">
                        <div class="service__form-title">
                            <img src="/assets/img/person.svg" alt="">
                            <strong>Вы являетесь специалистом?</strong>
                        </div>
                        <p>Вы можете <a href="/reg_spec.php">устроиться</a> к нам в дружный коллетив</p>
                    </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>