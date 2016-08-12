<?php
include PHYSICAL_PATH.'library/admin.php';
$result = db_get('fp_users');
$count = count($result);
$res_role = db_get_count('fp_users','Username','Role');
$count_detail = count(db_get_count('fp_users','Username','Role'));
if(isset($_GET['delid'])){
    $data = array(
        'Id'=>$_GET['delid']
    );
    db_delete('fp_users',$data);
    header("Location: ".THIS_PAGE);
}
?>

<div class="small-12 columns big-menu">
<h3>USERS</h3>
<ul class="menu">
  <li class="menu-text">All(<?=$count?>)</li>
  <?php
  for($i=0;$i<$count_detail;$i++)
        {
    echo '<li><a href="#">| '.$res_role[$i]['Name'].'(
        '.$res_role[$i]['Qty'].'
    )</a></li>';
        }
    ?>
  
  
</ul>
<div class="table-scroll">
  <table class="hover">
        <tr>
        <th>Username</th><th>Name</th><th>Email</th><th>Role</th><th>Posts</th><th>Pages</th>
        </tr>
        <?php
        
        for($i=0;$i<$count;$i++)
        {
            $data = array(
                'PostAuthor'=>$result[$i]['Id'],
                'PostType'=>'post'
            );
            $data_page = array(
                'PostAuthor'=>$result[$i]['Id'],
                'PostType'=>'page'
            );
            $count_post = count(db_get_where('fp_posts',$data));
            $count_page = count(db_get_where('fp_posts',$data_page));
        echo'
        <tr>
        <td>'.$result[$i]['Username'].'<br/>
        <a href="users_add.php?id='.$result[$i]['Id'].'" class="small">Edit | </a>
        <a href="#" onclick="msgbox('."'Do you want to delete this user?','?delid=".$result[$i]['Id']."','_self','yesno'".')" class="small">Delete</a>
        </td>
        <td>'.$result[$i]['LastName'].' '.$result[$i]['FirstName'].'</td>
        <td>'.$result[$i]['Email'].'</td>
        <td>'.$result[$i]['Role'].'</td>
        <td>'.$count_post.'</td>
        <td>'.$count_page.'</td>
        </tr>
        ';
        }
        ?>
  </table>
</div>
</div>