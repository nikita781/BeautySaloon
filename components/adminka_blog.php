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
                <div class="admin__subtitle">Блог</div>
                <button class="admin__green openDialog">Добавить пост</button>
                <div class="dialog">
                    <div class="dialog__content">
                        <div class="dialog__title-cont">
                            <div class="dialog__title">Добавление поста</div>
                            <img id="closeDialog" src="/assets/img/close.svg" alt="">
                        </div>
                        <form class="auvt__form" action="/controllers/add_blog_admin.php" method="POST" enctype="multipart/form-data">
                            <input class="auvt__form-cont-input" type="file" name="avatar" placeholder="Ваша фотография" required>
                            <input class="auvt__form-cont-input" type="text" name="name" placeholder="Название" required>
                            <textarea class="auvt__form-cont-input auvt__form-cont-textarea" name="desc" placeholder="Описание" required></textarea>
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
                        $id_blog_del = $_GET['id_blog_del'];
                        if ($id_blog_del) {
                            $str_del_blog = "DELETE FROM `blog-item` WHERE `id`='$id_blog_del'";
                            $run_del_blog = mysqli_query($connect, $str_del_blog);
                        }

                        $str_blog = "SELECT * FROM `blog-item`";
                        $run_blog = mysqli_query($connect, $str_blog);
                        while ($blog = mysqli_fetch_array($run_blog)) {
                            echo '
                            <tr>
                                <td class=admin__table-td>
                                    <img src=/assets/img/'.$blog['photo'].' alt=>
                                </td>
                                <td class=admin__table-td>'.$blog['name'].'</td>
                                <td class=admin__table-td>'.$blog['description'].' '.$staff['name'].'</td>
                                <td class=admin__table-td>
                                <div class=admin__table-td-cont>
                                    <a href=adminka_blog.php?id_blog_del='.$blog['id'].' class=admin__table-btn-red>Удалить</a>
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