//img_view is a function to view the picture when we just select from file. 
function img_view(input,receiver,width,height) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
    $(receiver)
    .attr('src', e.target.result)
    .css('width',width)
    .css('height',height);
    };
    
    reader.readAsDataURL(input.files[0]);
    }
}
//function to print the container of an div.
function printContent(el,type_print,title)
{
	var restorepage = document.body.innerHTML;
  var printcontent;
  if (type_print == "receipt")
  {
    printcontent = document.getElementById(el).innerHTML + document.getElementById(el).innerHTML;  
  }else if (type_print == "table"){
    var Table_list = document.getElementById("table_employee");
	
      for (var i=0; i< Table_list.rows.length;i++)
      {
        if (i == 0)
        {
        Table_list.rows[i].deleteCell(8);  
        }else{
        Table_list.rows[i].deleteCell(10);  
        }
        
      }
    printcontent = '<h3 style="text-align:center;">'+title+'</h3>'+ document.getElementById(el).innerHTML;
  } else{
    printcontent = document.getElementById(el).innerHTML;
  }
	
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
  
}
//msgbox is alert function that combine the window.opn with confrim dialogue
function msgbox(message,url,target,yesno)
{
  
  if(yesno == "yesno")
  {
    if (confirm(message)){
      //save it here
      window.open(url,target);
    }else{
      //do nothing
    }
  }else{
    alert(message);
    window.open(url,target);
  }
}
//nav_color is to change the navigation background color
function bg_color(receiver,color){
    document.getElementById(receiver).style.backgroundColor = '#'+color;
}
function text_color(receiver,color){
    var elem_a = document.getElementById(receiver).getElementsByTagName('a');
    var elem_p = document.getElementById(receiver).getElementsByTagName('p');
    for (var i=0;i<elem_a.length;i++ ){
      elem_a[i].style.color = '#' + color;
    }
    for (var i=0;i<elem_p.length;i++ ){
      elem_p[i].style.color = '#' + color;
    }
}
function bd_img(input,receiver){
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
    $(receiver)
    .css('background-image', "url("+e.target.result+")");
    };
    
    reader.readAsDataURL(input.files[0]);
    }
}
function data_exist(table,field,val,receiver,what){
  var checking = "select * from "+table+" where `"+field+"`='"+val+"'";
    if (val == ""){
      document.getElementById(receiver).innerHTML = '';
    }
    var xhttp;
        xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
              
                document.getElementById(receiver).innerHTML =  xhttp.responseText;
            }
          };
      xhttp.open("GET", "../library/data_exist.php?checking="+checking+"&what="+what, true);
      xhttp.send();
}
function username_validate(str,receiver,btn){
  
  if (str.indexOf("'") != -1){
    document.getElementById(receiver).innerHTML = '<i class="label red">The username can\'t containt any of sigle quote \' and double quotes \". </i>';  
    document.getElementById(btn).disabled = true;  
}else if (str.indexOf('"') != -1){
    document.getElementById(receiver).innerHTML = '<i class="label red">The username can\'t containt any of sigle quote \' and double quotes \". </i>';
    document.getElementById(btn).disabled = true;
  }else{
    document.getElementById(receiver).innerHTML ='';
    document.getElementById(btn).disabled = false;
  }

}

function class_checkbox(Cname,id,receiver){
  var el = document.getElementsByClassName(Cname);
  var val_receiver = document.getElementById(receiver).value;
if (id.checked == true){
  
    if (val_receiver == ""){
      document.getElementById(receiver).value = id.value;
  
    }else{
  
      document.getElementById(receiver).value += ";" + id.value;
    }
    for(var i=0;i<el.length;i++){
      el[i].checked = true;
    }
  }else{
    for(var i=0;i<el.length;i++){
      el[i].checked = false;
    }
     ////convert to array
  var arr_receiver = val_receiver.split(';');
  ////get indexOf value in array    
  var index_receiver = arr_receiver.indexOf(id.value);
    if (index_receiver!=-1){
      arr_receiver.splice(index_receiver,1);
    }else{
      arr_receiver.splice(0,1);
    }
    ///Clear receiver 
    document.getElementById(receiver).value  = "";
    ///split array into string to use with comma (;)
    for (i=0;i < arr_receiver.length;i++){
        if (document.getElementById(receiver).value == ""){
          document.getElementById(receiver).value = arr_receiver[i];
        }else{
          document.getElementById(receiver).value += ";"+ arr_receiver[i];
        }
    }  
  }
}
function check_value(id,receiver){
  var val_receiver = document.getElementById(receiver).value;
  if (id.checked == true){
  
    if (val_receiver == ""){
      document.getElementById(receiver).value = id.value;
  
    }else{
  
      document.getElementById(receiver).value += ";" + id.value;
    }
   
  }else{
   
    ////convert to array
  var arr_receiver = val_receiver.split(';');
  ////get indexOf value in array    
  var index_receiver = arr_receiver.indexOf(id.value);
    if (index_receiver!=-1){
      arr_receiver.splice(index_receiver,1);
    }else{
      arr_receiver.splice(0,1);
    }
    ///Clear receiver 
    document.getElementById(receiver).value  = "";
    ///split array into string to use with comma (;)
    for (i=0;i < arr_receiver.length;i++){
        if (document.getElementById(receiver).value == ""){
          document.getElementById(receiver).value = arr_receiver[i];
        }else{
          document.getElementById(receiver).value += ";"+ arr_receiver[i];
        }
    }
  }

}
function check_innerHTML(id,span,receiver){
  
  var val_receiver = document.getElementById(receiver).value;
  var title = document.getElementById(span);
  if (id.checked == true){
    if (val_receiver == ""){
      document.getElementById(receiver).value = title.innerHTML;
    }else{
  
      document.getElementById(receiver).value += ";" + title.innerHTML;
    }
  
  }else{
    
  ////convert to array
  var arr_receiver = val_receiver.split(';');
  ////get indexOf value in array    
  var index_receiver = arr_receiver.indexOf(title.innerHTML);
    if (index_receiver!=-1){
      arr_receiver.splice(index_receiver,1);
    }else{
      arr_receiver.splice(0,1);
    }
    ///Clear receiver 
    document.getElementById(receiver).value  = "";
    ///split array into string to use with comma (;)
    for (i=0;i < arr_receiver.length;i++){
        if (document.getElementById(receiver).value == ""){
          document.getElementById(receiver).value = arr_receiver[i];
        }else{
          document.getElementById(receiver).value += ";"+ arr_receiver[i];
        }
    }
   /////////////////////////////////////////////
    
  }

}
function remove_item(item,val,receiver){
  item.parentNode.removeChild(item);
  
  var val_receiver = document.getElementById(receiver).value;
  ////convert to array
  var arr_receiver = val_receiver.split(';');
  ////get indexOf value in array    
  
  var index_receiver = arr_receiver.indexOf(val);
  
    if (index_receiver!=-1){
      arr_receiver.splice(index_receiver,1);
    }else{
      arr_receiver.splice(0,1);
    }
  
    ///Clear receiver 
    document.getElementById(receiver).value  = "";
    ///split array into string to use with comma (;)
    for (i=0;i < arr_receiver.length;i++){
        if (document.getElementById(receiver).value == ""){
          document.getElementById(receiver).value = arr_receiver[i];
        }else{
          document.getElementById(receiver).value += ";"+ arr_receiver[i];
        }
    }
    
}

function menu_add(id,receiver,url,drop,htmlId,val_receiver,html_receiver){
var drop_active = document.getElementById(drop);
var val = document.getElementById(id).value;
if (drop_active.checked == true){
  ////Add item to the dropdown menu pre created
  var val_title = document.getElementById(htmlId).value;
  if (document.getElementById(val_receiver).value == ""){
      document.getElementById(val_receiver).value = val;
  }else{
    document.getElementById(val_receiver).value += ";"+val;
  }
  
  var arr_title = val_title.split(";");
  var arr_val = val.split(";");
  for(i=0;i<arr_title.length;i++){
    document.getElementById(html_receiver).innerHTML += '<li onclick="remove_item(this,'+"'"+arr_val[i]+"','"+val_receiver+"'"+')"><i  class="fa fa-times" aria-hidden="true"></i>'+arr_title[i]+'</li>';
  }
}else{
    
    var xhttp;
        xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
              
                document.getElementById(receiver).innerHTML =  xhttp.responseText;
            }
          };
      xhttp.open("GET", url+"?m="+val, true);
      xhttp.send();
}
    
}
function box_check(id){
  var el = document.getElementById(id);
  
  if(el.checked == true){
    el.checked = false;
  }else{
    el.checked = true;
  }
}
function allowDrop(ev){
  ev.preventDefault();
}

function drag(ev,OrgInnerHtml,HtmlId){
  ev.dataTransfer.effectAllowed = 'move';
  ev.dataTransfer.setData("text/html",ev.target.id);
  sessionStorage.setItem(HtmlId,OrgInnerHtml);
}
function drop(ev){
  ev.preventDefault();
  var data = ev.dataTransfer.getData("text/html");
  var innerSrc = sessionStorage.getItem(data);
   
  var el = ev.target;
  if (el.id != 'sidebar_item' && el.id != 'sidebar_left' && el.id != 'sidebar_right'){
    el = el.parentNode;
  }
  var title = ''+ innerSrc+'<i class="fa fa-sort-desc right fa-lg" aria-hidden="true"></i>'; 
  var elInput = '<ul style="display:none;"><li><a href="#">Item 1A</a></li><li><a href="#">Item 1B</a></li></ul>';
  document.getElementById(data).innerHTML = title + elInput; 
  el.appendChild(document.getElementById(data));
}

/*
   var title = '<a>'+document.getElementById(data).innerHTML+'</a>';
    var elInput = '<li><a href="#">Item 1A</a></li><li><a href="#">Item 1B</a></li>';  
    document.getElementById(data).getElementsByTagName("ul")[0].innerHTML = elInput;
  */