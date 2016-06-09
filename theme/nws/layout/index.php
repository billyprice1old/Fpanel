
<?php
include 'nav_bar.php';
?>
<!-- content goes here -->				

<div class="small-12 columns no-padding">
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

</div>
<!-- End content goes here -->

 



