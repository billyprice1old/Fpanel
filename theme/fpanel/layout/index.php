
<?php
//////////////////////////////
$layout = array(
    "left" => "0",
    "container" => "12",
    "right" => "0"
);
include 'nav_bar.php';
?>
<!-- content goes here -->				


<?php
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

 



