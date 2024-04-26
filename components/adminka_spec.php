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
                <div class="admin__subtitle">Квалификации</div>
                <button class="admin__green openDialog">Добавить квалификацию</button>
                <div class="dialog">
                    <div class="dialog__content">
                        <div class="dialog__title-cont">
                            <div class="dialog__title">Добавление квалификации</div>
                            <img id="closeDialog" src="/assets/img/close.svg" alt="">
                        </div>
                        <form class="auvt__form" action="/controllers/add_spec_admin.php" method="POST">
                            <input class="auvt__form-cont-input" type="text" name="name" placeholder="Название" required>
                            <input class="auvt__form-submit" type="submit" name="add_user" value="Зарегистрировать" required>
                        </form>
                    </div>
                </div>
                <table class="admin__table">
                    <tr>
                        <th class="admin__table-th">Название</th>
                        <th class="admin__table-th">Действия</th>
                    </tr>
                    <?php
                        $id_spec_ok = $_GET['id_spec_ok'];
                        $id_spec_del = $_GET['id_spec_del'];
                        if ($id_spec_del) {
                            $str_del_spec = "DELETE FROM `specialist` WHERE `id`='$id_spec_del'";
                            $run_del_spec = mysqli_query($connect, $str_del_spec);
                        }

                        $str_spec = "SELECT * FROM `specialist`";
                        $run_spec = mysqli_query($connect, $str_spec);
                        while ($spec = mysqli_fetch_array($run_spec)) {
                            echo '
                            <tr>
                                <td class=admin__table-td>'.$spec['name'].'</td>
                                <td class=admin__table-td>
                                    <div class=admin__table-td-cont>
                                        <a href=adminka_spec.php?id_spec_ok='.$spec['id'].' class=admin__table-btn-green>Редактировать</a>
                                        <a href=adminka_spec.php?id_spec_del='.$spec['id'].' class=admin__table-btn-red>Удалить</a>
                                    </div>
                                </td>
                            </tr>
                            ';
                        }
                    ?>
                </table>
                <div class="dialog" id="updateDialog">
                    <div class="dialog__content">
                        <div class="dialog__title-cont">
                            <div class="dialog__title">Редактирование акции</div>
                            <img id="closeDialog" src="/assets/img/close.svg" alt="">
                        </div>
                        <?php
                            $id_user_ok = $_GET['id_spec_ok'];
                            $str_user_ok = "SELECT * FROM `specialist` WHERE `id`='$id_user_ok'";
                            $run_user_ok = mysqli_query($connect, $str_user_ok);
                            $user_ok = mysqli_fetch_array($run_user_ok);
                        ?>
                        <form class="auvt__form" action="/controllers/update_spec_admin.php" method="POST">
                            <input type="hidden" name="id" value="<?=$user_ok['id']?>">
                            <input class="auvt__form-cont-input" value="<?=$user_ok['name']?>" type="text" name="name" placeholder="Название" required>
                            <input class="auvt__form-submit" type="submit" name="add_user" value="Редактировать" required>
                        </form>
                    </div>
                </div>
                <div class="admin__subtitle">Специалисты</div>
                <table class="admin__table">
                    <tr>
                        <th class="admin__table-th">Фото</th>
                        <th class="admin__table-th">Фамилия</th>
                        <th class="admin__table-th">Имя</th>
                        <th class="admin__table-th">Квалификация</th>
                        <th class="admin__table-th">Услуги</th>
                        <th class="admin__table-th">Стаж</th>
                        <th class="admin__table-th">Описание</th>
                        <th class="admin__table-th">Действия</th>
                    </tr>
                    <?php
                        $id_staff_ok = $_GET['id_staff_ok'];
                        $id_staff_del = $_GET['id_staff_del'];
                        if ($id_staff_del) {
                            $str_st = "SELECT * FROM `staff` WHERE `id`='$id_staff_del'";
                            $run_st = mysqli_query($connect, $str_st);
                            $st = mysqli_fetch_array($run_st);
                            $str_user = "UPDATE `users` SET `role`='1',`updated_up`=CURRENT_TIMESTAMP WHERE `id`='$st[id_user]'";
                            $run_user = mysqli_query($connect, $str_user);
                            $str_del_staff = "DELETE FROM `staff` WHERE `id`='$id_staff_del'";
                            $run_del_staff = mysqli_query($connect, $str_del_staff);
                        }

                        $str_staff = "SELECT * FROM `staff`";
                        $run_staff = mysqli_query($connect, $str_staff);
                        while ($staff = mysqli_fetch_array($run_staff)) {
                            $str_specialist = "SELECT * FROM `specialist` WHERE `id`='$staff[id_specialist]'";
                            $run_specialist = mysqli_query($connect, $str_specialist);
                            $specialist = mysqli_fetch_array($run_specialist);
                            $str_serv = "SELECT * FROM `service_item` WHERE `id`='$staff[id_services]'";
                            $run_serv = mysqli_query($connect, $str_serv);
                            $serv = mysqli_fetch_array($run_serv);
                            echo '
                            <tr>
                                <td class=admin__table-td>
                                    <img src=/assets/img/'.$staff['photo'].' alt=>
                                </td>
                                <td class=admin__table-td>'.$staff['surname'].'</td>
                                <td class=admin__table-td>'.$staff['name'].'</td>
                                <td class=admin__table-td>'.$specialist['name'].'</td>
                                <td class=admin__table-td>'.$serv['name'].'</td>
                                <td class=admin__table-td>'.$staff['experience'].'</td>
                                <td class=admin__table-td>'.$staff['desc'].'</td>
                                <td class=admin__table-td>
                                    <div class=admin__table-td-cont>
                                        <a href=adminka_spec.php?id_staff_ok='.$staff['id'].' class=admin__table-btn-green>Редактировать</a>
                                        <a href=adminka_spec.php?id_staff_del='.$staff['id'].' class=admin__table-btn-red>Уволить</a>
                                    </div>
                                </td>
                            </tr>
                            ';
                        }
                    ?>
                </table>
                <div class="dialog" id="updateDialogStaff">
                    <div class="dialog__content">
                        <div class="dialog__title-cont">
                            <div class="dialog__title">Редактирование акции</div>
                            <img id="closeDialog" src="/assets/img/close.svg" alt="">
                        </div>
                        <?php
                            $id_user_ok = $_GET['id_staff_ok'];
                            $str_user_ok = "SELECT * FROM `staff` WHERE `id`='$id_user_ok'";
                            $run_user_ok = mysqli_query($connect, $str_user_ok);
                            $user_ok = mysqli_fetch_array($run_user_ok);
                        ?>
                        <form class="auvt__form" action="/controllers/update_staff_admin.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?=$user_ok['id']?>">
                            <input class="auvt__form-cont-input" type="file" name="avatar" placeholder="Ваша фотография" required>
                            <input class="auvt__form-cont-input" value="<?=$user_ok['surname']?>" type="text" name="surname" placeholder="Фамилия" required>
                            <input class="auvt__form-cont-input" value="<?=$user_ok['name']?>" type="text" name="name" placeholder="Имя" required>
                            <select class="service__form-input" name="specialist" style=width:100%; required>
                                <option value="" disabled selected>Выберите квалификацию</option>
                                <?php
                                    $str_special = "SELECT * FROM `specialist`";
                                    $run_special = mysqli_query($connect, $str_special);
                                    while ($special = mysqli_fetch_array($run_special)) {
                                        $selected = ($special['id'] == $user_ok['id_specialist']) ? 'selected' : '';
                                        echo '<option value="'.$special['id'].'" '.$selected.'>'.$special['name'].'</option>';
                                    }
                                ?>
                            </select>
                            <select class="service__form-input" name="service" style=width:100%; required>
                                <option value="" disabled selected>Выберите услугу</option>
                                <?php
                                    $str_services = "SELECT * FROM `services`";
                                    $run_services = mysqli_query($connect, $str_services);
                                    while ($services = mysqli_fetch_array($run_services)) {
                                        $selected = ($services['id'] == $user_ok['id_services']) ? 'selected' : '';
                                        echo '<option value="'.$services['id'].'" '.$selected.'>'.$services['name_services'].'</option>';
                                    }
                                ?>
                            </select>
                            <input class="auvt__form-cont-input" value="<?=$user_ok['experience']?>" type="number" name="experience" placeholder="Стаж" required>
                            <input class="auvt__form-cont-input" type="text" value="<?=$user_ok['desc']?>" name="desc" placeholder="Описание" required>
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

    var idUpdateOk = getUrlParameter('id_staff_ok');
    if (idUpdateOk) {
        var dialog = document.getElementById('updateDialogStaff');
        if (dialog) {
            dialog.style.display = 'flex';
        }
    }
    var idUpdateOk = getUrlParameter('id_spec_ok');
    if (idUpdateOk) {
        var dialog = document.getElementById('updateDialog');
        if (dialog) {
            dialog.style.display = 'flex';
        }
    }
});
</script>