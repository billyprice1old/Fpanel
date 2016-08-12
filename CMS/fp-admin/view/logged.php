<?php
$user = $_POST['email'];
$pass = $_POST['pass'];
$data=array(
    'Email'=>$user
);
$result = db_get_where('fp_users',$data);
    for ($i=0;$i<count($result);$i++){
         
        if ($pass == pass_decrypt($result[$i]['Password'],KEY_ENCRYPT))
        {
            $_SESSION['pass'] = $result[$i]['Password'];
            $_SESSION['infos']= array(
                'username' => $result[$i]['Username'],
                'email' => $result[$i]['Email'],
                'role' => $result[$i]['Role'],
                'last_name' => $result[$i]['LastName'],
                'first_name' => $result[$i]['FirstName'],
                'date_create' => $result[$i]['DateCreate'],
                'id' => $result[$i]['Id']
            );
         unset($_SESSION['error']);    
         header("Location: ".VIRTUAL_PATH."index.php/index.php");
         die;
        }
    }
    $_SESSION['error'] = 'Email and Password entered does not match';
    header("Location: ".VIRTUAL_PATH."index.php/login.php");
