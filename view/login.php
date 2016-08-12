   <div class="container">
		<div class="small-12 medium-6 medium-offset-3 columns">
			<div class="small-12 columns login-head">
				FPanel Login
			</div>
			<div class="small-12 columns login-form">
				<form action="logged.php" method="POST">
					<input type="email" placeholder="Email" name="email">
					<input type="password" placeholder="Password" name="pass">
					<input type="submit" name="submit" class="flat-purple right">
				</form>
			</div>
            
                <?php
                if(isset($_SESSION['error'])){
                    echo '<span class="label red">';
                    echo $_SESSION['error'];
                    echo '</span>';
                }
                ?>
		</div>
	</div>
