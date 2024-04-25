<div class="container">
    <div class="blog">
    <div class="blog__single">
        <div class="blog_title">
            
        <?php
        $id=$_GET['id'];
        
        $query= "SELECT * FROM `blog-item` WHERE `id` = $id";
        $result_run= mysqli_query($connect,$query);
        $result=mysqli_fetch_array($result_run);
        echo $result['name'];
        ?>
        </div>
        
        <div class="blog__single__info">
            
            <div class="blog__single_img">
            <?php
        echo "<img src='assets/img/" . $result['photo'] . "' alt='' width='850'  height='560' >";
        ?>
        </div>
            <p class="blog__single__info-inf"><?=$result['description']?></p>
        </div>
        <div class="blog__single__main">
        <p class="blog_title"><?=$result['text1']?></p>
        </div>
        <div class="blog__single__info">
            
            
            <p class="blog__single__info-inf"><?=$result['litext']?></p>
        
        <div class="blog__single_img">
            <?php
        echo "<img src='assets/img/" . $result['img1'] . "' alt=''>";
        ?>
        </div>
        </div>
        </div>
</div>
</div>
</div>