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
	            $Feedback = '';//no feedback necessary
	        }
	    
	    
	    
	}else{//ifrom there are no records
	       $Feedback = '';
	}
	if ($_SESSION['status'] != 1){
?> 

<nav class="top-bar show-for-large-only" data-topbar role="navigation" data-options="is_hover: false">
	<ul class="title-area">
		<li class="name">
		<a href="#"><img src="img/logo.png" alt="logo" class="logo"></a>
		</li>
		<!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
		<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
	</ul>
	
	<section class="top-bar-section">
		<!-- Right Nav Section -->
		<ul class="right">
			<li><a href="index.php">Home</a></li>
			<li><img src="img/<?php echo $folder.$img;?>" alt="photo" class="profile-small"></li>
			<li class="has-dropdown">
				<a href="#"><i class="fa fa-cogs"></i></a>
				<ul class="dropdown">
					<li><a href="setting.php">Settings</a></li>
					<!--li><a href="#">Help</a></li>
					<li><a href="#">Report</a></li>
					<li><a href="#">About Commander</a></li -->
					<li><a href="index.php?p=out">Log Out</a></li>
				</ul>
			</li>
		</ul>
	<?php
	$role = $_SESSION['role'];

?>
		<!-- Left Nav Section -->
		<ul class="left">
			<?php 	if ($role == "Developer" || $role == "Director" || $role == "CEO"){ ?>
			<li class="has-dropdown">
				
				<a href="#"><i class="fa fa-plus"></i> Admin </a>
				<ul class="dropdown">
					<li><a href="register.php">Create new employment</a></li>
					<li><a href="list_users.php">List of employment</a></li>
					<li><a href="program_add_form.php">Create new course</a></li>
					<?php 	if ($role == "Developer" || $role == "Director"){ ?>		
							<li><a href="destination_add_form.php">Create new destination</a></li>
					<?php } ?>		
				</ul>
			</li>
            <?php } ?>
			<?php 	if ($role == "Developer" || $role == "Director" || $role == "CEO" || $role == "IT"){ ?>
            <li class="has-dropdown">
				<a href="#"><i class="fa fa-globe"></i> Website</a>
				<ul class="dropdown">
					<li><a href="home_page.php">Home page</a></li>
                    <li><a href="general_info.php">Genral info page</a></li>
                    <li><a href="course_info.php">Course info page</a></li>
                    <li><a href="scholarship.php">Scholarship page</a></li>
                    <li><a href="#">Outstanding Student page</a></li>
                    <li><a href="spelling_bee.php">Spelling Bees page</a></li>
                    <li><a href="gallery.php">Gallery page</a></li>
                    <li><a href="contact_page.php">Contact page</a></li>
                    <li><a href="about.php">About page</a></li>
				</ul>
			</li>
            <?php } ?>
            
			<li class="has-dropdown">
				<a href="#"><i class="fa fa-users"></i> Student Management</a>
				<ul class="dropdown">
					<li><a href="student_registration.php">Registration</a></li>
					<li><a href="student_list.php">List Students</a></li>
					
					<?php 	if ($role == "Developer" || $role == "Director" || $role == "CEO"){ ?>
                    <li><a href="student_list_TrOut.php">List Transfer In/Out</a></li>
                    <?php } ?>
					
				</ul>
			</li>
			
            <li class="has-dropdown">
				<a href="#"><i class="fa fa-book"></i> Book Store</a>
				<ul class="dropdown">
					<?php 	if ($role == "Developer" || $role == "Director" || $role == "Account"){ ?>
					<li><a href="book_stock_list.php">List all item in stock</a></li>
                    <li><a href="book_stock_in.php">Stock In</a></li>
					<li><a href="book_stock_out.php">Stock Out</a></li>
					
					<?php } ?>
                    <li><a href="book_stock_report.php">Stock Report</a></li>
					
                    <li><a href="pos.php">Book Sale System</a></li>
					
				</ul>
			</li>
			<?php 	if ($role == "Developer" || $role == "Director" || $role == "CEO" || $role == "Account"){ ?>
			<li class="has-dropdown">
				<a href="#"><i class="fa fa-book"></i> Accounting</a>
				<ul class="dropdown">
					<li><a href="income_create_item_form.php">Create new Items</a></li>
					<li><a href="income_entry_form.php">Income entry</a></li>
					<li><a href="inventory.php">Inventory</a></li>
				</ul>
			</li>	
			<?php } ?>
			<?php 	if ($role == "Developer" || $role == "Director" || $role == "CEO"){ ?>
			<li class="has-dropdown">
				<a href="#"><i class="fa fa-eye"></i> Report</a>
				<ul class="dropdown">				
					<li><a href="report_registration.php">Registration</a></li>
					<li><a href="report_book_store.php">Book Store</a></li>
					<li><a href="report_class.php">Class</a></li>
					<li><a href="report_income.php">Income</a></li>
					
				</ul>
			</li>
			<li class="has-dropdown">
				<a href="#"><i class="fa fa-eye"></i> Static</a>
				<ul class="dropdown">				
					<li><a href="static_registration.php">Registration</a></li>	
					
				</ul>
			</li>
	
		<li class="name">
		<a href="electronic/index.php">Electronic Store</a>
		</li>
	
	
			<?php 
			} 
	}
	?>
		</ul>
	</section>
</nav>