<?php
$user = $_POST['email'];
$pass = $_POST['pass'];
$result = db_get_where('admin','email',$user);
    for ($i=0;$i<count($result);$i++){
        echo pass_decrypt($result[$i]['password'],KEY_ENCRYPT);
        if ($pass == pass_decrypt($result[$i]['password'],KEY_ENCRYPT))
        {
         $_SESSION['pass'] = $result[$i]['password'];
         unset($_SESSION['error']);    
         header("Location: ".VIRTUAL_PATH."index.php/index.php");
         die;
        }
    }
    $_SESSION['error'] = 'Email and Password entered does not match';
    header("Location: ".VIRTUAL_PATH."index.php/login.php");
