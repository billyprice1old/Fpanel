<?php
if(isset($_POST['submit'])){
    $postid = $_POST['id'];
	$comment = $_POST['comment'];
	if($_POST['Name']==""){
		$name = 'Unknown';
	}else{
		
		$name = htmlspecialchars($_POST['Name'],ENT_QUOTES);
	}
	$data = array(
		'PostID'=>$postid,
		'Description'=>$comment,
		'ByName'=>$name,
		'DatePost'=>date('Y-m-d')
	);
	db_insert('comments',$data);
    
    header('Location: '.NAV_PATH.'index.php/post?p='.$postid);
    
}
?>