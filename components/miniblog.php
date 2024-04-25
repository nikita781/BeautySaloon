<div class="container">
    <div class="miniblog">
        <div class="miniblog_title">Блог</div>
        <div class="miniblog_container">
            <?php 
            $str_blog="SELECT * FROM `blog-item` ORDER BY `created_at` DESC LIMIT 4";
            $run_blog=mysqli_query($connect,$str_blog);
            while ($blog=mysqli_fetch_array($run_blog)) {
                $formattedDate = date('j F, Y', strtotime($blog['updated_at']));
                echo "
                <a href=# class=miniblog_container-item>
                    <img src=/assets/img/".$blog['photo']." alt=>
                    <div class=miniblog_container-info>
                        <h3>".$blog['name']."</h3>
                        <p>".$blog['description']."</p>
                        <p>".$formattedDate."</p>
                    </div>
                </a>
                ";
            }

            ?>
        </div>
    </div>
</div>