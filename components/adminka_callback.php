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
                <div class="admin__subtitle">Обратные звонки</div>
                <table class="admin__table">
                    <tr>
                        <th class="admin__table-th">Имя</th>
                        <th class="admin__table-th">Телефон</th>
                        <th class="admin__table-th">Сообщение</th>
                        <th class="admin__table-th">Действия</th>
                    </tr>
                    <?php
                        $id_callback_del = $_GET['id_callback_del'];
                        if ($id_callback_del) {
                            $str_del_callback = "DELETE FROM `callback` WHERE `id`='$id_callback_del'";
                            $run_del_callback = mysqli_query($connect, $str_del_callback);
                        }

                        $str_callback = "SELECT * FROM `callback`";
                        $run_callback = mysqli_query($connect, $str_callback);
                        while ($callback = mysqli_fetch_array($run_callback)) {
                            echo '
                            <tr>
                                <td class=admin__table-td>'.$callback['name'].'</td>
                                <td class=admin__table-td>'.$callback['phone'].'</td>
                                <td class=admin__table-td>'.$callback['description'].'</td>
                                <td class=admin__table-td>
                                <div class=admin__table-td-cont>
                                    <a href=adminka_callback.php?id_callback_del='.$callback['id'].' class=admin__table-btn-red>Позвонил</a>
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