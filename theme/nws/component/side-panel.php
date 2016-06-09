<?php 
	

	$id = $_SESSION['UID'];
	$folder = "profileIMG"."/";

	$sql = "select * from admin where id=$id";

	//We connect to the db here
	$iConn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

	//We extract the data here
	$result = mysqli_query($iConn,$sql);

	if(mysqli_num_rows($result) > 0)
	{//show records
	    
	    while ($row = mysqli_fetch_assoc($result))
	        {
				$img = $row['profileThumb'];
				$first_name = $row['first_name'];
				$last_name = $row['last_name'];
				$email = $row['email'];
				$role = $row['role'];
	            $Feedback = '';//no feedback necessary
	        }
	    
	    
	    
	}else{//ifrom there are no records
	       $Feedback = '<p>This records does not exitst</p>';
	}
?>

<img src="img/<?php echo $folder.$img; ?>" alt="profile-picture"> 
<p class="user-name"><?php echo $first_name." ".$last_name;?></p>
<p class="user-email"><?php echo $email;?></p>
<p class="user-role"><?php echo $role; ?></p>
<p>
	<button class="flat-white" id="ct"></button>
</p>
<h4 class="white">Welcome!</h4>
Have a nice day! <br>
Happy working! <br>
