<?php
include PHYSICAL_PATH.'library/admin.php';
$result = db_get('catergories');
$count = count($result);
?>
<div class="small-12 columns big-menu">
<form action="<?=THIS_PAGE?>" method="POST">
<button class="button" type="button" data-toggle="in_body">Add New</button>
    <div class="small-10 dropdown-pane" id="in_body" data-dropdown data-auto-focus="true">
        <div class="row">
            <div class="medium-10 columns">
                <label>Name
                    <input name="Name" type="text" required>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="medium-10 columns">
                <label>Description :
                    <textarea name="Description" id="" cols="30" rows="10"></textarea>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="medium-10 columns ">
                    <input type="submit" class="button button-green right" name="Save" value="Save">
            </div>
        </div>
</form>
</div>
<?php
if (isset($_POST['Save'])){
    $data = array(
        'Name'=> $_POST['Name'],
        'Description'=>$_POST['Description']
    );
    db_insert('catergories',$data);
    header('location: '.THIS_PAGE);
}
?>
<!-- List from here -->
<div class="small-12 columns big-menu">
<h3>CATERGORIES LIST</h3>
<div class="table-scroll">
  <table class="hover">
        <tr >
        <th class="small-6 center">Name</th><th class="small-5 center">Description</th><th class="center">Posts</th>
        </tr>
        <?php
        
        for($i=0;$i<$count;$i++)
        {
 
        echo'
        <tr class="small">
        <td>'.$result[$i]['Name'].'</td><td>'.$result[$i]['Description'].'</td><td></td>
        
        </tr>
        ';
        }
        ?>
  </table>
</div>
</div>