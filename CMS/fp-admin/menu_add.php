<?php
include 'config/config.php';
if(isset($_GET['m'])){

    $str_m = $_GET['m'];
    $arr_m = explode(";",$str_m);
    for($i=0;$i<count($arr_m);$i++){
        //check postid
        $count = count(db_get('menu',"WHERE PostId=$arr_m[$i]"));
        if ($count==0){
            $data_insert = array(
            'PostId'=>$arr_m[$i],
            'Type'=>'0'
            );
            db_insert('menu',$data_insert);
        }
    }

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