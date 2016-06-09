<?php
	$role = $_SESSION['role'];
if ($_SESSION['status'] != 1){
?>
<?php 	if ($role == "Developer" || $role == "Director" || $role == "CEO"){ ?>
<li><label><i class="fa fa-eye"></i> Electronic Store</label></li>	
	<li><a href="electronic/index.php">Home</a></li>
<li><label><i class="fa fa-plus-circle"></i> Administration</label></li>
	<li><a href="register.php">Create new employment</a></li>
	<li><a href="list_users.php">List of employment</a></li>
	<li><a href="program_add_form.php">Create new course</a></li>
	<?php 	if ($role == "Developer" || $role == "Director"){ ?>		
							<li><a href="destination_add_form.php">Create new destination</a></li>
	<?php } ?>		

<?php } ?>
<?php 	if ($role == "Developer" || $role == "Director" || $role == "CEO" || $role == "IT"){ ?>
<li><label><i class="fa fa-plus-circle"></i> Website</label></li>
	<li><a href="home_page.php">Home page</a></li>
	<li><a href="general_info.php">Genral info page</a></li>
	<li><a href="course_info.php">Course info page</a></li>
	<li><a href="scholarship.php">Scholarship page</a></li>
	<li><a href="#">Outstanding Student page</a></li>
	<li><a href="spelling_bee.php">Spelling Bees page</a></li>
	<li><a href="gallery.php">Gallery page</a></li>
	<li><a href="contact_page.php">Contact page</a></li>
	<li><a href="about.php">About page</a></li>
<?php } ?>

	<li><label><i class="fa fa-plus-circle"></i> Student Management</label></li>
	<li><a href="student_registration.php">Registration</a></li>
	<li><a href="student_list.php">List Students</a></li>
	<?php 	if ($role == "Developer" || $role == "Director" || $role == "CEO"){ ?>
	<li><a href="student_list_TrOut.php">List Transfer In/Out</a></li>
	<?php } ?>
<li><label><i class="fa fa-eye"></i> Book Store</label></li>
		<?php 	if ($role == "Developer" || $role == "Director"  || $role == "Account"){ ?>
		<li><a href="book_stock_list.php">List all item in stock</a></li>
        <li><a href="book_stock_in.php">Stock In</a></li>
		<li><a href="book_stock_out.php">Stock Out</a></li>

		<?php } ?>
		<li><a href="book_stock_report.php">Stock Report</a></li>
		<li><a href="pos.php">Book Sale System</a></li>
	<?php 	if ($role == "Developer" || $role == "Director" || $role == "CEO" || $role == "Account"){ ?>
<li><label><i class="fa fa-eye"></i> Accounting</label></li>
			<li><a href="income_create_item_form.php">Create new Items</a></li>
					<li><a href="income_entry_form.php">Income entry</a></li>
					<li><a href="inventory.php">Inventory</a></li>
		<?php } ?>
	<?php 	if ($role == "Developer" || $role == "Director" || $role == "CEO"){ ?>

<li><label><i class="fa fa-eye"></i> Report</label></li>
	<li><a href="report_registration.php">Registration</a></li>
	<li><a href="report_book_store.php">Book Store</a></li>
	<li><a href="report_class.php">Class</a></li>
	<li><a href="report_income.php">Income</a></li>
<li><label><i class="fa fa-eye"></i> Static</label></li>
	<li><a href="static_registration.php">Registration</a></li>

	
<?php }
}
?>