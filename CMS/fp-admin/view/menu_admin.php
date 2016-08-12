
<?php
//submit the drop menu to database
    if( isset($_POST['submit']) ){
        
        $res = db_get('menu','','','ORDER BY DropId DESC','LIMIT 0,1');
            if (count($res)>0){
                $dropId = $res[0]['DropId'] + 1;
            }else{
                $dropId = 1;
            }
        $dropId;
        $title = $_POST['menu_title'];
        $en_title = $_POST['en_title'];
        $data = array(
                'PostId'=>0,
                'DropId'=> $dropId,
                'MenuTitle'=>$title,
                'EnTitle'=>$en_title,
                'Type'=>1
        );
        db_insert('menu',$data);
        $str_item = $_POST['menu_item'];
        $arr_item = explode(";",$str_item);
        
        for($i=0;$i<count($arr_item);$i++){
                $count = count(db_get('menu',"WHERE PostId=$arr_item[$i]"));
                if ($count==0){
                $data_insert = array(
                'DropId'=> $dropId,
                'PostId'=>$arr_item[$i],
                'Type'=>2
                );
                db_insert('menu',$data_insert);
            }

        } 
        header('Location: '.THIS_PAGE);
        die;
    }
?>
<?php
///////This section is the code for update the menu
if (isset($_POST['update'])){
    $value = array(
        'MenuTitle'=>$_POST['title'],
        'EnTitle'=>$_POST['en_title']
    );
    $cond = array(
        'Id'=>$_POST['Id']
    );
    db_update('menu',$value,$cond);
    $str_item = $_POST['menu_item'];
        $arr_item = explode(";",$str_item);
        for($i=0;$i<count($arr_item);$i++){
                $count = count(db_get('menu',"WHERE PostId=$arr_item[$i]"));
                if ($count==0){
                $data_insert = array(
                'DropId'=> $_POST['dropId'],
                'PostId'=>$arr_item[$i],
                'Type'=>2
                );
                db_insert('menu',$data_insert);
            }

        }
    header('Location: '.THIS_PAGE);
    die;
}
///End update/////
///Start section delete/////
if (isset($_GET['DelId'])){
    
    if ($_SESSION['infos']['role'] == 'Admin'){
        //Do delete here
        $cond = array(
            'Id'=>$_GET['DelId']
        );
        db_delete('menu',$cond);
    }else{
        echo'
        <div class="small-12 medium-5 large-5 columns">
        You don\'t have the permission to delete this menu. Don\'t try to hack... 
        Ask your administartion to delete this.
        </div>';
    }
    header('Location: '.THIS_PAGE);
    die;
}
///End delete section////
/////////Form start for here //////////////
?>

<div class="small-12 medium-3 large-3 columns big-menu sub-left-side-bar">
    <ul class="vertical menu " data-accordion-menu>
    <?php
    $res = db_get('fp_posts','GROUP BY PostType');
    for($i=0;$i<count($res);$i++){
        
    ?>
        <li>
            <a href="#"><?php echo strtoupper($res[$i]['PostType'])?></a>
            <ul class="menu vertical nested">
            <?php
            $sub_res = db_get('fp_posts',"WHERE PostType='".$res[$i]['PostType']."'");
            for($y=0;$y<count($sub_res);$y++)
            {
                if($sub_res[$y]['PostId'] != 0){
            ?>
            <li><input type="checkbox" id="<?=$res[$i]['PostType']?><?=$sub_res[$y]['PostId']?>" 
            value="<?=$sub_res[$y]['PostId']?>"
            onclick = "check_value(this,'item4add<?=$i?>');check_innerHTML(this,'title<?=$i?>_<?=$y?>','title4add<?=$i?>')"
            />
            <span id="title<?=$i?>_<?=$y?>"><?=$sub_res[$y]['PostTitle']?></span></li>
            <?php
                }
            }
            ?>
            <input type="hidden" id="item4add<?=$i?>" readonly>
            <input type="hidden" id="title4add<?=$i?>" readonly>
            <li><button class="button-green small" 
            onclick="menu_add('item4add<?=$i?>','menu_list'
            ,'<?=VIRTUAL_PATH?>menu_add.php','drop_active',
            'title4add<?=$i?>','menu-item','menu-preview')"
            id="add2menu<?=$i?>">Add to menu</button></li>
            </ul>
        </li>
    <?php
        
    }
    ?>
    </ul>
</div>
<?php
//Here to check if this is in Edit mode or not
//if in edit mode don't show the list.
if (isset($_GET['EdiId']) && $_GET['EdiId'] !="" ){
    $checked  = 'checked';
?>
<div class="small-12 meidum-5 large-8 columns big-menu left">
    <form action="<?=THIS_PAGE?>" method="POST">
        <div class="small-12 medium-6 large-6 columns ">
        <label for="">Khmer Title : 
        <?php
            $res = db_get('menu','WHERE Id="'.$_GET['EdiId'].'"');
            
            echo '
            <input type="text" name="title" value="'.$res[0]['MenuTitle'].'">
            ';
        ?>
        </label>
        <input type="hidden" name="Id" value="<?=$_GET['EdiId']?>">
        <input type="hidden" name="dropId" value="<?=$res[0]['DropId']?>">
        </div>

        <div class="small-12 medium-6 large-6 columns">
        <label for="">English Title : 
        <?php
            echo '
            <input type="text" name="en_title" value="'.$res[0]['EnTitle'].'">
            ';
        ?>
        </label>
        </div>
        <input type="hidden" name="menu_item" id="menu-item">
        <div class="small-12 columns">
        <fieldset>
            <legend>Menu Item</legend>
        
            <ul class="menu vertical" id="menu-preview">
            <?php
                $res_item = db_get_inner_join('menu','fp_posts','PostId','PostId','WHERE DropId="'.$res[0]['DropId'].'"');
                for($i=0;$i<count($res_item);$i++){
                    if($res_item[$i]['MenuTitle'] != '' && $res_item[$i]['PostId']!=0){
                        echo '<li>'.$res_item[$i]['MenuTitle'].'</li>';
                    }else{
                        echo '<li>'.$res_item[$i]['PostTitle'].'</li>';
                    }
                    
                }
            ?>
            </ul>
        </fieldset>
        </div>
        

        <div class="small-12 medium-2 large-2 columns">
        <label for=""></br>
            <input type="submit" name="update" value="Update" class="button-green">
        </label>
        </div>
    </form>
</div>
<?php
}else{
    $checked  = '';
?>

<div class="small-12 meidum-5 large-8 columns big-menu left">
    <div class="row">
    
        <ul class="vertical menu" data-accordion-menu>
            <li class="menu-header">
                <a href="#" onclick="box_check('drop_active');">Create New Dropdrown</a>
                <ul class="menu vertical nested">
                <li>
                <form action="<?=THIS_PAGE?>" method="post">
                    <div class="menu-sample small-12">
                        
                        <div class="row ">
                                <div class="small-2 columns">
                                    <label for="middle-label" class="text-right middle">
                                    Menu Title</label>
                                </div>
                                <div class="small-4 columns">
                                    <input type="text" name="menu_title" id="middle-label" placeholder="This is the title that must be show">
                                </div>
                            <div class="small-2 columns">
                            <label for="middle-label" class="text-right middle">
                            English Title</label>
                            </div>
                            <div class="small-4 columns">
                                <input type="text" name="en_title" id="middle-label" placeholder="This is the title that must be show in english">
                            </div>
                        </div>
                        <i>Please add the item from the table at the left.</i>
                        
                    </div>
                    <input type="hidden" name="menu_item" id="menu-item">
                    <ul class="menu vertical" id="menu-preview"></ul><br>
                    <input type="submit" name="submit" value="submit" class="button">
                </form>
                </li>
                
                </ul>
            </li>
            
        </ul>
    </div>
<!--Read all from database-->
    <div class=" hover">
        <table>
        <thead>
            <tr>
                <th class="small-8">Titile</th><th class="small-2">Type</th>
            </tr>
        </thead>
        <tbody id="menu_list">
            <?php
            $res = db_get('menu');
            $count = count($res);
            $edit = '';$en_title='';
            if ($count == 0){
                echo '<tr><td colspan="3"><center>There no menu in the system</center></td></tr>';
            }else{
                $res1=db_get_inner_join('menu','fp_posts','PostId','PostId');
                for($i=0;$i<count($res1);$i++){
                    $edit = '';$en_title='';
                    if($res1[$i]['PostId'] == '0'){
                        $title = $res1[$i]['MenuTitle'];
                    }else{
                        if($res1[$i]['MenuTitle'] != ''){
                            $title = $res1[$i]['MenuTitle'];
                            $en_title = ' / '.$res1[$i]['EnTitle'];
                        }else{
                            $title = $res1[$i]['PostTitle'];
                            $en_title = ' / '.$res1[$i]['PostTitleEn'];
                        }
                        
                    }
                    if ($res1[$i]['Type'] == 0){
                        $type = 'Link';
                    }else if($res1[$i]['Type'] == 1){
                        $type = 'Menu Title';
                        $edit = '<a href="'.THIS_PAGE.'?EdiId='.$res1[$i]['Id'].'">Edit</a> |';
                        $en_title = ' / '.$res1[$i]['EnTitle'];
                    }else if($res1[$i]['Type'] == 2){
                        $type = 'Menu Item';
                    }
                    if($res1[$i]['MenuTitle'] == ''){
                        $addCaption = '<a href="'.THIS_PAGE.'?addCap='.$res1[$i]['Id'].'">Add Caption</a> |';
                    }else{
                        $addCaption ='';
                    }
                    
                    echo '
                    <tr>
                    <td>'.$title. $en_title.'
                    <br/> '.$edit.$addCaption.'
                    <a href="#" onclick="msgbox('."'Do you really want to delete this menu?','".THIS_PAGE."?DelId=".$res1[$i]['Id']."','_self','yesno'".');">Delete</a>
                    </td><td>'.$type.'</td>
                    </tr>
                    ';
                }
                
            }
            ?>
        </tbody>
        </table>
    </div>
</div>
<?php
}
?>

<input type="checkbox" id="drop_active" style="display:none;" <?=$checked?> />