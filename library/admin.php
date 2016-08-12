<?php

$y=1;
#check the session if exist or not
if (isset($_SESSION['pass']))
{//if session password exist 
    $result = db_get('admin');
    for ($i=0;$i<count($result);$i++){
        
        if ($_SESSION['pass'] == $result[$i]['password'])
        {    
        break;
        }
    
   
     if ($y++ == count($result))
     {
         unset($_SESSION['error']);
         if ($_SESSION['pass'] != pass_decrypt($row['password']))
         {
            header("Location: ".VIRTUAL_PATH."index.php/login.php");
             die;
             
         }
     }
    }    
}else{//if not set to login page
   unset($_SESSION['error']);
   header("Location: ".VIRTUAL_PATH."index.php/login.php");
   die;
}
