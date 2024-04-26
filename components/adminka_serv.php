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
                <div class="admin__subtitle">Категории</div>
                <button class="admin__green openDialog">Добавить категорию</button>
                <div class="dialog">
                    <div class="dialog__content">
                        <div class="dialog__title-cont">
                            <div class="dialog__title">Добавление категории</div>
                            <img id="closeDialog" src="/assets/img/close.svg" alt="">
                        </div>
                        <form class="auvt__form" action="/controllers/add_services_admin.php" method="POST" enctype="multipart/form-data">
                            <input class="auvt__form-cont-input" type="file" name="avatar" placeholder="Ваша фотография" required>
                            <input class="auvt__form-cont-input" type="text" name="name" placeholder="Название" required>
                            <input class="auvt__form-cont-input" type="text" name="desc" placeholder="Описание" required>
                            <input class="auvt__form-submit" type="submit" name="add_user" value="Зарегистрировать" required>
                        </form>
                    </div>
                </div>
                <table class="admin__table">
                    <tr>
                        <th class="admin__table-th">Фото</th>
                        <th class="admin__table-th">Название</th>
                        <th class="admin__table-th">Описание</th>
                        <th class="admin__table-th">Действия</th>
                    </tr>
                    <?php
                        $id_services_ok = $_GET['id_services_ok'];
                        $id_services_del = $_GET['id_services_del'];
                        if ($id_services_del) {
                            $str_del_services = "DELETE FROM `services` WHERE `id`='$id_services_del'";
                            $run_del_services = mysqli_query($connect, $str_del_services);
                        }

                        $str_services = "SELECT * FROM `services`";
                        $run_services = mysqli_query($connect, $str_services);
                        while ($services = mysqli_fetch_array($run_services)) {
                            echo '
                            <tr>
                                <td class=admin__table-td>
                                    <img src=/assets/img/'.$services['photo'].' alt=>
                                </td>
                                <td class=admin__table-td>'.$services['name_services'].'</td>
                                <td class=admin__table-td>'.$services['description'].'</td>
                                <td class=admin__table-td>
                                    <div class=admin__table-td-cont>
                                        <a href=adminka_serv.php?id_services_ok='.$services['id'].' class=admin__table-btn-green>Редактировать</a>
                                        <a href=adminka_serv.php?id_services_del='.$services['id'].' class=admin__table-btn-red>Удалить</a>
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
                            <div class="dialog__title">Редактирование категории</div>
                            <img id="closeDialog" src="/assets/img/close.svg" alt="">
                        </div>
                        <?php
                            $id_user_ok = $_GET['id_services_ok'];
                            $str_user_ok = "SELECT * FROM `services` WHERE `id`='$id_user_ok'";
                            $run_user_ok = mysqli_query($connect, $str_user_ok);
                            $user_ok = mysqli_fetch_array($run_user_ok);
                        ?>
                        <form class="auvt__form" action="/controllers/update_services_admin.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?=$user_ok['id']?>">
                            <input class="auvt__form-cont-input" type="file" name="avatar" placeholder="Ваша фотография" required>
                            <input class="auvt__form-cont-input" value="<?=$user_ok['name_services']?>" type="text" name="name" placeholder="Название" required>
                            <input class="auvt__form-cont-input" type="text" value="<?=$user_ok['description']?>" name="desc" placeholder="Описание" required>
                            <input class="auvt__form-submit" type="submit" name="add_user" value="Редактировать" required>
                        </form>
                    </div>
                </div>
                <div class="admin__subtitle">Услуги</div>
                <button class="admin__green openDialog">Добавить услугу</button>
                <div class="dialog">
                    <div class="dialog__content">
                        <div class="dialog__title-cont">
                            <div class="dialog__title">Добавление услуги</div>
                            <img id="closeDialog" src="/assets/img/close.svg" alt="">
                        </div>
                        <form class="auvt__form" action="/controllers/add_service_admin.php" method="POST" enctype="multipart/form-data">
                            <input class="auvt__form-cont-input" type="file" name="avatar" placeholder="Ваша фотография" required>
                            <input class="auvt__form-cont-input" type="text" name="name" placeholder="Название" required>
                            <input class="auvt__form-cont-input" type="text" name="desc" placeholder="Описание" required>
                            <select class="service__form-input" name="service" style=width:100%; required>
                                <option value="" disabled selected>Выберите категорию</option>
                                <?php
                                    $str_services_out = "SELECT * FROM `services`";
                                    $run_services_out = mysqli_query($connect, $str_services_out);
                                    while ($services_out = mysqli_fetch_array($run_services_out)) {
                                        echo '
                                        <option value='.$services_out['id'].'>'.$services_out['name_services'].'</option>
                                        ';
                                    }
                                ?>
                            </select>
                            <input class="auvt__form-cont-input" type="number" name="price" placeholder="Цена" required>
                            <input class="auvt__form-submit" type="submit" name="add_user" value="Зарегистрировать" required>
                        </form>
                    </div>
                </div>
                <table class="admin__table">
                    <tr>
                        <th class="admin__table-th">Фото</th>
                        <th class="admin__table-th">Название</th>
                        <th class="admin__table-th">Описание</th>
                        <th class="admin__table-th">Категория</th>
                        <th class="admin__table-th">Цена</th>
                        <th class="admin__table-th">Действия</th>
                    </tr>
                    <?php
                        $id_service_ok = $_GET['id_service_ok'];
                        $id_service_del = $_GET['id_service_del'];
                        if ($id_service_del) {
                            $str_del_service = "DELETE FROM `service_item` WHERE `id`='$id_service_del'";
                            $run_del_service = mysqli_query($connect, $str_del_service);
                        }

                        $str_service = "SELECT * FROM `service_item`";
                        $run_service = mysqli_query($connect, $str_service);
                        while ($service = mysqli_fetch_array($run_service)) {
                            $str_cat = "SELECT * FROM `services` WHERE `id`='$service[id_service]'";
                            $run_cat = mysqli_query($connect, $str_cat);
                            $cat = mysqli_fetch_array($run_cat);
                            echo '
                            <tr>
                                <td class=admin__table-td>
                                    <img src=/assets/img/'.$service['photo'].' alt=>
                                </td>
                                <td class=admin__table-td>'.$service['name'].'</td>
                                <td class=admin__table-td>'.$service['description'].'</td>
                                <td class=admin__table-td>'.$cat['name_services'].'</td>
                                <td class=admin__table-td>'.$service['price'].'</td>
                                <td class=admin__table-td>
                                    <div class=admin__table-td-cont>
                                        <a href=adminka_serv.php?id_service_ok='.$service['id'].' class=admin__table-btn-green>Редактировать</a>
                                        <a href=adminka_serv.php?id_service_del='.$service['id'].' class=admin__table-btn-red>Удалить</a>
                                    </div>
                                </td>
                            </tr>
                            ';
                        }
                    ?>
                </table>
                <div class="dialog" id="updateDialogServices">
                    <div class="dialog__content">
                        <div class="dialog__title-cont">
                            <div class="dialog__title">Редактирование услуги</div>
                            <img id="closeDialog" src="/assets/img/close.svg" alt="">
                        </div>
                        <?php
                            $id_user_ok = $_GET['id_service_ok'];
                            $str_user_ok = "SELECT * FROM `service_item` WHERE `id`='$id_user_ok'";
                            $run_user_ok = mysqli_query($connect, $str_user_ok);
                            $user_ok = mysqli_fetch_array($run_user_ok);
                        ?>
                        <form class="auvt__form" action="/controllers/update_service_admin.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?=$user_ok['id']?>">
                            <input class="auvt__form-cont-input" type="file" name="avatar" placeholder="Ваша фотография" required>
                            <input class="auvt__form-cont-input" value="<?=$user_ok['name']?>" type="text" name="name" placeholder="Название" required>
                            <input class="auvt__form-cont-input" value="<?=$user_ok['description']?>" type="text" name="desc" placeholder="Описание" required>
                            <select class="service__form-input" name="service" style=width:100%; required>
                                <option value="" disabled selected>Выберите категорию</option>
                                <?php
                                    $str_special = "SELECT * FROM `services`";
                                    $run_special = mysqli_query($connect, $str_special);
                                    while ($special = mysqli_fetch_array($run_special)) {
                                        $selected = ($special['id'] == $user_ok['id_service']) ? 'selected' : '';
                                        echo '<option value="'.$special['id'].'" '.$selected.'>'.$special['name_services'].'</option>';
                                    }
                                ?>
                            </select>
                            <input class="auvt__form-cont-input" value="<?=$user_ok['price']?>" type="number" name="price" placeholder="Цена" required>
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

    var idUpdateOk = getUrlParameter('id_service_ok');
    if (idUpdateOk) {
        var dialog = document.getElementById('updateDialogServices');
        if (dialog) {
            dialog.style.display = 'flex';
        }
    }
    var idUpdateOk = getUrlParameter('id_services_ok');
    if (idUpdateOk) {
        var dialog = document.getElementById('updateDialog');
        if (dialog) {
            dialog.style.display = 'flex';
        }
    }
});
</script>