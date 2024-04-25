<div class="container">
    <div class="work">
        <div class="work__title">Ваша работа</div>
        <div class="service__form">
            <form class="service__form-form" method="POST">
                <p class="service__form-p">Выберите день работы:</p>
                <input class="service__form-input" type="date" name="day" required>
                <input class="service__form-submit" type="submit" value="Подтвердить" name="out_of_day">
            </form>
            <?php
                $day = $_POST['day'];
                $out_of_day = $_POST['out_of_day'];
                if ($out_of_day) {
                    echo "<div class=work__cont>";
                    $user_email = $_SESSION['user'];
                    $str_email = "SELECT * FROM `users` WHERE `email`='$user_email'";
                    $run_email = mysqli_query($connect, $str_email);
                    $user = mysqli_fetch_array($run_email);

                    $str_staff = "SELECT * FROM `staff` WHERE `id_user`='$user[id]'";
                    $run_staff = mysqli_query($connect, $str_staff);
                    $staff = mysqli_fetch_array($run_staff);

                    $str_record = "SELECT * FROM `record` WHERE `id_staff`='$staff[id]' AND `data`='$day'";
                    $run_record = mysqli_query($connect, $str_record);
                    while ($record = mysqli_fetch_array($run_record)) {
                        $str_services = "SELECT * FROM `service_item` WHERE `id`='$record[id_services]'";
                        $run_services = mysqli_query($connect, $str_services);
                        $services = mysqli_fetch_array($run_services);
                        $str_user_rec = "SELECT * FROM `users` WHERE `id`='$record[id_user]'";
                        $run_user_rec = mysqli_query($connect, $str_user_rec);
                        $user_rec = mysqli_fetch_array($run_user_rec);
                        $timeSl = substr($record['time'], 0, 5);
                        echo '
                            <div class=work__cont-item>
                                <img src=/assets/img/'.$services['photo'].'>
                                <p>'.$services['name'].'</p>
                                <p>'.$user_rec['surname'].' '.$user_rec['name'].'</p>
                                <p>'.$timeSl.'</p>
                            </div>
                        ';
                    }
                    echo "</div>";
                }
            ?>
        </div>
    </div>
</div>