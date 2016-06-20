//img_view is a function to view the picture when we just select from file. 
function img_view(input) {
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


