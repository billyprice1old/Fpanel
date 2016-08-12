<?php

$y=1;
#check the session if exist or not
if (isset($_SESSION['pass']))
{//if session password exist 
    $result = db_get('fp_users');
    for ($i=0;$i<count($result);$i++){
        
        if ($_SESSION['pass'] == $result[$i]['Password'])
        {    
        break;
        die;
        }
    
   
     if ($y++ == count($result))
     {
         unset($_SESSION['error']);
         if ($_SESSION['pass'] != pass_decrypt($row['Password']))
         {
            header("Location: ".VIRTUAL_PATH."index.php/login.php");
            unset($_SESSION['pass']);
            unset($_SESSION['infos']);
            die;
             
         }
     }
    }    
}else{//if not set to login page
   unset($_SESSION['error']);
   header("Location: ".VIRTUAL_PATH."index.php/login.php");
   die;
}
