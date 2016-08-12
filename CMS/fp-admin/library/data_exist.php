<?php
include '../config/config.php';
if (isset($_GET['checking'])){
    if (isset($_GET['what'])){
        $what = $_GET['what']; 
    }else{
        $what = '';
    }
    date_exist($_GET['checking'],$what);
}
