
<?php
$cond = array(
	'PostType'=>'post',
	'PostStatus'=>2
);
$res_total = db_get_where('fp_posts',$cond);//get the total of the comments
$res = Pager_db('fp_posts',"WHERE PostType='post' AND PostStatus=2 ",'','ORDER BY PostDate DESC',10,'p');//divide into pagers.
for($i=0;$i<count($res);$i++){
	$con_user = array(
			'Id'=>$res[$i]['PostAuthor']
		);
	$res_user = db_get_where('fp_users',$con_user);

	$str_cont = htmlspecialchars_decode($res[$i]['PostContent'],ENT_QUOTES);
	$content = substr($str_cont,stripos($str_cont,'<p>'),stripos($str_cont,'</p>'));
	if ($res[$i]['PostModify'] !=""){
			$date = format_date($res[$i]['PostModify'],'d-m-Y');
			$time = format_date($res[$i]['PostModify'],'h:i A');
		}else{
			$date = format_date($res[$i]['PostDate'],'d-m-Y');
			$time = format_date($res[$i]['PostDate'],'h:i A');
		}
	//$content = htmlspecialchars_decode($res[$i]['PostContent'],ENT_QUOTES);
	echo '
	<div class="small-12 medium-8 large-8 medium-offset-2 large-offset-2 columns left post-thumb index-post">
	<h4><strong><a href="'.NAV_PATH.'index.php/post?p='.$res[$i]['PostId'].'">'.$res[$i]['PostTitle'].'</a></strong></h4>
	<h5 class="small"><i>ដោយ '.$res_user[0]['LastName'].' '.$res_user[0]['FirstName'].', '.$date.' , '.$time.'
		</i></h5>
		'.$content.'
 	</div>
	';
}
echo '<div class="small-12 medium-10 large-10 medium-offset-1 large-offset-1 columns left text-center index-post">';
Pager_Nav($res_total,10,'p');
echo '</div>';
?>
