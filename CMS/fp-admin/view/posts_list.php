<?php
include PHYSICAL_PATH.'library/admin.php';
if(isset($_GET['delid'])){
    $data = array(
        'PostId'=>$_GET['delid']
    );
    db_delete('fp_posts',$data);
    header("Location: ".THIS_PAGE);
}
if(isset($_GET['pubid'])){
    $data = array(
        'PostStatus'=>'2'
    );
    $cond = array(
        'PostId'=>$_GET['pubid']
    );
    db_update('fp_posts',$data,$cond);
    header("Location: ".THIS_PAGE);
}
if ($_SESSION['infos']['role'] == 'Admin'){
    $data = array(
        'PostType'=>'post',
    );
}else{
    $data = array(
        'PostType'=>'post',
        'PostAuthor'=>$_SESSION['infos']['id'],
    );
}

$result = db_get_where('fp_posts',$data,'ORDER BY PostDate DESC');
$count = count($result);
$res_status = db_get_count('fp_posts','PostTitle','PostStatus',$data);
$count_detail = count($res_status);
?>
<div class="small-12 columns big-menu">
<h3>POST LIST</h3>
<ul class="menu">
  <li class="menu-text">All(<?=$count?>)</li>
  <?php
  $status = '';
  for($i=0;$i<$count_detail;$i++)
        {
if ($res_status[$i]['Name'] != 0){
            if($res_status[$i]['Name']==1){
                $status = 'save';
            }else if($res_status[$i]['Name']==2){
                $status = 'publish';
            }else if($res_status[$i]['Name']==3){
                $status = 'editing';
            }
    echo '<li><a href="#">| '.$status.'(
        '.$res_status[$i]['Qty'].'
    )</a></li>';
        }
}
    
    ?>
  
  
</ul>
<div class="table-scroll">
  <table class="hover">
        <tr>
        <th class="small-5">Title</th><th>Author</th><th><i class="fa fa-comment" aria-hidden="true"></i></th><th>Post Status</th><th>Date</th>
        </tr>
        <?php
        
        for($i=0;$i<$count;$i++)
        {
        if($result[$i]['PostId']!=0){

        
            if($result[$i]['PostStatus'] == 1){
                $status = 'save';
                $quick_pub = '
                | <a href="?pubid='.$result[$i]['PostId'].'" class="small">Publish  </a>
                ';
            }else if($result[$i]['PostStatus']== 2){
                $status = 'publish';
                $quick_pub='';
            }else if($result[$i]['PostStatus']== 3){
                $status = 'editing';
                $quick_pub = '
                | <a href="?pubid='.$result[$i]['PostId'].'" class="small">Publish  </a>
                ';
            }
            //Compare date and get the date
            if ($result[$i]['PostModify']== NULL){
                $date = format_date($result[$i]['PostDate'],'d-m-Y h:i:s');
            }else{
                $date = format_date($result[$i]['PostModify'],'d-m-Y h:i:s');
            }
            //Get the author last and first name from fp_users
            $data = array(
                'Id'=>$result[$i]['PostAuthor']
            );
            $res_author = db_get_where('fp_users',$data);
            for($y=0;$y<count($res_author);$y++){
                $author = $res_author[$y]['LastName'].' '.$res_author[$y]['FirstName'];
            }
             
        echo'
        <tr>
        <td >'.$result[$i]['PostTitle'].'<br/>';
            if($result[$i]['PostAuthor'] == $_SESSION['infos']['id'] && $_SESSION['infos']['role'] != 'Admin'){
                echo '<a href="posts_add.php?id='.$result[$i]['PostId'].'" class="small">Edit </a> |
                <a href="#" onclick="msgbox('."'Do you want to delete this post?','?delid=".$result[$i]['PostId']."','_self','yesno'".')" class="small">Delete</a>';
            }
            if($_SESSION['infos']['role']== 'Admin'){
                echo '<a href="posts_add.php?id='.$result[$i]['PostId'].'" class="small">Edit </a>  | <a href="posts_preview.php?id='.$result[$i]['PostId'].'" target="_blank" class="small">View</a>
                '.$quick_pub;
            }
                
            
        echo '
        </td><td>'.$author.'</td><td></td>
                <td>'.$status.'</td><td>'.$date.'</td>
        </tr>';
        }
        }
        ?>
  </table>
</div>
</div>