<?php
include_once "controllers/db.php"
?>
<div class="stock_cont">
    <h1>Акции для вас</h1>
    <div class="stock">
        
        <?php
        $query="SELECT * FROM `stock`";
    $str=mysqli_query($connect,$query);
    while($stock=mysqli_fetch_array($str)){
        $id_cat=$stock['id_services'];
        $query_cat="SELECT * FROM `services` WHERE `id`=$id_cat";
        $str_cat=mysqli_query($connect,$query_cat);
        $out=mysqli_fetch_array($str_cat);
        ?>
        <div class="stock_one">
        <img class=img_stock  src="/assets/img/<?= $stock['img'] ?>">
        <div class="desc_stock">
        <h2><?=$stock['name_stock']?></h2>
        <h3>Получите скидку в <?=$stock['percent']?>%</h3>
        <p><?=$stock['description']?></p>
        <p><?=$stock['time_action']?></p>
    
        <a href="<?php echo '/service-item.php/?id='.$stock['id_services'].'';?>" class=stock-button>Записаться</a>
        </div>
        </div>
        <?php
    }
    ?>
    </div>
</div>