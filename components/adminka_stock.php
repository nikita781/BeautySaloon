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
                <div class="admin__subtitle">Акции</div>
                <button class="admin__green openDialog">Добавить акцию</button>
                <div class="dialog">
                    <div class="dialog__content">
                        <div class="dialog__title-cont">
                            <div class="dialog__title">Добавление акции</div>
                            <img id="closeDialog" src="/assets/img/close.svg" alt="">
                        </div>
                        <form class="auvt__form" action="/controllers/add_stock_admin.php" method="POST" enctype="multipart/form-data">
                            <input class="auvt__form-cont-input" type="file" name="avatar" placeholder="Ваша фотография" required>
                            <select class="service__form-input" name="service" style=width:100%; required>
                                <option value="" disabled selected>Выберите услугу</option>
                                <?php
                                    $str_services = "SELECT * FROM `service_item`";
                                    $run_services = mysqli_query($connect, $str_services);
                                    while ($services = mysqli_fetch_array($run_services)) {
                                        echo '
                                        <option value='.$services['id'].'>'.$services['name'].'</option>
                                        ';
                                    }
                                ?>
                            </select>
                            <input class="auvt__form-cont-input" type="text" name="name" placeholder="Название" required>
                            <textarea class="auvt__form-cont-input auvt__form-cont-textarea" name="desc" placeholder="Описание" required></textarea>
                            <input class="auvt__form-cont-input" type="number" name="percent" placeholder="Процент" required>
                            <input class="auvt__form-cont-input" type="text" name="time_action" placeholder="Сроки" required>
                            <input class="auvt__form-submit" type="submit" name="add_user" value="Зарегистрировать" required>
                        </form>
                    </div>
                </div>
                <table class="admin__table">
                    <tr>
                        <th class="admin__table-th">Фото</th>
                        <th class="admin__table-th">Услуга</th>
                        <th class="admin__table-th">Описание</th>
                        <th class="admin__table-th">Название</th>
                        <th class="admin__table-th">Процент</th>
                        <th class="admin__table-th">Сроки</th>
                        <th class="admin__table-th">Действия</th>
                    </tr>
                    <?php
                        $id_stock_ok = $_GET['id_stock_ok'];
                        $id_stock_del = $_GET['id_stock_del'];
                        if ($id_stock_del) {
                            $str_del_stock = "DELETE FROM `stock` WHERE `id`='$id_stock_del'";
                            $run_del_stock = mysqli_query($connect, $str_del_stock);
                        }

                        $str_stock = "SELECT * FROM `stock`";
                        $run_stock = mysqli_query($connect, $str_stock);
                        while ($stock = mysqli_fetch_array($run_stock)) {
                            $str_serv = "SELECT * FROM `service_item` WHERE `id`='$stock[id_services]'";
                            $run_serv = mysqli_query($connect, $str_serv);
                            $serv = mysqli_fetch_array($run_serv);
                            echo '
                            <tr>
                                <td class=admin__table-td>
                                    <img src=/assets/img/'.$stock['img'].' alt=>
                                </td>
                                <td class=admin__table-td>'.$serv['name'].'</td>
                                <td class=admin__table-td>'.$stock['description'].'</td>
                                <td class=admin__table-td>'.$stock['name_stock'].'</td>
                                <td class=admin__table-td>'.$stock['percent'].'%</td>
                                <td class=admin__table-td>'.$stock['time_action'].'</td>
                                <td class=admin__table-td>
                                    <div class=admin__table-td-cont>
                                        <a href=adminka_stock.php?id_stock_ok='.$stock['id'].' class=admin__table-btn-green>Редактировать</a>
                                        <a href=adminka_stock.php?id_stock_del='.$stock['id'].' class=admin__table-btn-red>Удалить</a>
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
                            $id_user_ok = $_GET['id_stock_ok'];
                            $str_user_ok = "SELECT * FROM `stock` WHERE `id`='$id_user_ok'";
                            $run_user_ok = mysqli_query($connect, $str_user_ok);
                            $user_ok = mysqli_fetch_array($run_user_ok);
                        ?>
                        <form class="auvt__form" action="/controllers/update_stock_admin.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?=$user_ok['id']?>">
                            <input class="auvt__form-cont-input" type="file" name="avatar" placeholder="Ваша фотография" required>
                            <select class="service__form-input" name="service" style=width:100%; required>
                                <option value="" disabled selected>Выберите услугу</option>
                                <?php
                                    $str_services = "SELECT * FROM `service_item`";
                                    $run_services = mysqli_query($connect, $str_services);
                                    while ($services = mysqli_fetch_array($run_services)) {
                                        $selected = ($services['id'] == $user_ok['id_services']) ? 'selected' : '';
                                        echo '<option value="'.$services['id'].'" '.$selected.'>'.$services['name'].'</option>';
                                    }
                                ?>
                            </select>
                            <input class="auvt__form-cont-input" value="<?=$user_ok['name_stock']?>" type="text" name="name" placeholder="Название" required>
                            <textarea class="auvt__form-cont-input auvt__form-cont-textarea" value="<?=$user_ok['description']?>" name="desc" placeholder="Описание" required></textarea>
                            <input class="auvt__form-cont-input" value="<?=$user_ok['percent']?>" type="number" name="percent" placeholder="Процент" required>
                            <input class="auvt__form-cont-input" type="text" value="<?=$user_ok['time_action']?>" name="time_action" placeholder="Сроки" required>
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

    var idUpdateOk = getUrlParameter('id_stock_ok');
    if (idUpdateOk) {
        var dialog = document.getElementById('updateDialog');
        if (dialog) {
            dialog.style.display = 'flex';
        }
    }
});
</script>