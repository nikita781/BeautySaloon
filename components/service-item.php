<div class="container">
    <div class="service">
        <div class="service__title">
            <?php
                $id = $_GET['id'];
                $query = "SELECT * FROM `service_item` WHERE `id` = $id";
                $result_run = mysqli_query($connect, $query);
                $result = mysqli_fetch_array($result_run);
                echo $result['name'];
            ?>
        </div>
        <div class="service__container">
            <?php
                $str_cat = "SELECT * FROM `services`";
                $run_cat = mysqli_query($connect, $str_cat);

                echo '<div class="accordion">';
                while ($cat = mysqli_fetch_array($run_cat)) {
                    echo '<div class="accordion-item">' . 
                            '<button class="accordion-button">' . '<a href=service.php?id=' . $cat['id'] . '>' . $cat['name_services'] . '</a></button>' . 
                            '<div class="accordion-content">';

                            $str_items = "SELECT * FROM service_item WHERE id_service = {$cat['id']}";
                            $run_items = mysqli_query($connect, $str_items);
                        
                            while ($item = mysqli_fetch_array($run_items)) {
                                echo '<button class="accordion-button-item">' . '<a href=service-item.php?id=' . $item['id'] . '>' . $item['name'] . '</a></button>';
                            }
                            
                            echo '</div>' . 
                        '</div>';
                }
                echo '</div>';
            ?>
            <div class="service__info">
                <p class="service__info-inf"><?=$result['description']?></p>
                <p class="service__info-price"><strong><?=$result['price']?> рублей</strong></p>
                    <?php
                        $str_points = "SELECT * FROM `procedure_points` WHERE `id_service`='$result[id]'";
                        $run_points = mysqli_query($connect, $str_points);
                        $count_points = mysqli_num_rows($run_points);
                        if ($count_points != 0) {
                            echo '<div class="service__subtitle">Описание процедуры</div>
                                    <ul>';
                                    while ($points = mysqli_fetch_array($run_points)) {
                                        echo '
                                            <li>'.$points['name'].': '.$points['description'].'</li>
                                        ';
                                    }
                            echo '</ul>
                            </div>';
                        }
                    ?>
                <?php
                    if ($_SESSION['user']) {
                        ?>
                            <div class="service__form">
                                <form class="service__form-form" method="POST">
                                    <p class="service__form-p">Выберите день записи:</p>
                                    <input class="service__form-input" type="date" name="day" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" required>
                                    <?php
                                        $str_out_spec = "SELECT * FROM `staff` WHERE `id_services`='$result[id_service]'";
                                        $run_out_spec = mysqli_query($connect, $str_out_spec);
                                    ?>
                                    <p class="service__form-p">Выберите специалиста:</p>
                                    <select name="specialist" class="service__form-input" style="width: 100%;" required>
                                        <?php
                                            while ($out_spec = mysqli_fetch_array($run_out_spec)) {
                                                echo '<option value='.$out_spec['id'].'>'.$out_spec['name'].' '.$out_spec['surname'].'</option>';
                                            }
                                        ?>
                                    </select>
                                    <div class="service__specialist-cont">
                                        <div class="service__specialist">
                                            <?php
                                                $str_staff = "SELECT * FROM `staff` WHERE `id_services`='$result[id_service]'";
                                                $run_staff = mysqli_query($connect, $str_staff);
                                                while ($staff = mysqli_fetch_array($run_staff)) {
                                                    $str_spec = "SELECT * FROM `specialist` WHERE `id`='$staff[id_specialist]'";
                                                    $run_spec = mysqli_query($connect, $str_spec);
                                                    $spec = mysqli_fetch_array($run_spec);

                                                    $experience = $staff['experience'];
                                                    if ($experience == 1) {
                                                        $years_word = 'год';
                                                    } elseif ($experience >= 2 && $experience <= 4) {
                                                        $years_word = 'года';
                                                    } else {
                                                        $years_word = 'лет';
                                                    }

                                                    echo '
                                                    <div class=service__specialist-item>
                                                        <img src=/assets/img/'.$staff['photo'].'>
                                                        <div class=service__specialist-info>
                                                            <p class=service__specialist-name>' . $staff['name'] . ' ' . $staff['surname'] . '</p>
                                                            <p class=service__specialist-name>Опыт работы: <strong>' . $experience . ' ' . $years_word . '</strong></p>
                                                            <p class=service__specialist-name>Квалификация</p>
                                                            <p class=service__specialist-name><strong>'.$spec['name'].'</strong></p>
                                                        </div>
                                                    </div>
                                                    ';
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <input class="service__form-submit" type="submit" value="Проверить время" name="out_of_day">
                                </form>
                                    <?php
                                        $day = $_POST['day'];
                                        $specialist = $_POST['specialist'];
                                        $out_of_day = $_POST['out_of_day'];
                                        $str_of_day = "SELECT * FROM `record` WHERE `data`='$day' AND `id_staff`='$specialist'";
                                        if ($out_of_day) {
                                            $_SESSION['specialist']=$specialist;
                                            $_SESSION['day']=$day;
                                            $run_of_day = mysqli_query($connect, $str_of_day);
                                            echo "
                                            <form method=POST class=service__form-form>
                                            <p class=service__form-p>Выберите время записи:</p>";
                                            echo "<select class=service__form-input name=time style=width:100%; required>";
                                            for ($hour = 8; $hour <= 22; $hour++) {
                                                $timeSlot = sprintf("%02d:00:00", $hour);
                                                $isBooked = false;
                                                while ($row = mysqli_fetch_assoc($run_of_day)) {
                                                    if ($row['time'] == $timeSlot) {
                                                        $isBooked = true;
                                                        break;
                                                    }
                                                }
                                                if (!$isBooked) {
                                                    $timeSl = substr($timeSlot, 0, 5);
                                                    echo "<option value='$timeSlot'>$timeSl</option>";
                                                }
                                            }
                                        
                                        echo "</select>";
                                    ?>
                                    <input class="service__form-submit" type="submit" value="Забронировать" name="add_record">
                                </form>
                                <?php }

                                    $time = $_POST['time'];
                                    $add_record = $_POST['add_record'];
                                    $user_email = $_SESSION['user'];
                                    $str_user_email = "SELECT * FROM `users` WHERE `email`='$user_email'";
                                    $run_user_email = mysqli_query($connect, $str_user_email);
                                    $user = mysqli_fetch_array($run_user_email);

                                    if (isset($add_record) && isset($_SESSION['specialist']) && isset($_SESSION['day'])) {
                                        $specc = $_SESSION['specialist'];
                                        $dayy = $_SESSION['day'];
                                        unset($_SESSION['specialist']);
                                        unset($_SESSION['day']);
                                        $str_record = "INSERT INTO `record`(`id_services`, `id_stock`, `id_user`, `id_staff`, `data`, `time`) VALUES ('$result[id]','0','$user[id]','$specc','$dayy','$time')";
                                        $run_record = mysqli_query($connect, $str_record);
                                        if ($run_record) {
                                            echo "<div class='service__form_mes-green'>Время забронировано</div>";
                                        } else {
                                            echo "<div class='service__form_mes-red'>Ошибка бронирования</div>";
                                        }
                                    }
                                ?>
                            </div>
                        <?php
                    } else {
                        ?>
                            <div class="service__form-cont">
                                <div class="service__form-title">
                                    <img src="/assets/img/person.svg" alt="">
                                    <strong>У вас еще нет аккаунта?</strong>
                                </div>
                                <p>Чтобы записаться на услугу вам нужно <a href="/auvt.php">авторизироваться</a> на сайте</p>
                            </div>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>