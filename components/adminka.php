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
                <div class="admin__subtitle">Пользователи</div>
                <button class="admin__green openDialog">Добавить пользователя</button>
                <div class="dialog">
                    <div class="dialog__content">
                        <div class="dialog__title-cont">
                            <div class="dialog__title">Добавление пользователя</div>
                            <img id="closeDialog" src="/assets/img/close.svg" alt="">
                        </div>
                        <form class="auvt__form" action="/controllers/add_user_admin.php" method="POST">
                            <input class="auvt__form-cont-input" type="email" name="email" placeholder="Email" required>
                            <input class="auvt__form-cont-input" type="password" name="password" placeholder="Пароль" required>
                            <div class="auvt__form-name">
                                <input class="auvt__form-cont-input" type="text" name="name" placeholder="Имя" required>
                                <input class="auvt__form-cont-input" type="text" name="surname" placeholder="Фамилия" required>
                            </div>
                            <input class="auvt__form-cont-input" type="number" name="phone" placeholder="Телефон" required>
                            <input class="auvt__form-submit" type="submit" name="add_user" value="Зарегистрировать" required>
                        </form>
                    </div>
                </div>
                <table class="admin__table">
                    <tr>
                        <th class="admin__table-th">Имя</th>
                        <th class="admin__table-th">Фамилия</th>
                        <th class="admin__table-th">Почта</th>
                        <th class="admin__table-th">Телефон</th>
                        <th class="admin__table-th">Пароль</th>
                        <th class="admin__table-th">Роль</th>
                        <th class="admin__table-th">Действия</th>
                    </tr>
                    <?php
                        $id_update_ok = $_GET['id_update_ok'];
                        $id_user_del = $_GET['id_user_del'];
                        if ($id_user_del) {
                            $str_del_user = "DELETE FROM `users` WHERE `id`='$id_user_del'";
                            $run_del_user = mysqli_query($connect, $str_del_user);
                        }

                        $str_users = "SELECT * FROM `users`";
                        $run_users = mysqli_query($connect, $str_users);
                        while ($users = mysqli_fetch_array($run_users)) {
                            switch ($users['role']) {
                                case '1':
                                    $role = "Пользователь";
                                    break;
                                case '2':
                                    $role = "Мастер";
                                    break;
                                case '4':
                                    $role = "Администратор";
                                    break;
                                
                                default:
                                    $role = "Такого нет";
                                    break;
                            }
                            echo '
                            <tr>
                                <td class=admin__table-td>'.$users['name'].'</td>
                                <td class=admin__table-td>'.$users['surname'].'</td>
                                <td class=admin__table-td>'.$users['email'].'</td>
                                <td class=admin__table-td>'.$users['number'].'</td>
                                <td class=admin__table-td>'.$users['password'].'</td>
                                <td class=admin__table-td>'.$role.'</td>
                                <td class=admin__table-td>
                                    <div class=admin__table-td-cont>
                                        <a href=adminka.php?id_update_ok='.$users['id'].' class="admin__table-btn-green">Редактировать</a>
                                        <a href=adminka.php?id_user_del='.$users['id'].' class=admin__table-btn-red>Удалить</a>
                                    </div>
                                </td>
                            </tr>
                            ';
                        }
                    ?>
                </table>
                <div id="updateDialog" class="dialog">
                    <div class="dialog__content">
                        <div class="dialog__title-cont">
                            <div class="dialog__title">Изменение пользователя</div>
                            <img id="closeDialog" src="/assets/img/close.svg" alt="">
                        </div>
                        <?php
                            $id_user_ok = $_GET['id_update_ok'];
                            $str_user_ok = "SELECT * FROM `users` WHERE `id`='$id_user_ok'";
                            $run_user_ok = mysqli_query($connect, $str_user_ok);
                            $user_ok = mysqli_fetch_array($run_user_ok);
                        ?>
                        <form class="auvt__form" action="/controllers/update_user_admin.php" method="POST">
                            <input type="hidden" name="id" value="<?=$user_ok['id']?>">
                            <input class="auvt__form-cont-input" type="email" name="email" placeholder="Email" value="<?=$user_ok['email']?>" required>
                            <input class="auvt__form-cont-input" type="text" name="password" placeholder="Пароль" value="<?=$user_ok['password']?>" required>
                            <div class="auvt__form-name">
                                <input class="auvt__form-cont-input" type="text" name="name" placeholder="Имя" value="<?=$user_ok['name']?>" required>
                                <input class="auvt__form-cont-input" type="text" name="surname" placeholder="Фамилия" value="<?=$user_ok['surname']?>" required>
                            </div>
                            <input class="auvt__form-cont-input" type="number" name="phone" placeholder="Телефон" value="<?=$user_ok['number']?>" required>
                            <input class="auvt__form-submit" type="submit" name="add_user" value="Редактировать" required>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
    function getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        var results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    }

    var idUpdateOk = getUrlParameter('id_update_ok');
    if (idUpdateOk) {
        var dialog = document.getElementById('updateDialog');
        if (dialog) {
            dialog.style.display = 'flex';
        }
    }
});
</script>