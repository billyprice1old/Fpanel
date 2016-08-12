
<?php
include PHYSICAL_PATH.'library/admin.php';
?>
<div class="small-5 columns big-menu sub-left-side-bar">
<ul class="menu dragdrog" id="sidebar_item"  ondrop="drop(event)" ondragover="allowDrop(event)">
<?php
$res = db_get('sidebar_items');
for ($i=0; $i<count($res);$i++){


?>
    <li class="col-2" draggable="true"  ondragstart="drag(event,'<?=$res[$i]['SidebarName']?>','<?=$res[$i]['HtmlId']?>')" id="<?=$res[$i]['HtmlId']?>"><?=$res[$i]['SidebarName']?>
    </li>
<?php
}
?>

    </ul>
    
</div>
<div class="small-3 columns big-menu sub-left-side-bar">
    <ul id="sidebar_left" class="vertical menu dragdrog" data-accordion-menu ondrop="drop(event)" ondragover="allowDrop(event)">
    </ul>
</div>
<div class="small-3 columns big-menu sub-left-side-bar left">
    <ul id="sidebar_right" class="vertical menu dragdrog" data-accordion-menu ondrop="drop(event)" ondragover="allowDrop(event)">
    </ul>
</div>