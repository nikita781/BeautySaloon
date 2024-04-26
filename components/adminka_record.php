<div class="container">
    <div class="admin">
        <div class="admin__title">Админ-панель</div>
        <?php
            if ($_SESSION['error']) {
                echo '<p class=admin__error>'.$_SESSION['error'].'</p>';
                unset($_SESSION['error']);
            }
        ?>
        <div class="admin__cont">
            <div class="admin__menu">
                <a href="/adminka.php" class="admin__menu-item">Главная</a>
                <a href="/adminka_stock.php" class="admin__menu-item">Акции</a>
                <a href="/adminka_spec.php" class="admin__menu-item">Специалисты</a>
                <a href="/adminka_serv.php" class="admin__menu-item">Сервисы</a>
                <a href="/adminka_record.php" class="admin__menu-item">Бронь</a>
                <a href="/adminka_blog.php" class="admin__menu-item">Блог</a>
                <a href="/adminka_callback.php" class="admin__menu-item">Обратный звонок</a>
            </div>
            <div class="admin__contant">
                <div class="admin__subtitle">Забронированные услуги</div>
                <table class="admin__table">
                    <tr>
                        <th class="admin__table-th">Пользователь</th>
                        <th class="admin__table-th">Мастер</th>
                        <th class="admin__table-th">Услуга</th>
                        <th class="admin__table-th">Время</th>
                        <th class="admin__table-th">Действия</th>
                    </tr>
                    <?php
                        $id_record_del = $_GET['id_record_del'];
                        if ($id_record_del) {
                            $str_del_record = "DELETE FROM `record` WHERE `id`='$id_record_del'";
                            $run_del_record = mysqli_query($connect, $str_del_record);
                        }

                        $str_record = "SELECT * FROM `record`";
                        $run_record = mysqli_query($connect, $str_record);
                        while ($record = mysqli_fetch_array($run_record)) {
                            $str_services = "SELECT * FROM `service_item` WHERE `id`='$record[id_services]'";
                            $run_services = mysqli_query($connect, $str_services);
                            $services = mysqli_fetch_array($run_services);
                            $str_user = "SELECT * FROM `users` WHERE `id`='$record[id_user]'";
                            $run_user = mysqli_query($connect, $str_user);
                            $user = mysqli_fetch_array($run_user);
                            $str_staff = "SELECT * FROM `staff` WHERE `id`='$record[id_staff]'";
                            $run_staff = mysqli_query($connect, $str_staff);
                            $staff = mysqli_fetch_array($run_staff);
                            echo '
                            <tr>
                                <td class=admin__table-td>'.$user['email'].'</td>
                                <td class=admin__table-td>'.$staff['surname'].' '.$staff['name'].'</td>
                                <td class=admin__table-td>'.$services['name'].'</td>
                                <td class=admin__table-td>'.$record['time'].' '.$record['data'].'</td>
                                <td class=admin__table-td>
                                <div class=admin__table-td-cont>
                                    <a href=adminka_record.php?id_record_del='.$record['id'].' class=admin__table-btn-red>Удалить</a>
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