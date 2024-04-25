<div class="container">
    <div class="services">
        <p class="services_title">Наши услуги</p>
        <div class="services_container">
            <?php
                $str_cat = "SELECT * FROM `services`";
                $run_cat = mysqli_query($connect, $str_cat);
                while ($cat = mysqli_fetch_array($run_cat)) {
                    echo    '<a href=service.php?id=' . $cat['id'] . ' class=services_item>
                            <img src=/assets/img/' . $cat['photo'] . ' alt="">
                            <p class=services_item-name>' . $cat['name_services'] . '</p>
                            </a>';
                }
            ?>
        </div>
    </div>
</div>