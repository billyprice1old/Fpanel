<div class="container">
    <div class="small-12 columns big-menu">
            <div class="small-12 columns title-row">        
            <span class="section-title">Host List</span>
            </div>     
            <div class="row">
                <table class="hover border">
                    <thead>
                        <tr>
                            <th>ID</th><th>Host's ID</th><th>Customer's Name</th><th>Domain</th><th>Date Modify</th><th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        $result = db_get_left_join('hosting','customers','CustomerID');
                        //<a href="customer_edit.php?id='.$result[$i]['CustomerID'].'" class="flat-green button tiny">Edit</a>
                        for ($i=0;$i<count($result);$i++){
                            $id =$i+1;
                         echo '
                         <tr>
                         <td>'.$id.'</td><td>'.$result[$i]['HostID'].'</td><td>'.$result[$i]['CustomerName'].'</td>
                         <td>'.$result[$i]['Domain'].'</td><td>'.$result[$i]['DateModify'].'</td>
                         <td>
                         
                         <a href="#" onclick="msgbox('.
                         "'Are you sure to delete this customer?','host_delete.php?id=".$result[$i]['HostID']."','_self','yesno'"
                         .')" class="flat-red button tiny">Delete</a>
                         </td>
                         </tr>
                         ';   
                        }
                        ?>
                        
                    </tbody>
                    
                </table>
            </div>
        

    </div>
</div>