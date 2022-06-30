<?php

/** @var yii\web\View $this */

$this->title = 'Beranda';
?>
<div class="site-index">
    <?php 
    foreach($data as $key=>$value){
        ?>
        <div class="body-content">
            <h1><?=$value->title?></h1>
        
            <p>
                <small>
                <?=$value->username?> <?=$value->date?>
                </small>
            </p>
            <div>
                <?php
                $html       = $value->content;
                $start      = strpos($html, '<p>');
                $end        = strpos($html, '</p>', $start);
                $paragraph  = substr($html, $start, $end-$start+4);
                ?>
                <?=$paragraph?>
            </div>
            <div>
                <a href="/index.php?r=site/detailPost&id=<?=$value->idpost?>" class="btn btn-primary">Read More</a>
            </div>
        </div>
        <?php
    }
    ?>
    
</div>