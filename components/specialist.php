<?php
include_once 'controllers/db.php';
?>
<div class="specialist_cont">
    <h1>Наши мастера </h1>
    <div class="staff">
    <?php
    $query="SELECT * FROM `staff`";
    $str=mysqli_query($connect,$query);
    while($staff=mysqli_fetch_array($str)){
        $id_cat=$staff['id_specialist'];
        $query_cat="SELECT * FROM `specialist` WHERE `id`=$id_cat";
        $str_cat=mysqli_query($connect,$query_cat);
        $out=mysqli_fetch_array($str_cat);
    ?>
    <div class="staff-one">
        <img class=staff-img src="/assets/img/<?= $staff['photo'] ?>">
    <div class="staff-info">
        <h2><?= $staff['surname']?> <?= $staff['name'] ?></h2>
        <h3><?= $out['name']?></h3>
        <p><?= $staff['desc'] ?></p>  
    </div>
    <a href="<?php echo '/service.php/?id='.$staff['id_services'].'';?>" class="staff-button">Записаться</a>
    </div>
    
    <?php
    }
    ?>
    </div>
</div>