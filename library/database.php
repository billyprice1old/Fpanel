<?php
include PHYSICAL_PATH.'config/credentials.php'; //stores database login info

#parameter $table is a table name to Insert
#$values is an associate array of the values and columns fileds

function db_insert($table,$values){
    $iConn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);//connect to database
    $field ="";
    $db_values="";
    $query = "";
    $y =1;
    foreach($values as $col => $value) {
        if ($y>1){
         $field .= ",`".$col."`";
         $db_values .= ",'".$value."'";   
        }else{
         $field = "`".$col."`";
         $db_values = "'".$value."'";
        }
             $y++;
    }
     $query = "Insert Into $table ($field) Values($db_values)";
     mysqli_query($iConn,$query) or die(mysqli_error($iConn)); 
}
function db_get($table){
    $res = array();
    $iConn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);//connect to database
    $query = "Select * from $table";
    $result = mysqli_query($iConn,$query) or die(mysqli_error($iConn));
    while ($row = mysqli_fetch_array($result)) {
        array_push($res,$row);
    }
    
    return $res;
}
function db_get_limit($table,$start,$num){
    $res = array();
    $iConn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);//connect to database
    $query = "Select * from $table LIMIT $start,$num";
    $result = mysqli_query($iConn,$query) or die(mysqli_error($iConn));
    while ($row = mysqli_fetch_array($result)) {
        array_push($res,$row);
    }
    
    return $res;
}
function db_get_where($table,$col,$value){
    $res = array();
    $iConn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);//connect to database
    $query = "Select * from $table Where `$col` = '$value'";
    $result = mysqli_query($iConn,$query) or die(mysqli_error($iConn));
    while ($row = mysqli_fetch_array($result)) {
        array_push($res,$row);
    }
    
    return $res;
}
function db_update($table,$values,$cond_col,$cond_value){
    $iConn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);//connect to database
    $field ="";
    $db_values="";
    $query = "";
    $y =1;
    foreach($values as $col => $value) {
        if ($y>1){
         $field .= ",`".$col."`='".$value."'";
            
        }else{
         $field = "`".$col."`='".$value."'";
         
        }
             $y++;
    }
     $query = "UPDATE $table Set $field WHERE `$cond_col`='$cond_value'";
     
     mysqli_query($iConn,$query) or die(mysqli_error($iConn)); 
}

function db_delete($table,$col,$value){
    $iConn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);//connect to database
    $query = "DELETE FROM $table WHERE `$col`='$value'";
    mysqli_query($iConn,$query) or die(mysqli_error($iConn));
}
//close connection to mysql
@mysqli_close($iConn);