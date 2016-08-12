<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Salatraju</title>
    <link rel="stylesheet" href="<?=VIRTUAL_PATH_SITE?>themes/salatraju/khmerfonts/font.css" />
    <link rel="stylesheet" href="<?=VIRTUAL_PATH_SITE?>themes/salatraju/css/foundation6.css" />
    <link rel="stylesheet" href="<?=VIRTUAL_PATH_SITE?>themes/salatraju/css/foundation.css" />
    <link rel="stylesheet" href="<?=VIRTUAL_PATH_SITE?>themes/salatraju/css/souris.css" />
    
    <link rel="stylesheet" href="<?=VIRTUAL_PATH_SITE?>themes/salatraju/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?=VIRTUAL_PATH_SITE?>themes/salatraju/css/main.css">
    <link rel="stylesheet" href="<?=VIRTUAL_PATH_SITE?>themes/salatraju/css/virgo.css" />
    <script src="<?=VIRTUAL_PATH_SITE?>themes/salatraju/js/vendor/modernizr.js"></script>
    <?php
      if (THEME_CUSTOMIZE == 1){
        include 'customize.php';
      }
    ?>
  </head>
  <body>
  <div class="off-canvas-wrapper">
    <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
      
      <div class="off-canvas position-right" id="offCanvasRight" data-off-canvas data-position="right">
      <!-- right menu-->
            <ul class="vertical menu" data-drilldown>
              <?php include INCLUDE_PATH_SITE.'menu_drill.php'; ?>
            </ul>
      </div>
      <div class="off-canvas-content" data-off-canvas-content>
      <!-- page content middle-->
      <nav class="smal-12 columns hide-for-large-up banner">
          <div class="small-10 columns">
            <a href="<?=NAV_PATH?>index.php/index"><img src="<?=VIRTUAL_PATH_SITE?>themes/salatraju/img/banner.png" alt="banner"></a>
          </div>
          <div class="small-2 columns offtoggle">
            <a  href="#" data-toggle="offCanvasRight"><i class="fa fa-bars fa-3x"></i></a>
          </div>
            
      </nav>
      <div class="small-12 columns big-banner show-for-large-up">
            <a href="<?=NAV_PATH?>index.php/index"><img src="<?=VIRTUAL_PATH_SITE?>themes/salatraju/img/banner.png" alt="banner"></a>
      </div>
      <div class="small-12 columns navigation show-for-large-up">
            <ul class="desktop-menu dropdown menu" data-dropdown-menu>
             <?php include INCLUDE_PATH_SITE.'menu.php'; ?>
            </ul>
      </div>
      <div class="small-12 medium-10 large-10 columns">
            <div class="small-12 columns content-area">
              
            