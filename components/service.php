<div class="container">
    <div class="service">
        <div class="service__title">
            <?php
                $category_id = $_GET['id'];
                $query = "SELECT * FROM `services` WHERE `id` = $category_id";
                $result_run = mysqli_query($connect, $query);
                $result = mysqli_fetch_array($result_run);
                echo $result['name_services'];
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
                <div class="service__info-cont">
                    <?php
                        $str_item = "SELECT * FROM `service_item` WHERE `id_service`='$result[id]'";
                        $run_item = mysqli_query($connect, $str_item);
                        while ($item = mysqli_fetch_array($run_item)) {
                            echo    '<a href=service.php?id=' . $item['id'] . ' class=services_item>
                                    <img src=/assets/bd/' . $item['photo'] . ' alt="">
                                    <p class=services_item-name>' . $item['name'] . '</p>
                                    </a>';
                        }
                    ?>
                </div>
                <div class="service__subtitle">Специалисты</div>
                <div class="service__specialist-cont">
                    <div class="service__specialist">
                        <?php
                            $str_staff = "SELECT * FROM `staff` WHERE `id_services`='$result[id]'";
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
                                    <img src=/assets/bd/valeria.jpg>
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
            </div>
        </div>
    </div>
</div>