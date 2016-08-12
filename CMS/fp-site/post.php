<div class="small-12 medium-8 large-8 medium-offset-2 large-offset-2 columns left post-thumb ">
<div class="small-12 post-block index-post">

	<?php
	
	$page_type='';
	if(isset($_GET['p'])){
		$id = $_GET['p'];
		$cond = array(
		
		'PostId'=>$id,
		'PostStatus'=>2
		);
		$res = db_get_where('fp_posts',$cond);
	}
	if(isset($_GET['mem'])){
		$id = $_GET['mem'];
		$cond = array(
		'PostId'=>$id,
		'PostStatus'=>2
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
		if(isset($_GET['mem'])){

		}else{
			echo '
		<h3>'.$res[$i]['PostTitle'].'</h3>';
		}
		
if ($page_type == 'post'){
		echo'
		<h4 class="small"><i>ដោយ '.$res_user[0]['LastName'].' '.$res_user[0]['FirstName'].', '.$date.', '.$time.'
		</i>';
}
		echo'
		</h4>
			'.$content.'
		
		';
	}
	
	?>
</div>
<!-- comment part -->
<div class="small-12 columns ruler"></div></br>
<?php
if ($page_type == 'post'){

$res_total = db_get('comments',"WHERE PostId=$id",'','ORDER BY DatePost DESC');//get the total of the comments
$res = Pager_db('comments',"WHERE PostId=$id",'','ORDER BY DatePost DESC',5,'cmt');//divide into pagers.
if (count($res)==0){
	
}else{
	echo '<center><h3>មានមតិចំនួន​'.count($res_total).':</h3></center>';
	for($i=0;$i<count($res);$i++){
		echo'
		<div class="small-12 columns cmt-area">
			<p><span class="cmt-name">'.$res[$i]['ByName'].'</span>
				<span class="cmt-date">commented on '.format_date($res[$i]['DatePost'],'d-m-Y').' at '.format_date($res[$i]['DatePost'],'h:i').'</span>
			</p>
			<p>
			'.$res[$i]['Description'].'
			</p>
		</div>
		';
	}
}

Pager_Nav($res_total,5,'cmt');
?>
<div class="small-12 columns ruler"></div></br>
<div>
	<form action="comment.php" method="POST">
	<input type="hidden" name='id' value="<?=$_GET['p']?>" readonly>
		<h3>ផ្តល់មតិយោបល់៖</h3>
		
		<div class="row">
			<label for="Name">ឈ្មោះរបស់អ្នក៖
				<input type="text" name='Name' id='Name'>
			</label>
		</div>
		<div class="row">
			<label for="comment">មតិរបស់អ្នក៖
				<textarea name="comment" id="comment" cols="30" rows="5" required></textarea>
			</label>
		</div>
		
		<input type="submit" class="button-green small" name="submit" value="បង្ហោះ">
	</form>
</div>
<?php
}
?>
</div>




