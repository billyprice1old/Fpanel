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
     @mysqli_close($iConn);
}
function db_get($table,$where="",$group="",$order="",$limit=""){
    $res = array();
    $iConn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);//connect to database
    $query = "Select * from $table $where $group $order $limit";
    $result = mysqli_query($iConn,$query) or die(mysqli_error($iConn));
    while ($row = mysqli_fetch_array($result)) {
        array_push($res,$row);
    }
    
    return $res;
    @mysqli_close($iConn);
}
//This get count
function db_get_count($table,$field,$group,$data_arr=''){
    $res = array();
    $res_ass = array();
    $iConn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);//connect to database
    $y =1;
    if ($data_arr == ''){
        $cond="";
    }else{
        foreach($data_arr as $col => $value) {
        if ($y>1){
         $cond .= "AND `".$col."`='".$value."'";
            
        }else{
         $cond = "WHERE `".$col."`='".$value."'";
         
        }
             $y++;
        }
    }
    
    $query = "Select $group,COUNT($field) from $table $cond GROUP BY $group";
    $result = mysqli_query($iConn,$query) or die(mysqli_error($iConn));
    while ($row = mysqli_fetch_array($result)) {
        $res_ass = array(
            'Name' => $row[$group], 
            'Qty' => $row['COUNT('.$field.')']
        );
        array_push($res,$res_ass);
    }
    
    return $res;
    @mysqli_close($iConn);
}

/*
This is the simplest, most understood Join and is the most common.
*/
function db_get_inner_join($table,$table_b,$col,$colb='',$where='',$group=''){
    $res = array();
    $iConn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);//connect to database
    $query = "Select * from $table as A INNER JOIN $table_b as B ON A.$col = B.$colb $where $group";
    $result = mysqli_query($iConn,$query) or die(mysqli_error($iConn));
    while ($row = mysqli_fetch_array($result)) {
        array_push($res,$row);
    }
    
    return $res;
    @mysqli_close($iConn);
}
/*
This query will return all of the records in the left table (table A) 
regardless if any of those records have a match in the right table (table B).
It will also return any matching records from the right table.
*/
function db_get_left_join($table,$table_b,$col){
    $res = array();
    $iConn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);//connect to database
    $query = "Select * from $table as A LEFT JOIN $table_b as B ON A.$col = B.$col";
    $result = mysqli_query($iConn,$query) or die(mysqli_error($iConn));
    while ($row = mysqli_fetch_array($result)) {
        array_push($res,$row);
    }
    
    return $res;
    @mysqli_close($iConn);
}
/*
This query will return all of the records in the right table (table B) 
regardless if any of those records have a match in the left table (table A). 
It will also return any matching records from the left table.
*/
function db_get_right_join($table,$table_b,$col, $where=''){
    $res = array();
    $iConn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);//connect to database
    $query = "Select * from $table $where as A RIGHT JOIN $table_b as B ON A.$col = B.$col";
    $result = mysqli_query($iConn,$query) or die(mysqli_error($iConn));
    while ($row = mysqli_fetch_array($result)) {
        array_push($res,$row);
    }
    
    return $res;
    @mysqli_close($iConn);
}
/*
This Join can also be referred to as a FULL OUTER JOIN or a FULL JOIN. 
This query will return all of the records from both tables, joining records from the left table (table A) 
that match records from the right table (table B).
*/
function db_get_outer_join($table,$table_b,$col, $where=''){
    $res = array();
    $iConn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);//connect to database
    $query = "Select * from $table $where as A FULL OUTER JOIN $table_b as B ON A.$col = B.$col";
    $result = mysqli_query($iConn,$query) or die(mysqli_error($iConn));
    while ($row = mysqli_fetch_array($result)) {
        array_push($res,$row);
    }
    
    return $res;
    @mysqli_close($iConn);
}

function db_get_limit($table,$start,$num,$cond='',$order=''){
    $res = array();
    $iConn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);//connect to database
    $y =1;
    if ($cond !=''){
        foreach($cond as $col => $value) {
        if ($y>1){
         $where .= "AND `".$col."`='".$value."'";
            
        }else{
         $where = "WHERE `".$col."`='".$value."'";
         
        }
             $y++;
        }
    }else{
        $where = '';
    }
    
    $query = "Select * from $table $where $order LIMIT $start,$num";
    $result = mysqli_query($iConn,$query) or die(mysqli_error($iConn));
    while ($row = mysqli_fetch_array($result)) {
        array_push($res,$row);
    }
    
    return $res;
    @mysqli_close($iConn);
}

function db_get_where($table,$data_arr, $order=''){
    $res = array();
    //dumpDie($data_arr);
    $iConn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);//connect to database
    $y =1;
    
    foreach($data_arr as $col => $value) {
        if ($y>1){
         $field .= "AND `".$col."`='".$value."'";
            
        }else{
         $field = "`".$col."`='".$value."'";
         
        }
             $y++;
    }
    $query = "Select * from $table Where $field $order";
    $result = mysqli_query($iConn,$query) or die(mysqli_error($iConn));
    while ($row = mysqli_fetch_array($result)) {
        array_push($res,$row);
    }
    
    return $res;
    @mysqli_close($iConn);
}
function db_update($table,$values,$cond_arr){
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
    $z=1;
    if ($cond_arr ==""){
        $cond = "";
    }else{
            foreach($cond_arr as $cond_col => $cond_value) {
            if ($z>1){
            $cond .= "AND `".$cond_col."`='".$cond_value."'";
                
            }else{
            $cond = "WHERE `".$cond_col."`='".$cond_value."'";
            
            }
                $z++;
        }
    }
    
     $query = "UPDATE $table Set $field $cond";
     
     mysqli_query($iConn,$query) or die(mysqli_error($iConn)); 
     @mysqli_close($iConn);
}

function db_delete($table,$data_arr){
    $iConn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);//connect to database
    $y =1;
    foreach($data_arr as $col => $value) {
        if ($y>1){
         $cond .= "AND `".$col."`='".$value."'";
            
        }else{
         $cond = "WHERE `".$col."`='".$value."'";
         
        }
             $y++;
    }
    $query = "DELETE FROM $table $cond";
    mysqli_query($iConn,$query) or die(mysqli_error($iConn));
    @mysqli_close($iConn);
}

function date_exist($query,$what){
    
    $iConn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);//connect to database
    $res = mysqli_query($iConn,$query) or die(mysqli_error($iConn));
    $count = mysqli_num_rows($res);
    if($count > 0){
        echo '<i class="label red">'. $what." is already existing.</i>";
    }else{
        echo '<i class="label green">'. $what." is available.</i>";
    }
    @mysqli_close($iConn);
}
