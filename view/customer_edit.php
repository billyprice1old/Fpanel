<div class="container">
        <div class="small-12 columns big-menu">
<?php
if(isset($_GET['id'])){
        $id = $_GET['id'];
        
    }else{
        $id = 0;
    }
if (!isset($_POST['submit']))
{//show form
    
    $result = db_get_where('customers','CustomerID',$id);
         for ($i=0;$i<count($result);$i++){
             $com_name = $result[$i]['CompanyName'];
             $cl_name =  $result[$i]['CustomerName'];
             $phone =  $result[$i]['Phone'];
             $email =  $result[$i]['Email'];
         }
?>
            <div class="small-12 columns title-row">
            
            <span class="section-title">New Customers</span>
            </div>    
            <form action="<?=THIS_PAGE?>" method="POST">
                <input type="hidden" name="id" value="<?=$id?>">
               <div class="row">
                    <div class="small-12 medium-6 large-6 columns">
                        <label for="company_name">Company Name
                        <input type="text" id="company_name" name="com_name" value="<?=$com_name?>" required>
                        </label>        
                    </div>
                    <div class="small-12 medium-6 large-6 columns">
                        <label for="client_name">Client Name
                        <input type="text" id="client_name" name="cl_name" class="full-width" value="<?=$cl_name?>" required>
                        </label>
                    </div>    
                    <div class="small-12 medium-6 large-6 columns">
                        <label for="phone">Phone
                        <input type="text" id="phone" name="phone" class="full-width" value="<?=$phone?>">
                        </label>
                    </div>    
                    <div class="small-12 medium-6 large-6 columns">
                        <label for="email">Email
                        <input type="email" id="email" name="email" class="full-width" value="<?=$email?>">
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
  $id = $_POST['id'];
  $data = array('CompanyName' => $_POST['com_name'],
                'CustomerName' =>$_POST['cl_name'],
                'Phone' =>$_POST['phone'],
                'Email' =>$_POST['email'],
                'DateModify'=>date("Y-m-d") );
      db_update('customers',$data,'CustomerID',$id);
      $result = $_POST['com_name']." has beed saved!";
  
  echo '
  <div class="row">
   <div class="small-12 columns title-row">
            
            <span class="section-title">'.$result.'</span>
   </div>
   <a href="customer_list.php" class="flat-green button">Back to list</a><a href="index.php" class="flat-green button">Home</a>
   </div>
  ';
}
?>
</div>
    </div>