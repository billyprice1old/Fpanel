<?php
include PHYSICAL_PATH.'library/admin.php';
?>
<?php
if(!isset($_POST['save']) && !isset($_POST['publish']))
{   
   $title = '';
   $title_en = '';
    $content='';
    $pass= '';
    $pass_no_en = '';
    $catergory='';
    $status="";
    $authorId="";
    $author='';
 if (isset($_GET['id'])){
     $id = $_GET['id'];
 } else{
     $id = '';
 }
//////////Looking for data to edit///////////////
$res = db_get_inner_join('fp_posts','fp_users','PostAuthor','Id','Where PostId="'.$id.'"');
for ($i=0;$i<count($res);$i++){
    if($res[$i]['PostId'] !=0){
        $title=$res[$i]['PostTitle'];
        $title_en=$res[$i]['PostTitleEn'];
        $author=$res[$i]['LastName'].' '.$res[$i]['FirstName'];
        $authorId=$res[$i]['PostAuthor'];
        $content=$res[$i]['PostContent'];
        if($res[$i]['PostPassword']!= ""){
            $pass_no_en = pass_decrypt($res[$i]['PostPassword'],KEY_ENCRYPT);
        }else{
            $pass_no_en ="";
        }
        $catergory=$res[$i]['Catergories'];
    }
    
}
}else if(isset($_POST['save'])){
    ///Save to draff

if($_POST['id'] ==""){
    $result = db_get_limit('fp_posts',0,1,'','ORDER BY PostId DESC');
    $id = $result[0]['PostId'] + 1;
}else{
    $id = $_POST['id'];
}
$title = htmlspecialchars($_POST['title'],ENT_QUOTES);
$title_en = htmlspecialchars($_POST['title_en'],ENT_QUOTES);
$content= htmlspecialchars($_POST['post_content'],ENT_QUOTES);
if (isset($_POST['author'])){
    $authorId=$_POST['author'];
}else{
    $authorId=$_SESSION['infos']['id'];
}

if($_POST['password']!=''){
    $pass = pass_encrypt(trim($_POST['password']),KEY_ENCRYPT);
}else{
    $pass= '';
}
//$pass_no_en = trim($_POST['password']);
$catergory = $_POST['catergory'];
$check_id = array(
    'PostId'=>$id
);
$get_data = db_get_where('fp_posts',$check_id);
$count = count($get_data); 
    if ($count > 0){
        if ($get_data[0]['PostStatus'] == 2 || $get_data[0]['PostStatus'] == 3){
            $data = array(
            'PostId'=> $id,
            'PostAuthor'=>$authorId,
            'PostModify'=>date('Y-m-d h:i:s'),
            'PostTitle'=>$title,
            'PostTitleEn'=>$title_en,
            'PostContent'=> $content,
            'PostStatus'=> '3',
            'PostType'=>'post',
            'PostPassword'=>$pass,
            'Catergories'=>$catergory
            );
        }else{
            $data = array(
            'PostId'=> $id,
            'PostAuthor'=>$authorId,
            'PostModify'=>date('Y-m-d h:i:s'),
            'PostTitle'=>$title,
            'PostTitleEn'=>$title_en,
            'PostContent'=> $content,
            'PostStatus'=> '1',
            'PostType'=>'post',
            'PostPassword'=>$pass,
            'Catergories'=>$catergory
            );
        }
            $cond = array(
                'PostId'=>$id
            );
        //update data
        db_update('fp_posts',$data,$cond);
    }else{
        //insert data
        $data = array(
        'PostId'=> $id,
        'PostAuthor'=>$authorId,
        'PostDate'=>date('Y-m-d h:i:s'),
        'PostTitle'=>$title,
        'PostTitleEn'=>$title_en,
        'PostContent'=> $content,
        'PostStatus'=> '1',
        'PostType'=>'post',
        'PostPassword'=>$pass,
        'Catergories'=>$catergory
        );
        db_insert('fp_posts',$data);
    }
$status = "Saved.";
}else if(isset($_POST['publish'])){
    if($_POST['id'] ==""){
        $result = db_get_limit('fp_posts',0,1,'','ORDER BY PostId DESC');
        $id = $result[0]['PostId'] + 1;
    }else{
        $id = $_POST['id'];
    }
$title = htmlspecialchars($_POST['title'],ENT_QUOTES);
$title_en = htmlspecialchars($_POST['title_en'],ENT_QUOTES);
if (isset($_POST['author'])){
    $authorId=$_POST['author'];
}else{
    $authorId=$_SESSION['infos']['id'];
}
$content= htmlspecialchars($_POST['post_content'],ENT_QUOTES);
$catergory = $_POST['catergory'];
    if($_POST['password']!=''){
        $pass = pass_encrypt(trim($_POST['password']),KEY_ENCRYPT);
    }else{
        $pass= '';
    }
    $pass_no_en = trim($_POST['password']);
$check_id = array(
    'PostId'=>$id
);
$count = count(db_get_where('fp_posts',$check_id));
    
    if ($count > 0){
        $data = array(
        'PostId'=> $id,
        'PostAuthor'=>$authorId,
        'PostModify'=>date('Y-m-d h:i:s'),
        'PostTitle'=>$title,
        'PostTitleEn'=>$title_en,
        'PostContent'=> $content,
        'PostStatus'=> '2',
        'PostType'=>'post',
        'PostPassword'=>$pass,
        'Catergories'=>$catergory
        );
        $cond = array(
                'PostId'=>$id
            );
        //update data
        db_update('fp_posts',$data,$cond);
    }else{
        //insert data
        $data = array(
        'PostId'=> $id,
        'PostAuthor'=>$authorId,
        'PostDate'=>date('Y-m-d h:i:s'),
        'PostTitle'=>$title,
        'PostTitleEn'=>$title_en,
        'PostContent'=> $content,
        'PostStatus'=> '2',
        'PostType'=>'post',
        'PostPassword'=>$pass,
        'Catergories'=>$catergory
        );
        db_insert('fp_posts',$data);
    }
$status = "Published.";
}

?>

<div class="small-9 columns big-menu">
<script src="<?=VIRTUAL_PATH?>ckeditor/ckeditor.js"></script>
<form action="<?=THIS_PAGE?>" method="POST"/>
<input type="hidden" name="id" value="<?=$id?>" readonly/>
    <div class="row">
        <div class="small-12">
            <label for="title">Post Title*
                <input type="text" name="title" value="<?=$title?>" placeholder="Please enter title here." required/>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="small-12">
            <label for="title">Post Title in English*
                <input type="text" name="title_en" value="<?=$title_en?>" placeholder="Please enter english title here." required/>
            </label>
        </div>
    </div>
<?php
if ($_SESSION['infos']['role'] == 'Admin'){
?>
    <div class="row">
        <div class="small-12">
            <label for="title">Write by :*
                <select name="author" id="authour" required>
                    <option value="<?=$authorId?>"><?=$author?></option>
                    <?php
                    $res = db_get('fp_users');
                    for($i=0;$i<count($res);$i++){
                        if ($res[$i]['Id'] !=$authorId ){
                            echo '
                            <option value="'.$res[$i]['Id'].'">'.$res[$i]['LastName'].' '.$res[$i]['FirstName'].'</option>
                            ';    
                        }
                    }
                    ?>
                </select>
                
            </label>
        </div>
    </div>
<?php
}
?>
    <!-- div class="row">
        <div class="small-12">
            <label for="title">Post Password
                <input type="hidden" name="password" value="<?=$pass_no_en?>"/>
            </label>
        </div>
    </div -->
    
    
    <br/>
    <div class="row">
        <textarea name="post_content" id="post_content" rows="10" cols="80">
        <?=$content?>
        </textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'post_content' );
            </script>
    </div>
    <div class="row">
        <div class="small-12">
            <label for="">
                <input type="hidden" name="catergory" id="catergory" value='<?=$catergory?>' readonly/>
            </label>
        </div>
    </div>
    <div class="row">

        <div class="small-12">
        <?php
        if ($_SESSION['infos']['role'] == 'Admin'){

        
        ?>
            <input type="submit" class="button success right" name="publish" value="Publish"/>
        <?php
        }
        ?>
            <input type="submit" class="button right" name="save" value="Save"/>
            <span><?=$status?></span>
        </div>  
    </div>
</form>
</div>
<!-- Catergories check box-->
<div class="small-2 columns">
<h4>Catergories</h4>
    <ul class="tabs small-12" data-tabs id="example-tabs">
    <li class="tabs-title is-active small-5"><a href="#panel1" class="" aria-selected="true">All</a></li>
    <li class="tabs-title small-7"><a href="#panel2" class="">Most Used</a></li>
    </ul>
    <div class="tabs-content" data-tabs-content="example-tabs">
        <div class="tabs-panel is-active" id="panel1">
        <?php
            $res = db_get('catergories');
            for($i=0;$i<count($res);$i++)
            {
                if ($catergory !=""){
                    $cat_arr = explode(';',$catergory);
                    if(in_array($res[$i]['Id'],$cat_arr)){
                        $checked = "checked";
                    }else{
                        $checked = "";
                    }
                }else{
                    $checked="";
                }
            ?>
            <div class="row collapse">
                <div class="small-1 columns">
                    <input type="checkbox" onclick="class_checkbox('Cat<?=$res[$i]['Id']?>',this,'catergory')" 
                    class="Cat<?=$res[$i]['Id']?>" 
                    id="catergories<?=$i?>" value="<?=$res[$i]['Id']?>" <?=$checked?>
                    />
                </div>
                <div class="small-10 columns">
                    <label for="catergories<?=$i?>"><?=$res[$i]['Name']?></label>
                </div>
            </div>
            
        <?php
        }
        ?>        
        </div>
        <div class="tabs-panel" id="panel2">
           <?php
            $res_cat = db_get('fp_posts');
            $all_cat = array();
            for ($i=0;$i<count($res_cat);$i++){
                    
                    $cat = explode(';',$res_cat[$i]['Catergories']);
                    $all_cat = array_merge($all_cat,$cat);
            }
            $count_cat = array_count_values($all_cat);
            arsort($count_cat);
            $cat_name =array_keys($count_cat); $cat_value = array_values($count_cat);
            
            for($y=0;$y<count($cat_name);$y++){
                $data = array(
                    'Id'=>$cat_name[$y]
                );
                $name_cat = db_get_where('catergories',$data);
                if (count($name_cat)>10){
                    $count_name = 10;    
                }else{
                    $count_name = count($name_cat);
                }
                for($z=0;$z<$count_name;$z++){
                    if ($catergory!=""){
                        if(in_array($res[$z]['Id'],$cat_arr)){
                    $checked = "checked";
                    }else{
                        $checked = "";
                    }
                    }
                    
                ?>
                <div class="row collapse">
                    <div class="small-1 columns">
                        <input type="checkbox" onclick="class_checkbox('Cat<?=$name_cat[$z]['Id']?>',this,'catergory')"
                        class="Cat<?=$name_cat[$z]['Id']?>" 
                        id="catergories<?=$y?>" value="<?=$name_cat[$z]['Id']?>" <?=$checked?>
                        />
                    </div>
                    <div class="small-10 columns">
                        <label for="catergories<?=$y?>"><?=$name_cat[$z]['Name']?></label>
                    </div>
                </div>
                <?php
                }
            }
            
            ?>
        </div>
    </div>
</div>
