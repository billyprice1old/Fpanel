<?php
include PHYSICAL_PATH.'library/admin.php';
?>
<?php
if(isset($_GET['id'])){
    $data = array(
        'Id'=>$_GET['id']
    );
    $res = db_get_where('themes',$data);
    for ($i=0;$i<count($res);$i++){
        $title = $res[$i]['Title']; 
        $banner = $res[$i]['Banner'];
        $bg_img = $res[$i]['BgImage'];
        $bg_color = $res[$i]['BgColor'];
        $text_color = $res[$i]['TextColor'];
        $nav_color = $res[$i]['NavColor'];
        $nav_text_color = $res[$i]['NavTextColor'];
    }
}
?>
<div class="small-12 columns big-menu">
    <button class="button" type="button" data-toggle="in_body">Body</button>
    <div class="small-10 dropdown-pane" id="in_body" data-dropdown data-auto-focus="true">
        <div class="row">
            <div class="medium-6 columns">
                <label>Background Color
                    <input class="jscolor" type="text" value="<?=$bg_color?>" onchange="bg_color('body',this.value)">
                </label>
            </div>
            <div class="medium-6 columns">
                <label>Text Color :
                    <input class="jscolor" type="text" value="<?=$text_color?>" onchange="text_color('body',this.value)">
                </label>
            </div>
        </div>
        <div class="row">
            <div class="medium-6 columns">
                <label>Background Image
                    <input type="file" name="body_img" onchange="bd_img(this,'#body')"/>
                </label>
            </div>
        </div>
    </div>
    <button class="button" type="button" data-toggle="example-dropdown">Banner</button>
    <div class="dropdown-pane" id="example-dropdown" data-dropdown data-auto-focus="true">
    <input type="file" name="banner" onchange="img_view(this,'#banner')"/>
    </div>
    <button class="button" type="button" data-toggle="navigate">Menu</button>
    <div class="dropdown-pane" id="navigate" data-dropdown data-auto-focus="true">
        <script src="<?=VIRTUAL_PATH?>js/jscolor.js"></script>
        Background Color: <input class="jscolor" value="<?=$nav_color?>" onchange="bg_color('fp-menu',this.value)"></br>
        Text Color : <input class="jscolor" value="<?=$nav_text_color?>" onchange="text_color('fp-menu',this.value)">
    </div>
</div>
<?php

?>
<style>
    #body{
        background:white url("<?=VIRTUAL_PATH_SITE?>themes/<?=$title?>/img/<?=$bg_img?>") repeat fixed center;
        padding : 0px;
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
        color: black;
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
<div class="small-12 columns " id="body">
    <div class="small-12 columns big-banner">
          <div class="small-10 columns">
            <img id="banner" src="<?=VIRTUAL_PATH_SITE?>themes/<?=$title?>/img/<?=$banner?>" alt="banner">
          </div>
  
    </div>
    <div class="small-12 columns navigation show-for-large-up">
            <ul class="desktop-menu" id="fp-menu">
                <li><a href="">ទំព័រដើម</a></li>
                <li><a href="">អំពីត្រាជូ</a></li>
                <li><a href="">អំពីសមាជិក</a></li>
                <li><a href="">នីតិអន្តរជាតិ</a></li>
                <li><a href="">នីតិសាធារណៈ</a></li>  
            </ul>
    </div>
    <div class="small-12 medium-8 large-10 columns">
            <div class="small-12 columns content-area">
                    <?php
                    $post = '<div class="small-12 medium-6 large-4 columns left post-thumb">
                    <a href="#">
                        <div class="small-12 columns">
                            <img src="'.VIRTUAL_PATH_SITE.'themes/'.$title.'/img/post.png" alt="thumb" class="thumb-img">
                            <p><b>ចំណងជើង​អត្ថបទ</b></p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam nam non, minus accusantium quam doloremque esse! </p>
                            <p class="thumb-date">23 April 2015</p>
                        </div>
                    </a>
                </div>';
                    echo $post;
                    echo $post;
                    echo $post;
                    echo $post;
                    echo $post;
                    ?>
            </div>
    </div>
    <div class="small-12 medium-4 large-2 columns">
            <div class="small-6 medium-12 columns">
                <p><b>some label</b></p>
                <ul class="cat-item">
                    <li><a href="#">sub menu</a></li>
                    <li><a href="#">sub menu</a></li>
                    <li><a href="#">sub menu</a></li>
                    <li><a href="#">sub menu</a></li>
                    <li><a href="#">sub menu</a></li>
                </ul>
            </div>
            <div class="small-6 medium-12 columns">
                <p><b>some label</b></p>
                <ul class="cat-item">
                    <li><a href="#">sub menu</a></li>
                    <li><a href="#">sub menu</a></li>
                    <li><a href="#">sub menu</a></li>
                    <li><a href="#">sub menu</a></li>
                    <li><a href="#">sub menu</a></li>
                </ul>
            </div>
    </div>
</div>