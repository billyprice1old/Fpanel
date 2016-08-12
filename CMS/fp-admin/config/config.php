<?php
//config.php
define('DOMAIN','http://192.168.1.100/');#this the ip address or the domain to make easy to change when we change ip address.
define('DOMAIN_PHYSICAL','/Applications/XAMPP/htdocs/');
define('PREFIX', 'frdm_'); #Adds uniqueness to your DB table 

date_default_timezone_set('Asia/Bangkok'); #sets default date/timezone for this website

define('VIRTUAL_PATH', DOMAIN.'salatraju/fp-admin/'); 
# VIRTUAL_PATH URL of application for image view or link for admin
define('VIRTUAL_PATH_SITE', DOMAIN.'salatraju/fp-site/');
define('NAV_PATH', DOMAIN.'salatraju/');
#VIRTUAL_PATH_SITE URL of application for image view or link for front end
define('PHYSICAL_PATH', DOMAIN_PHYSICAL.'salatraju/fp-admin/');
define('PHYSICAL_PATH_SITE', DOMAIN_PHYSICAL.'salatraju/fp-site/');  
# Physical (PHP) 'root' of application for file & upload reference
define('INCLUDE_PATH', PHYSICAL_PATH . 'includes/'); 
define('INCLUDE_PATH_SITE', PHYSICAL_PATH_SITE . 'includes/');
# Path to PHP include files - INSIDE APPLICATION ROOT
define('IMG_PATH',VIRTUAL_PATH.'view/img/');
define('IMG_PATH_SITE',VIRTUAL_PATH_SITE.'uploads/img/');
#define session to use or not
define('SESSION',true);
define('KEY_ENCRYPT','200987');
/*
 * reference required include files here
 */
include PHYSICAL_PATH.'library/database.php';//stores all the function and credentials to connect to database
include PHYSICAL_PATH.'library/common.php'; //stores all unsightly application functions, etc.
include PHYSICAL_PATH.'library/pager.php'; //stores all the function to create pager.
ob_start();  #buffers our page to be prevent header errors. Call before INC files or ANY html!
header("Cache-Control: no-cache");header("Expires: -1");#Helps stop browser & proxy caching

///////Theme config////////////
define('THEME','fpanel');
//////////////////////////////
$layout = array(
    "left" => "3",
    "container" => "9",
    "right" => "0"
);
////////////////////////////////


//SET the VIEW_PAGE to show all the page view
//set the condition to delete the extension of page
//Do Not Make change after this section.
define('THIS_PAGE',basename($_SERVER['PHP_SELF']));
if (stripos(THIS_PAGE,".php") != -1){
  $this_page = explode('.',THIS_PAGE);
  define('VIEW_PAGE',$this_page[0]);
}else{
    define('VIEW_PAGE',basename($_SERVER['PHP_SELF']));    
}
//Define front end theme///
$res = db_get_limit('themes_use',0,1);
define('THEME_ID',$res[0]['Id']);
define('THEME_TITLE',$res[0]['Title']);
define('THEME_CUSTOMIZE',$res[0]['Active']);