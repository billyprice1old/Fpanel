<div class="container">
        <div class="small-12 columns big-menu">
<?php

if (!isset($_POST['submit']))
{//show form
?>
            <div class="small-12 columns title-row">
            
            <span class="section-title">New Customers</span>
            </div>    
            <form action="<?=THIS_PAGE?>" method="POST">
               <div class="row">
                    <div class="small-12 medium-6 large-6 columns">
                        <label for="company_name">Company Name
                        <input type="text" id="company_name" name="com_name" required>
                        </label>        
                    </div>
                    <div class="small-12 medium-6 large-6 columns">
                        <label for="client_name">Client Name
                        <input type="text" id="client_name" name="cl_name" class="full-width" required>
                        </label>
                    </div>    
                    <div class="small-12 medium-6 large-6 columns">
                        <label for="phone">Phone
                        <input type="text" id="phone" name="phone" class="full-width">
                        </label>
                    </div>    
                    <div class="small-12 medium-6 large-6 columns">
                        <label for="email">Email
                        <input type="email" id="email" name="email" class="full-width">
                        </label>
                    </div>    
                    <div class="small-12 medium-6 large-6 columns left">
                        
                        <input type="submit" name="submit" class="flat-green" value="Submit">
                        </label>
                    </div>    
                </div>
                
            </form>
        
<?php
}else{//submit form
  $data = array('CompanyName' => $_POST['com_name'],
                'CustomerName' =>$_POST['cl_name'],
                'Phone' =>$_POST['phone'],
                'Email' =>$_POST['email'],
                'DateModify'=>date("Y-m-d") );
      db_insert('customers',$data);
      $result = $_POST['com_name']." has beed saved!";
  
  echo '
   <div class="small-12 columns title-row">
            
            <span class="section-title">'.$result.'</span>
   </div>
   <a href="'.THIS_PAGE.'" class="flat-green button">Add more</a><a href="index.php" class="flat-green button">Home</a>
  ';
}
?>
</div>
    </div>