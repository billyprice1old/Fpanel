<div class="container">
        <div class="small-12 columns big-menu">
<?php
if(isset($_GET['id'])){
        $id = $_GET['id'];
        db_delete('customers','CustomerID',$id);
        $result = "The data has beed deleted!";
    echo '
    <div class="row">
    <div class="small-12 columns title-row">
                
                <span class="section-title">'.$result.'</span>
    </div>
    <a href="customer_list.php" class="flat-green button">Back to list</a><a href="index.php" class="flat-green button">Home</a>
    </div>
    ';        
    }else{
        $id = 0;
}



?>
</div>
    </div>