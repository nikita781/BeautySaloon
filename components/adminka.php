<div class="container">
    <div class="admin">
        <div class="admin__title">Админ-панель</div>
        <div class="admin__cont">
            <div class="admin__menu">
                <a href="/adminka.php" class="admin__menu-item">Главная</a>
                <a href="/adminka.php" class="admin__menu-item">Главная</a>
                <a href="/adminka.php" class="admin__menu-item">Главная</a>
                <a href="/adminka.php" class="admin__menu-item">Главная</a>
                <a href="/adminka.php" class="admin__menu-item">Главная</a>
            </div>
            <div class="admin__contant">
                <div class="admin__subtitle">Заявки на работу</div>
                <table class="admin__table">
                    <tr>
                        <th class="admin__table-th">Фото</th>
                        <th class="admin__table-th">Имя</th>
                        <th class="admin__table-th">Фамилия</th>
                        <th class="admin__table-th">Описание</th>
                        <th class="admin__table-th">Опыт работы</th>
                        <th class="admin__table-th">Квалификация</th>
                        <th class="admin__table-th">Услуга</th>
                        <th class="admin__table-th">Действия</th>
                    </tr>
                    <?php
                        $id_app_del = $_GET['id_app_del'];
                        $id_app_ok = $_GET['id_app_ok'];
                        if ($id_app_del) {
                            $str_del_app = "DELETE FROM `application_spec` WHERE `id`='$id_app_del'";
                            $run_del_app = mysqli_query($connect, $str_del_app);
                        }
                        if ($id_app_ok) {
                            $str_app = "SELECT * FROM `application_spec` WHERE `id`='$id_app_ok'";
                            $run_app = mysqli_query($connect, $str_app);
                            $app = mysqli_fetch_array($run_app);
                            $str_app_ok = "INSERT INTO `staff`(`surname`, `name`, `id_user`, `id_specialist`, `id_services`, `photo`, `experience`, `desc`) VALUES ('$app[surname]','$app[name]','$app[id_user]','$app[id_specialist]','$app[id_services]','$app[photo]','$app[experience]','$app[desc]')";
                            $run_app_ok = mysqli_query($connect, $str_app_ok);
                            $up_app = "UPDATE `users` SET `role`='2',`updated_up`=CURRENT_TIMESTAMP WHERE `id`='$app[id_user]'";
                            $up_run = mysqli_query($connect, $up_app);
                            if ($run_app_ok && $up_run) {
                                $str_del_app = "DELETE FROM `application_spec` WHERE `id`='$id_app_ok'";
                                $run_del_app = mysqli_query($connect, $str_del_app);
                            }
                        }

                        $str_application = "SELECT * FROM `application_spec`";
                        $run_application = mysqli_query($connect, $str_application);
                        while ($application = mysqli_fetch_array($run_application)) {
                            $str_specialist = "SELECT * FROM `specialist` WHERE `id`='$application[id_specialist]'";
                            $run_specialist = mysqli_query($connect, $str_specialist);
                            $specialist = mysqli_fetch_array($run_specialist);
                            $str_services = "SELECT * FROM `services` WHERE `id`='$application[id_services]'";
                            $run_services = mysqli_query($connect, $str_services);
                            $services = mysqli_fetch_array($run_services);
                            echo '
                            <tr>
                                <td class=admin__table-td>
                                    <img src=/assets/img/'.$application['photo'].' alt=>
                                </td>
                                <td class=admin__table-td>'.$application['name'].'</td>
                                <td class=admin__table-td>'.$application['surname'].'</td>
                                <td class=admin__table-td>'.$application['desc'].'</td>
                                <td class=admin__table-td>'.$application['experience'].'</td>
                                <td class=admin__table-td>'.$specialist['name'].'</td>
                                <td class=admin__table-td>'.$services['name_services'].'</td>
                                <td class=admin__table-td>
                                    <div class=admin__table-td-cont>
                                        <a href=adminka.php?id_app_ok='.$application['id'].' class=admin__table-btn-green>Принять</a>
                                        <a href=adminka.php?id_app_del='.$application['id'].' class=admin__table-btn-red>Отклонить</a>
                                    </div>
                                </td>
                            </tr>
                            ';
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>