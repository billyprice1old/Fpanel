



function readURL(input) {
if (input.files && input.files[0]) {
var reader = new FileReader();
reader.onload = function (e) {
$('#img_prev')
.attr('src', e.target.result)
.width(120)
.height(180);
};

reader.readAsDataURL(input.files[0]);
}
}

function result_by_name(str,type)
{
    document.getElementById("old_item_editor").innerHTML = "";
    document.getElementById("status").innerHTML = "";
    
    var xhttp; 
  if (str == "") {
    document.getElementById("result_table").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
    document.getElementById("result_table").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", "book_result.php?name="+str+"&type="+type, true);
  xhttp.send();
} 

function search_name(str)
{
    
    
    var xhttp; 
  if (str == "") {
    document.getElementById("list_show").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
    document.getElementById("list_show").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", "student_search_result.php?name="+str, true);
  xhttp.send();
}

function result_by_code(str)
{
    document.getElementById("old_item_editor").innerHTML = "";
    document.getElementById("status").innerHTML = "";
    var xhttp; 
    var code = document.getElementById(str).value;
  if (str == "") {
    document.getElementById("result_table").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
    document.getElementById("result_table").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", "book_result.php?code="+code, true);
  xhttp.send();
}

function search_by_code(str)
{
 
    var xhttp; 
    var code = document.getElementById(str).value;
  if (str == "") {
    document.getElementById("list_show").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
    document.getElementById("list_show").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", "student_search_result.php?code="+code, true);
  xhttp.send();
}

function view_editor(val,type)
{
    //str id of element and type is use to know if it is by name or by code
    document.getElementById("status").innerHTML = "";
  var xhttp; 
  
  if (val == "") {
    document.getElementById("old_item_editor").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
    document.getElementById("old_item_editor").innerHTML = xhttp.responseText;
    }
  };
  if (type == "name")
  {
  xhttp.open("GET", "book_old_item.php?name="+val, true);    
  }else if (type == "code"){
  xhttp.open("GET", "book_old_item.php?code="+val, true);
  }else if (type == "out"){
    xhttp.open("GET", "book_out.php?name="+val, true);  
  }
  
  xhttp.send();
}



function sum_qty(old,add)
{
    var old_qty = document.getElementById(old).value;
    document.getElementById('total_qty').value = Number(old_qty) + Number(add);  
}

function add_old_item(name,qty,old_qty,uid)
{
    //str id of element and type is use to know if it is by name or by code
    
  var xhttp; 
  var val_name = document.getElementById(name).value; 
  var val_total =  document.getElementById(qty).value;
  var val_old =  document.getElementById(old_qty).value;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
    document.getElementById("status").innerHTML = xhttp.responseText;
    }
  };
  
  xhttp.open("GET", "book_add_old_item.php?name="+val_name+"&total="+val_total+"&old="+val_old+"&uid="+uid, true);
  
  
  xhttp.send();
  document.getElementById("old_item_editor").innerHTML = "";
}

function show_new_item()
{
    document.getElementById("new_item").style.display = "block";
    document.getElementById("old_item").style.display = "none";
}
function show_old_item()
{
    document.getElementById("new_item").style.display = "none";
    document.getElementById("old_item").style.display = "block";
}

function get_setting(str)
{
  
    var xhttp; 
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
    document.getElementById("right-panel-data").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", "overall_info.php?p="+str, true);
  xhttp.send();
}

function term_update(id)
{
  var term = document.getElementById("term_name"+id).value;
  var st_date = document.getElementById("start_date"+id).value;
  var end_date = document.getElementById("end_date"+id).value;
  var xhttp; 
  
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
    document.getElementById("status").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", "general_schedule_update.php?id="+id+"&term="+term+"&st_date="+st_date+"&end_date="+end_date, true);
  xhttp.send();
}

function read_holiday(id)
{
  var xhttp; 
  if (id == "")
  {
    document.getElementById("date_event").value ="";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
    document.getElementById("date_event").value = xhttp.responseText;
    }
  };
  xhttp.open("GET", "general_read_holidays.php?id="+id, true);
  xhttp.send();
}

function update_holiday()
{
 var id = document.getElementById("holiday_event").value;
 var date = document.getElementById("date_event").value;
  var xhttp; 
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
    document.getElementById("status_holiday").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", "general_update_holidays.php?id="+id+"&date_holiday="+date, true);
  xhttp.send();
}
function add_holiday()
{
 var date = document.getElementById("date_new_event").value;
 var holiday = document.getElementById("holiday").value;
 
  var xhttp; 
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
    document.getElementById("status_holiday").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("POST", "general_add_holidays.php", true);
  xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xhttp.send("date_holiday="+date+"&holiday="+holiday);
}

function update_name_gallery(old_title,id)
{
 
 var new_title = document.getElementById(id).value;
 
  var xhttp; 
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
    alert (xhttp.responseText);
    }
  };
  xhttp.open("POST", "gallery_update_name.php", true);
  xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xhttp.send("old_title="+old_title+"&new_title="+new_title);
}

function gallery_change_view(view)
{ 
  
  var xhttp; 
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
    document.getElementById('img_view').innerHTML = xhttp.responseText;
    
    }
  };
  xhttp.open("POST", "gallery_change_view.php", true);
  xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xhttp.send("view="+view);
  
}
function select_del(id,str)
{
  var stri = document.getElementById(id).value;
  if (str.checked == true)
    {
     if (document.getElementById(id).value == "")
      {
        document.getElementById(id).value = str.value;  
      }else{
        document.getElementById(id).value += ";" + str.value;
      } 
    }
    else
    {
      if (stri.indexOf(";"+str.value) != -1)
      {
      var res = stri.replace(";"+str.value,"");  
      }else
      {
        res = stri.replace(str.value,"");
      }
      
      
      document.getElementById(id).value = res;
      
    }
   
  
}

function get_program_detail(course)
{ 
  
  var xhttp; 
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
    document.getElementById('term').innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("POST", "program_read_term.php", true);
  xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xhttp.send("course="+course);
  //////////////////////////////////////////////////////////////////////////
  var yhttp; 
  yhttp = new XMLHttpRequest();
  yhttp.onreadystatechange = function() {
    if (yhttp.readyState == 4 && yhttp.status == 200) {
    document.getElementById('time_type').innerHTML = yhttp.responseText;
    }
  };
  yhttp.open("POST", "program_read_time_type.php", true);
  yhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  yhttp.send("course="+course);
  /////////////////////////////////////////////////////////////////////////
  var lhttp;  
  lhttp = new XMLHttpRequest();
  lhttp.onreadystatechange = function() {
    if (lhttp.readyState == 4 && lhttp.status == 200) {
    document.getElementById('level').innerHTML = lhttp.responseText;
    }
  };
  lhttp.open("POST", "program_read_level.php", true);
  lhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  lhttp.send("course="+course);
  /////////////////////////////////////////////
  var tshttp;  
  tshttp = new XMLHttpRequest();
  tshttp.onreadystatechange = function() {
    if (tshttp.readyState == 4 && tshttp.status == 200) {
    document.getElementById('time_study').innerHTML = tshttp.responseText;
    }
  };
  tshttp.open("POST", "program_read_time_study.php", true);
  tshttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  tshttp.send("course="+course);
  /////////////////////////////////////////
  var rhttp;  
  rhttp = new XMLHttpRequest();
  rhttp.onreadystatechange = function() {
    if (rhttp.readyState == 4 && rhttp.status == 200) {
    document.getElementById('room').innerHTML = rhttp.responseText;
    }
  };
  rhttp.open("POST", "program_read_room.php", true);
  rhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  rhttp.send("course="+course);
  ///////////////////////////////////////////////////
  var fhttp;  
  fhttp = new XMLHttpRequest();
  fhttp.onreadystatechange = function() {
    if (fhttp.readyState == 4 && fhttp.status == 200) {
    document.getElementById('fee').innerHTML = fhttp.responseText;
    }
  };
  fhttp.open("POST", "program_read_fee.php", true);
  fhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  fhttp.send("course="+course);
}
function show_items(id)
{
  document.getElementById(id).style.display = "block";
}
function hide_items(id)
{
  document.getElementById(id).style.display = "none";
}
function clear_status(id)
{
  document.getElementById(id).innerHTML ="";
}
function clear_input(id)
{
  document.getElementById(id).value ="";
}

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

function print_program(el,title)
{
	var restorepage = document.body.innerHTML;
  var printcontent;
  
    var Table_list = document.getElementById(el).getElementsByTagName("table")[0];
	
      for (var i=0; i< Table_list.rows.length;i++)
      {
        
        Table_list.rows[i].deleteCell(11);  
      }
        
  
    printcontent = '<h3 style="text-align:center;">'+title+'</h3>'+ document.getElementById(el).innerHTML;
  
    
  
	
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
  
}

function show_student_list(cr,tm,tt,lv,ts,rm)
{ 
  document.getElementById("student_list").style.display = "block";
  document.getElementById("table_old").style.display = "none";
  var xhttp; 
  
  var course = document.getElementById(cr).value;
  var term = document.getElementById(tm).value;
  var time_type = document.getElementById(tt).value;
  var level = document.getElementById(lv).value;
  var time_study = document.getElementById(ts).value;
  var room = document.getElementById(rm).value;
  if (level !=""){var tlevel = " Level " + level;}else{tlevel="";}
  if (room !=""){var troom = " Room " + room;}else{troom="";}
  document.getElementById("list_title").innerHTML = "List of " + course +tlevel+troom;
  document.getElementById("list_title_print").innerHTML = "List of " + course +tlevel+troom;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
    document.getElementById('list_show').innerHTML = xhttp.responseText;
    
    }
  };
  xhttp.open("POST", "student_show_list.php", true);
  xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xhttp.send("course="+course+"&term="+term+"&time_type="+time_type+"&level="+level+"&time_study="+time_study+"&room="+room);
  //////////////////////
  var yhttp;
  yhttp = new XMLHttpRequest();
  yhttp.onreadystatechange = function() {
    if (yhttp.readyState == 4 && yhttp.status == 200) {
    document.getElementById('list_print').innerHTML = yhttp.responseText;
    }
  };
  yhttp.open("POST", "student_show_list_print.php", true);
  yhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  yhttp.send("course="+course+"&term="+term+"&time_type="+time_type+"&level="+level+"&time_study="+time_study+"&room="+room);
}
function show_all_student()
{ 
  document.getElementById("list_title").innerHTML = "All Students List";
  document.getElementById("list_title_print").innerHTML = "All Students List";
  document.getElementById("student_list").style.display = "block";
  document.getElementById("table_old").style.display = "none";
  var xhttp; 
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
    document.getElementById('list_show').innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("POST", "student_show_list.php", true);
  xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xhttp.send("All=all");
  
  //////////////////////
  var yhttp;
  yhttp = new XMLHttpRequest();
  yhttp.onreadystatechange = function() {
    if (yhttp.readyState == 4 && yhttp.status == 200) {
    document.getElementById('list_print').innerHTML = yhttp.responseText;
    }
  };
  yhttp.open("POST", "student_show_list_print.php", true);
  yhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  yhttp.send("All=all");
  
}
function show_old_db_student()
{ 
  
  document.getElementById("title_old").innerHTML = "List Student old database for correct";
  document.getElementById("table_print").style.display = "none";
  document.getElementById("student_list").style.display = "none";
  document.getElementById("table_old").style.display = "block";
  var xhttp; 
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
    document.getElementById('list_old_show').innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("POST", "student_old_db.php", true);
  xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xhttp.send();
  

  
}
function update_old_db_student(sid,lname,fname,sex,dob,address,phone,email)
{ 
  
  var last_name = document.getElementById(lname).value;
  var firs_name = document.getElementById(fname).value;
  var sexe = document.getElementById(sex).value;
  var ddob = document.getElementById(dob).value;
  var add = document.getElementById(address).value;
  var ph = document.getElementById(phone).value;
  var ema = document.getElementById(email).value;
  
  var xhttp; 
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
    alert( xhttp.responseText);
    }
  };
  xhttp.open("POST", "student_update_old_db.php", true);
  xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xhttp.send("lname="+last_name+"&fname="+firs_name+"&sex="+sexe+"&dob="+ddob+"&addr="+add
  +"&phone="+ph+"&email="+ema+"&sid="+sid);
  

  
}

function show_course_infor(st,date)
{ 
  
  //document.getElementById("print_receipt").style.display = "inline";
  
  var fhttp;  
  if (st == "")
  {
    document.getElementById('course_infor').innerHTML = "";
  }
  fhttp = new XMLHttpRequest();
  fhttp.onreadystatechange = function() {
    if (fhttp.readyState == 4 && fhttp.status == 200) {
    document.getElementById('course_infor').innerHTML = fhttp.responseText;
    }
  };
  
  fhttp.open("POST", "student_registration_infor.php", true);
  fhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  fhttp.send("sid="+st+"&date="+date); 
}

function search_book_store(st)
{
  
  var fhttp;  
  if (st == "")
  {
    document.getElementById('result').innerHTML = "";
  }
  fhttp = new XMLHttpRequest();
  fhttp.onreadystatechange = function() {
    if (fhttp.readyState == 4 && fhttp.status == 200) {
    document.getElementById('result').innerHTML = fhttp.responseText;
    }
  };
  fhttp.open("POST", "book_search_store.php", true);
  fhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  fhttp.send("name="+st);
}
function add2cart(st,id)
{
  
  var fhttp;  
  var uid = document.getElementById(st).value;
  var qty = document.getElementById(id).value;
  fhttp = new XMLHttpRequest();
  fhttp.onreadystatechange = function() {
    if (fhttp.readyState == 4 && fhttp.status == 200) {
    document.getElementById('cart').innerHTML = fhttp.responseText;
    }
  };
  fhttp.open("POST", "book_add2cart.php", true);
  fhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  fhttp.send("uid="+uid+"&qty="+qty);
}
function del_cart(st)
{
  
  var fhttp;  
  
  
  fhttp = new XMLHttpRequest();
  fhttp.onreadystatechange = function() {
    if (fhttp.readyState == 4 && fhttp.status == 200) {
    document.getElementById('cart').innerHTML = fhttp.responseText;
    }
  };
  fhttp.open("POST", "book_del_cart.php", true);
  fhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  fhttp.send("uid="+st);
}

function add_name(str,id,uid)
{
  document.getElementById(id).value = str;
  document.getElementById('uid').value = uid;
}

function show_report_reg(col,st)
{
  
  var fhttp;  
  var val = document.getElementById(st).value;
  
  fhttp = new XMLHttpRequest();
  fhttp.onreadystatechange = function() {
    if (fhttp.readyState == 4 && fhttp.status == 200) {
    document.getElementById('show_report').innerHTML = fhttp.responseText;
    }
  };
  fhttp.open("POST", "report_registration_show.php", true);
  fhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  fhttp.send("col="+col+"&val="+val);
}

function show_report_store(col,st)
{
  
  var fhttp;  
  var val = document.getElementById(st).value;
  
  fhttp = new XMLHttpRequest();
  fhttp.onreadystatechange = function() {
    if (fhttp.readyState == 4 && fhttp.status == 200) {
    document.getElementById('show_report').innerHTML = fhttp.responseText;
    }
  };
  fhttp.open("POST", "report_book_store_show.php", true);
  fhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  fhttp.send("col="+col+"&val="+val);
}

function show_report_class(st,types)
{
  
  var fhttp;  
  var val = document.getElementById(st).value;
  
  fhttp = new XMLHttpRequest();
  fhttp.onreadystatechange = function() {
    if (fhttp.readyState == 4 && fhttp.status == 200) {
    document.getElementById('show_report').innerHTML = fhttp.responseText;
    }
  };
  fhttp.open("POST", "report_class_show.php", true);
  fhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  fhttp.send("term="+val+"&types="+types);
}

function show_month(st)
{
  
  var fhttp;  
  
  
  fhttp = new XMLHttpRequest();
  fhttp.onreadystatechange = function() {
    if (fhttp.readyState == 4 && fhttp.status == 200) {
    document.getElementById('months').innerHTML = fhttp.responseText;
    }
  };
  fhttp.open("POST", "report_show_month.php", true);
  fhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  fhttp.send("year="+st);
}
function show_month_static(st)
{
  
  var fhttp;  
  fhttp = new XMLHttpRequest();
  fhttp.onreadystatechange = function() {
    if (fhttp.readyState == 4 && fhttp.status == 200) {
    document.getElementById('months').innerHTML = fhttp.responseText;
    }
  };
  fhttp.open("POST", "static_show_month.php", true);
  fhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  fhttp.send("year="+st);
}

function show_income_report(d,m,y,s)
{
  
  var fhttp;  
  var S = document.getElementById(s).value;  
  var D = document.getElementById(d).value;
  var M = document.getElementById(m).value;
  var Y = document.getElementById(y).value
  
  fhttp = new XMLHttpRequest();
  fhttp.onreadystatechange = function() {
    if (fhttp.readyState == 4 && fhttp.status == 200) {
    document.getElementById('show_report').innerHTML = fhttp.responseText;
    }
  };
  fhttp.open("POST", "report_income_show.php", true);
  fhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  fhttp.send("month="+M+"&year="+Y+"&day="+D+"&source="+S);
}

function show_static(d,m,y)
{
  
  var fhttp;  
  
  var D = document.getElementById(d).value;
  var M = document.getElementById(m).value;
  var Y = document.getElementById(y).value
  
  fhttp = new XMLHttpRequest();
  fhttp.onreadystatechange = function() {
    if (fhttp.readyState == 4 && fhttp.status == 200) {
    document.getElementById('show_report').innerHTML = fhttp.responseText;
    }
  };
  fhttp.open("POST", "static_reg_show.php", true);
  fhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  fhttp.send("month="+M+"&year="+Y+"&day="+D);
}
function show_day(st,yea)
{
  
  var fhttp;  
  
  var val = document.getElementById(yea).value;
  
  fhttp = new XMLHttpRequest();
  fhttp.onreadystatechange = function() {
    if (fhttp.readyState == 4 && fhttp.status == 200) {
    document.getElementById('days').innerHTML = fhttp.responseText;
    }
  };
  fhttp.open("POST", "report_show_day.php", true);
  fhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  fhttp.send("month="+st+"&year="+val);
}
function show_day_static(st,yea)
{
  
  var fhttp;  
  
  var val = document.getElementById(yea).value;
  
  fhttp = new XMLHttpRequest();
  fhttp.onreadystatechange = function() {
    if (fhttp.readyState == 4 && fhttp.status == 200) {
    document.getElementById('days').innerHTML = fhttp.responseText;
    }
  };
  fhttp.open("POST", "static_show_day.php", true);
  fhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  fhttp.send("month="+st+"&year="+val);
}


function show_city_detail(st)
{
  var fhttp;  
  fhttp = new XMLHttpRequest();
  fhttp.onreadystatechange = function() {
    if (fhttp.readyState == 4 && fhttp.status == 200) {
      
    document.getElementById('show_city').innerHTML = fhttp.responseText;
    }
  };
  fhttp.open("POST", "city_detail.php", true);
  fhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  fhttp.send("st="+st);
}
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
function move_page(url)
{
  
  var fhttp;  
  fhttp = new XMLHttpRequest();
  fhttp.onreadystatechange = function() {
    if (fhttp.readyState == 4 && fhttp.status == 200) {
      
    document.getElementById('list_old_show').innerHTML = fhttp.responseText;
    }
  };
  fhttp.open("POST", url, true);
  fhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  fhttp.send();
}
