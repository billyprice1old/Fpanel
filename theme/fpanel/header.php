<?php
if(SESSION == true){
    session_start();//session start
}
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FPanel</title>
    <link rel="stylesheet" href="<?=VIRTUAL_PATH?>css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=VIRTUAL_PATH?>css/foundation.min.css">
    <link rel="stylesheet" href="<?=VIRTUAL_PATH?>css/souris.css">
    <link rel="stylesheet" href="<?=VIRTUAL_PATH?>css/table.css">
    <link rel="stylesheet" href="<?=VIRTUAL_PATH?>theme/<?=THEME?>/style/main.css">
    
    <script src="<?=VIRTUAL_PATH?>/js/virgo.js"></script>
    <script src="<?=VIRTUAL_PATH?>theme/<?=THEME?>/js/jquery.js" async></script>
    <script src="<?=VIRTUAL_PATH?>theme/<?=THEME?>/js/clock.js" async></script>
    <script src="<?=VIRTUAL_PATH?>theme/<?=THEME?>/js/main.js" async></script>
  </head>
  <body>