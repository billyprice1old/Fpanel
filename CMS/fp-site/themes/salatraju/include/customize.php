<?php

    $res = db_get_where('themes_use','Id',THEME_ID);
    for ($i=0;$i<count($res);$i++){
        $title = $res[$i]['Title']; 
        $banner = $res[$i]['Banner'];
        $bg_img = $res[$i]['BgImage'];
        $bg_color = $res[$i]['BgColor'];
        $text_color = $res[$i]['TextColor'];
        $nav_color = $res[$i]['NavColor'];
        $nav_text_color = $res[$i]['NavTextColor'];
    }

?>
<style>
    body{
        background:<?=$bg_color?> url("<?=VIRTUAL_PATH_SITE?>themes/<?=$title?>/img/<?=$bg_img?>") repeat fixed center;
        padding : 0px;
        color:<?=$text_color?>;
    }
    .big-banner{
        background: #<?=$nav_color?>;
        text-align: center;
        border-bottom: 15px solid #93681e;
        margin-bottom: 5px;
        
    }
    .desktop-menu{
        list-style-type: none;
        background: #<?=$nav_color?>;
        margin: 0;
        border-bottom: 5px solid #93681e;
    }
    .desktop-menu li{
        background: transparent;
        display: inline-block;
        color: black;
        padding: 10px;
        border-right: 1px solid white;
    }
    .desktop-menu li a {
        color:<?=$nav_text_color?>;
        font-weight: bold;
    }
    .navigation{
        padding: 0 0 5px 0;
        margin: 0;
    }
    .content-area{
        background: rgba(255,255,255,0.6);
        margin-bottom: 10px;
    }
    .cat-item {
    list-style-type: none;
    }
    .cat-item li a {
    color: #555;
    }
</style>