<div class="container">
        <div class="small-12 columns big-menu">
<?php

if(isset($_GET['id'])){
        $id = $_GET['id'];
        $result = db_get_where('hosting','HostID',$id);
        for ($i=0;$i<count($result);$i++){
            $domain = $result[$i]['Domain'];
        }
///disable hosting
shell_exec("sudo chmod 777 /etc/apache2/sites-available");
echo shell_exec("sudo a2dissite ".$domain.".conf");
echo '<br>';
echo shell_exec("sudo service apache2 reload");
echo '<br>';
echo shell_exec("sudo rm -f /etc/apache2/sites-available/".$domain.".conf");
echo '<br>Done!';
shell_exec("sudo chmod 755 /etc/apache2/sites-available");
        db_delete('hosting','HostID',$id);
        $result = "The data has beed deleted!";
    echo '
    <div class="row">
    <div class="small-12 columns title-row">
                
                <span class="section-title">'.$result.'</span>
    </div>
    <a href="host_list.php" class="flat-green button">Back to list</a><a href="index.php" class="flat-green button">Home</a>
    </div>
    ';        
    }else{
        $id = 0;
}



?>
</div>
    </div>