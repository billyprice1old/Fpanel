<?php
include PHYSICAL_PATH.'library/admin.php';
?>
<?php
$res = db_get('themes');
for ($i=0;$i<count($res);$i++){  
?>
<div class="small-12 columns big-menu">
        
            <div class="small-12 columns title-row">
                <span class="section-title">
                <?=$res[$i]['Title']?>
                </span>
            </div>
        <div class="small-5 columns">
            <div class="small-12 columns">
            <a href="customer_new.php" class="grey-color">
                <img class="rounded thumbnail" src="<?=VIRTUAL_PATH_SITE?>themes/<?=$res[$i]['Title']?>/img/<?=$res[$i]['Image']?>" alt="<?=$res[$i]['Title']?>">
            </a>
            </div>
        </div>
        <div class="small-4 columns">
            <?=$res[$i]['Description']?>
        </div>
        <div class="small-3 columns">
            <a href="#" class="button-green">Activate</a>
            <a href="themes_customize.php?id=<?=$res[$i]['Id']?>" class="button-blue">Customize</a>
        </div>
        
<?php
}
?>