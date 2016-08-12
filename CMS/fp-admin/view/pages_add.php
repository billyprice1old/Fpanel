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
    $status='';
 if (isset($_GET['id'])){
     $id = $_GET['id'];
 } else{
     $id = '';
 }
//////////Looking for data to edit///////////////
$data = array(
    'PostId'=>$id
);
$res = db_get_where('fp_posts',$data);
for ($i=0;$i<count($res);$i++){
    if ($res[$i]['PostId'] != 0){
        $title=$res[$i]['PostTitle'];
        $title_en=$res[$i]['PostTitleEn'];
        $content=$res[$i]['PostContent'];
    }
}

}else if(isset($_POST['save'])){
    ///Save to draf
if($_POST['id'] ==""){
    $result = db_get_limit('fp_posts',0,1,'','ORDER BY PostId DESC');
    $id = $result[0]['PostId'] + 1;
}else{
    $id = $_POST['id'];
}
$title = htmlspecialchars($_POST['title'],ENT_QUOTES);
$title_en = htmlspecialchars($_POST['title_en'],ENT_QUOTES);
$content= htmlspecialchars($_POST['post_content'],ENT_QUOTES);
if($_POST['password']!=''){
    $pass = pass_encrypt(trim($_POST['password']),KEY_ENCRYPT);
}else{
    $pass= '';
}
$pass_no_en = trim($_POST['password']);
$data = array(
    'PostId'=>$id
);
$count = count(db_get_where('fp_posts',$data));
    if ($count > 0){
        if ($get_data[0]['PostStatus'] == 2 || $get_data[0]['PostStatus'] == 3){
            $data = array(
            'PostId'=> $id,
            'PostAuthor'=>$_SESSION['infos']['id'],
            'PostModify'=>date('Y-m-d h:i:s'),
            'PostTitle'=>$title,
            'PostTitleEn'=>$title_en,
            'PostContent'=> $content,
            'PostStatus'=> '3',
            'PostType'=>'page',
            'PostPassword'=>$pass,
            'Catergories'=>$catergory
            );
        }else{
            $data = array(
            'PostId'=> $id,
            'PostAuthor'=>$_SESSION['infos']['id'],
            'PostModify'=>date('Y-m-d h:i:s'),
            'PostTitle'=>$title,
            'PostTitleEn'=>$title_en,
            'PostContent'=> $content,
            'PostStatus'=> '1',
            'PostType'=>'page',
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
        'PostAuthor'=>$_SESSION['infos']['id'],
        'PostDate'=>date('Y-m-d h:i:s'),
        'PostTitle'=>$title,
        'PostTitleEn'=>$title_en,
        'PostContent'=> $content,
        'PostStatus'=> '1',
        'PostType'=>'page',
        'PostPassword'=>$pass
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
$content= htmlspecialchars($_POST['post_content'],ENT_QUOTES);
    if($_POST['password']!=''){
        $pass = pass_encrypt(trim($_POST['password']),KEY_ENCRYPT);
    }else{
        $pass= '';
    }
    $pass_no_en = trim($_POST['password']);
    $data = array(
    'PostId'=>$id
    );
    $count = count(db_get_where('fp_posts',$data));
    
    if ($count > 0){
        $data = array(
        'PostId'=> $id,
        'PostAuthor'=>$_SESSION['infos']['id'],
        'PostModify'=>date('Y-m-d h:i:s'),
        'PostTitle'=>$title,
        'PostTitleEn'=>$title_en,
        'PostContent'=> $content,
        'PostStatus'=> '2',
        'PostType'=>'page',
        'PostPassword'=>$pass
        );
        //update data
        $cond = array(
            'PostId'=>$id
        );
        db_update('fp_posts',$data,$cond);
    }else{
        //insert data
        $data = array(
        'PostId'=> $id,
        'PostAuthor'=>$_SESSION['infos']['id'],
        'PostDate'=>date('Y-m-d h:i:s'),
        'PostTitle'=>$title,
        'PostTitleEn'=>$title_en,
        'PostContent'=> $content,
        'PostStatus'=> '2',
        'PostType'=>'page',
        'PostPassword'=>$pass
        );
        db_insert('fp_posts',$data);
    }
    $status = "Published.";
}
?>
<div class="small-12 columns big-menu">
<script src="<?=VIRTUAL_PATH?>ckeditor/ckeditor.js"></script>
<form action="<?=THIS_PAGE?>" method="POST"/>
<input type="hidden" name="id" value="<?=$id?>" readonly/>
    <div class="row">
        <div class="small-12">
            <label for="title">Page Title*
                <input type="text" name="title" value="<?=$title?>" placeholder="Please enter title here." required/>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="small-12">
            <label for="title">Page Title (English)*
                <input type="text" name="title_en" value="<?=$title_en?>" placeholder="Please enter english title here." required/>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="small-12">
            <label for="title"><!--Page Password-->
                <input type="hidden" name="password" value="<?=$pass_no_en?>"/>
            </label>
        </div>
    </div>
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
            <input type="submit" class="button success right" name="publish" value="Publish"/>
            <input type="submit" class="button right" name="save" value="Save"/>
            <span><?=$status?></span>   
        </div>  
    </div>
</form>
</div>