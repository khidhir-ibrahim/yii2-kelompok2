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
                <?=$value->username?> <?=date('Y-m-d',strtotime($value->date))?>
                </small>
            </p>
            <div>
                <?=$value->content?>
            </div>
        </div>
        <?php
    }
    ?>
    
</div>