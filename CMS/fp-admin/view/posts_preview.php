<?php
include PHYSICAL_PATH.'library/admin.php';
?>

<div class="small-12 columns big-menu">
<?php
if(isset($_GET['id'])){
		$id = $_GET['id'];
		$cond = array(
		'PostId'=>$id,
		);
		$res = db_get_where('fp_posts',$cond);
}
for($i=0;$i<count($res);$i++){
		$page_type = $res[$i]['PostType'];
		$content = htmlspecialchars_decode($res[$i]['PostContent'],ENT_QUOTES);
		if ($res[$i]['PostModify'] !=""){
			$date = format_date($res[$i]['PostModify'],'d-m-Y');
			$time = format_date($res[$i]['PostModify'],'h:i A');
		}else{
			$date = format_date($res[$i]['PostDate'],'d-m-Y');
			$time = format_date($res[$i]['PostDate'],'h:i A');
		}
		$con_user = array(
			'Id'=>$res[$i]['PostAuthor']
		);
		$res_user = db_get_where('fp_users',$con_user);
		echo '
		<h3>'.$res[$i]['PostTitle'].'</h3>';
        echo'
		<h4 class="small"><i>by : '.$res_user[0]['LastName'].' '.$res_user[0]['FirstName'].'
		on '.$date.' at '.$time.'
		</i>';
        	echo'
		</h4>
			'.$content.'
		
		';
	}
?>
</div>






