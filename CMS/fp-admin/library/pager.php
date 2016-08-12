<?php
#Alway include after database.php//
#data_arr is the array that we want to divide into the pagers.
#$numPage is the number of contents we want to show per pages.
#$name is a name of variable to define the page of the pagers.
function Pager_db($table,$where,$group,$order,$numPage,$name){
    $pages=0;
    if (!isset($_GET[$name])){
        $current = 1;
    }else{
        $current = $_GET[$name];
    }
    $start = ($current - 1)* $numPage;
    $end = ($current * $numPage);
    $res = array();
    $iConn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);//connect to database
    $query = "Select * from $table $where $group $order LIMIT $start,$numPage";
    $result = mysqli_query($iConn,$query) or die(mysqli_error($iConn));
    while ($row = mysqli_fetch_array($result)) {
        array_push($res,$row);
    }
    
    return $res;
    @mysqli_close($iConn);
}
function Pager_Nav($data_arr,$numPage,$name){
    $request_url = $_SERVER['REQUEST_URI'];
    $pages=0;
    $count = count($data_arr);
    if (!isset($_GET[$name])){
        $current = 1;
    }else{
        $current = $_GET[$name];
    }
    $next_page = $current + 1;
    $prev_page = $current - 1;
    
    if (stripos($request_url,'?') != -1 && stripos($request_url,'?') != ''){
        
        if (stripos($request_url,'&'.$name) != -1 && stripos($request_url,'&'.$name) != ''){
            $prev_url = substr($request_url,0,stripos($request_url,'&')+1).$name.'='.$prev_page;
            $next_url =substr($request_url,0,stripos($request_url,'&')+1).$name.'='.$next_page;
        }else if (stripos($request_url,$name) != -1 && stripos($request_url,$name) != ''){
            $prev_url = substr($request_url,0,stripos($request_url,'?')+1).$name.'='.$prev_page;
            $next_url =substr($request_url,0,stripos($request_url,'?')+1).$name.'='.$next_page;
        }else{
            
            $prev_url = $request_url . '&'.$name.'='.$prev_page;
            $next_url = $request_url .'&'.$name.'='.$next_page;
        }
    }else{
        $prev_url = $_SERVER['PHP_SELF'].'?'.$name.'='.$prev_page;
        $next_url = $_SERVER['PHP_SELF'].'?'.$name.'='.$next_page; 
    }
    $prev = '<a href="'.$prev_url.'"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>';
    $next = '<a href="'.$next_url.'"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>';

    $mod = $count % $numPage;
    if ($mod > 0){
        $pages =  floor($count / $numPage)+1;
    }else{
        $pages = floor($count / $numPage);
    }
    if($pages >1){
        if ($current > 1 && $current < $pages){
        echo '<label>​'.$prev.' ទំព័រទី​ '. $current .$next.'</label>';
        }elseif ($current == $pages){
            echo '<label>​'.$prev. ' ទំព័រទី​ ' . $current . '</label>';
            
        }else if ($current == 1){
            echo '<label>​ ទំព័រទី​ ' . $current .$next. '</label>';
        }else{
            echo '<h3>Pages not found</h3>';
        }
    }
    
    
}
