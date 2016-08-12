<?php
include PHYSICAL_PATH.'library/admin.php';
$username="";
$email="";
$first_name="";
$last_name="";
$role="";
$password = "";
$btn = 'save';
$id = '';
$require = 'required';
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $require = '';
    $btn = 'update';
    $data = array(
        'Id'=>$_GET['id']
    );
    $res = db_get_where('fp_users',$data);
    for($i=0;$i<count($res);$i++){
        $username = $res[$i]['Username'];
        $email = $res[$i]['Email'];
        $first_name = $res[$i]['FirstName'];
        $last_name = $res[$i]['LastName'];
        $role = $res[$i]['Role'];
        $password = pass_decrypt($res[$i]['Password'],KEY_ENCRYPT);
    }
}
?>

<div class="small-12 columns big-menu">
<?php
if(!isset($_POST['save']) && !isset($_POST['update']))
{
    
?>
<form action="<?=THIS_PAGE?>" method="POST"/>
        <input type="hidden" name='id' value='<?=$id?>'>
        <div class="row">
            <div class="small-3 columns">
            <label for="username" class="text-right middle">Username<i>(require)</i></label>
            </div>
            <div class="small-9 columns">
            <input type="text" name="username" id="username" placeholder="Username" value="<?=$username?>"
            onkeyup="username_validate(this.value,'user_notice','save')" required>
            <label id="user_notice"></label>
            </div>
        </div>
        <div class="row">
            <div class="small-3 columns">
            <label for="email" class="text-right middle">Email<i>(require)</i></label>
            </div>
            <div class="small-9 columns">
            <input type="email" name="email" onkeyup="data_exist('fp_users','Email',this.value,'notice','email')"
            value="<?=$email?>" 
            id="email" placeholder="email@email.com" required>
            <label id="notice"></label>
            </div>
        </div>
        <div class="row">
            <div class="small-3 columns">
            <label for="last_name" class="text-right middle">Last Name</label>
            </div>
            <div class="small-9 columns">
            <input type="text" name="last_name" id="last_name" placeholder="Last Name" value="<?=$last_name?>">
            </div>
        </div>
        <div class="row">
            <div class="small-3 columns">
            <label for="first_name" class="text-right middle">First Name</label>
            </div>
            <div class="small-9 columns">
            <input type="text" name="first_name" id="first_name" placeholder="First Name" value="<?=$first_name?>">
            </div>
        </div>
        <div class="row">
            <div class="small-3 columns">
                <label for="password" class="text-right middle">Password<i>(require)</i></label>
            </div>
            <div class="small-9 columns">
                <input type="password" name="password" id="password" placeholder="<?=$password?>" value="<?=$password?>" required>
            </div>
        </div>
        <div class="row">
            <div class="small-3 columns">
                <label for="role" class="text-right middle">Role<i>(require)</i></label>
            </div>
            <div class="small-9 columns">
                <select name="role" id="role" required>
                    <option value="<?=$role?>"><?=$role?></option>
                    <option value="Author">Author</option>
                    <option value="Editor">Editor</option>
                    <option value="Admin">Adminstration</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="small-12 columns ">
                <input type="submit" class="button right" name="<?=$btn?>" id='save' value="Save"/>
            </div>
        </div>
</form>


<?php
}else if(isset($_POST['save'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $last_name = $_POST['last_name'];
    $first_name =$_POST['first_name'];
    $password = pass_encrypt($_POST['password'],KEY_ENCRYPT);
    $role = $_POST['role'];
    $values = array(
        'Username'=> $username,
        'Email'=> $email,
        'FirstName'=> $first_name,
        'LastName'=> $last_name,
        'Password'=> $password,
        'Role'=> $role,
        'DateCreate'=> date('Y-m-d h:i:s')
    );
    $data= array(
        'Email'=>$email
    );
    $count = count(db_get_where('fp_users',$data));
    if ($count >0){
        $msg = "This email is not availble! Please select antoher one.";
    }else{
        db_insert('fp_users',$values);
        $msg = "User named ".$username." has created successfully!";
    }
echo '<h3>'.$msg.'</h3>';
}else if(isset($_POST['update'])){
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $last_name = $_POST['last_name'];
    $first_name =$_POST['first_name'];
    $password = pass_encrypt($_POST['password'],KEY_ENCRYPT);
    $role = $_POST['role'];
    $values = array(
        'Username'=> $username,
        'Email'=> $email,
        'LastName'=> $last_name,
        'FirstName'=> $first_name,
        'Password'=> $password,
        'Role'=> $role,
    );
    $cond =  array(
        'Id'=>$id
    );
    db_update('fp_users',$values,$cond);
    header('Location:users_list.php');
}
?>

</div>