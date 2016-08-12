<div class="container">
        <div class="small-12 columns big-menu">
<?php

if (!isset($_POST['submit']))
{//show form
?>
            <div class="small-12 columns title-row">
            
            <span class="section-title">New Host</span>
            </div>    
            <form action="<?=THIS_PAGE?>" method="POST">
               <div class="row">
                    <div class="small-12 medium-6 large-6 columns">
                        <label for="company_name">Customer Name
                            <select name="clID" id="company_name" required>
                                <option value=""></option>
                                <?php
                                 
                                $result = db_get('customers');
                                for ($i=0;$i<count($result);$i++){
                                   echo '
                                   <option value="'.$result[$i]['CustomerID'].'">'.$result[$i]['CustomerName'].'</option>
                                   '; 
                                }
                                ?>
                            </select>
                        </label>        
                    </div>
                    <div class="small-12 medium-6 large-6 columns">
                        <label for="Domain">Domain
                        <input type="text" id="domain" name="domain" class="full-width" placeholder="example: domain.com" required>
                        </label>
                    </div>    
                    <div class="small-12 columns">
                        <label for="quota">Quota:
                        <input type="text" id="quota" name="quota" class="full-width">
                        </label>
                    </div>    
                    
                    <div class="small-12 medium-6 large-6 columns left">
                        
                        <input type="submit" name="submit" class="flat-green" value="Submit">
                        </label>
                    </div>    
                </div>
                
            </form>
        
<?php
}else{//submit form
    $domain = $_POST['domain'];
   $str_host = '<VirtualHost *:80> 
        ServerName www.'.$domain.'
        ServerAlias '.$domain.'
        ServerAdmin webmaster@localhost
        DocumentRoot /var/www/html/'.$domain.'/
        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined
         </VirtualHost>
        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined
        ';
        $result=""; 

  shell_exec("sudo chmod 777 /etc/apache2/sites-available");
  echo shell_exec("sudo echo '".$str_host."' >> /etc/apache2/sites-available/".$domain.".conf");
  shell_exec("sudo chown root:root /etc/apache2/sites-available/".$domain.".conf");
  echo shell_exec("sudo a2ensite ".$domain.".conf");
  echo '<br>';
  echo shell_exec("sudo service apache2 reload");
  echo '<br>';
  shell_exec("sudo chmod 755 /etc/apache2/sites-available");
  //inital the hosting setup
  ///Add the hosting information into databse
  $data = array('CustomerID' =>$_POST['clID'],
                'Domain' =>$_POST['domain'],
                'Qutoa' =>$_POST['quota'],
                'DateModify'=>date("Y-m-d") );
      db_insert('hosting',$data);
      $result .= $_POST['domain']." has beed hosted!";
  
  echo '
   <div class="small-12 columns title-row">
            
            <span class="section-title">'.$result.'</span>
   </div>
   <a href="'.THIS_PAGE.'" class="flat-green button">Add more</a><a href="index.php" class="flat-green button">Home</a>
  ';

}
?>
</div>
    </div>