<?php
//config.php

define('PREFIX', 'frdm_'); #Adds uniqueness to your DB table 

date_default_timezone_set('Asia/Bangkok'); #sets default date/timezone for this website

define('VIRTUAL_PATH', 'http://localhost/fpanel/'); 
# VIRTUAL_PATH URL of application for image view or link
define('PHYSICAL_PATH', '/var/www/html/fpanel/');  
# Physical (PHP) 'root' of application for file & upload reference
define('INCLUDE_PATH', PHYSICAL_PATH . 'includes/'); 
# Path to PHP include files - INSIDE APPLICATION ROOT


/*
 * reference required include files here
 */
include 'credentials.php'; //stores database login info
include 'common.php'; //stores all unsightly application functions, etc.

ob_start();  #buffers our page to be prevent header errors. Call before INC files or ANY html!
header("Cache-Control: no-cache");header("Expires: -1");#Helps stop browser & proxy caching

///////Theme config////////////
define('THEME','old_fashion');
//////////////////////////////
$layout = array(
    "left" => "2",
    "container" => "10",
    "right" => "0"
);
////////////////////////////////
define('THIS_PAGE',basename($_SERVER['PHP_SELF']));

//SET the VIEW_PAGE to show all the page view
//set the condition to delete the extension of page
//Do Not Make change this section.
if (stripos(THIS_PAGE,".php") != -1){
  $this_page = explode('.',THIS_PAGE);
  define('VIEW_PAGE',$this_page[0]);
}else{
    define('VIEW_PAGE',basename($_SERVER['PHP_SELF']));    
}
