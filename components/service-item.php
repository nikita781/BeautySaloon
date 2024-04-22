<div class="container">
    <div class="service">
        <div class="service__title">
            <?php
                $id = $_GET['id'];
                $query = "SELECT * FROM `service_item` WHERE `id` = $id";
                $result_run = mysqli_query($connect, $query);
                $result = mysqli_fetch_array($result_run);
                echo $result['name'];
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
                <p class="service__info-price"><strong><?=$result['price']?> рублей</strong></p>
                <div class="service__subtitle">Описание процедуры</div>
                <ul>
                    <?php
                        $str_points = "SELECT * FROM `procedure_points` WHERE `id_service`='$result[id]'";
                        $run_points = mysqli_query($connect, $str_points);
                        while ($points = mysqli_fetch_array($run_points)) {
                            echo '
                                <li>'.$points['name'].': '.$points['description'].'</li>
                            ';
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>