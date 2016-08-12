
<?php
//////////////////////////////
$layout = array(
    "left" => "2",
    "container" => "10",
    "right" => "0"
);
include 'nav_bar.php';
?>
<!-- content goes here -->				
<?php
if(VIEW_PAGE == 'login'){
    $layout['left'] = 0;
    $layout['container'] = 12;
}
if ($layout['left'] > 0)
{// i compare the string to know if the theme need left panel or not.
    include 'left_panel.php'; 
}

if ($layout['container'] > 0)
{// i compare the string to know if the theme need left panel or not.
    include 'container.php'; 
}

if ($layout['right'] > 0)
{// i compare the string to know if the theme need left panel or not.
    include 'right_panel.php'; 
}
?>


<!-- End content goes here -->

 



