function reset_count()
{
	localStorage.clickcount = 0;
}
function add_class(receiver,int)
{
	var num_class = document.getElementById(int).value;
	var row_class = document.getElementById("row_class").value;
	if (localStorage.clickcount) {
            localStorage.clickcount = Number(localStorage.clickcount)+1;
        }else{
			localStorage.clickcount = 0;
		}
	///level////////////
	var inp_lvl = document.createElement("input");
	inp_lvl.type = "text";inp_lvl.placeholder="Level: from 1 to 12...etc.";inp_lvl.name="lvl"+localStorage.clickcount;
	inp_lvl.required;
	var lb = document.createElement("label");
	lb.innerHTML ="Level *";
	lb.appendChild(inp_lvl);
	var dv_lvl = document.createElement("div");
	dv_lvl.className = "small-12 medium-4 large-4 columns";
	dv_lvl.appendChild(lb); 
	////fee//////	
	var inp_fee = document.createElement("input");
	inp_fee.type = "text";inp_fee.placeholder="Fee";inp_fee.name="fee"+localStorage.clickcount;
	inp_fee.required;
	lb = document.createElement("label");
	lb.innerHTML ="Fee *";
	lb.appendChild(inp_fee);
	var dv_fee = document.createElement("div");
	dv_fee.className = "small-12 medium-4 large-4 columns";
	dv_fee.appendChild(lb);
		 
    ////discount/////    
    var inp_dis = document.createElement("input");
	inp_dis.type = "text";inp_dis.placeholder="Discount";inp_dis.name="dis"+localStorage.clickcount;
	
	lb = document.createElement("label");
	lb.innerHTML ="Discount (%)";
	lb.appendChild(inp_dis);
	var dv_dis = document.createElement("div");
	dv_dis.className = "small-12 medium-4 large-4 columns";
	dv_dis.appendChild(lb);
		 
    var dvr = document.createElement("div");        
	dvr.className = "row collapse"
	dvr.appendChild(dv_lvl);
	dvr.appendChild(dv_fee);
    dvr.appendChild(dv_dis);
	////div for class1//////
	for (var i=1;i<=num_class;i++){
	
	var inp = document.createElement("input");
	inp.type = "text";inp.placeholder="Class Name:1A,1B,..etc.";inp.name="class"+localStorage.clickcount+"_"+i;
	inp.required;
	lb = document.createElement("label");
	lb.innerHTML ="Class Name *";
	lb.appendChild(inp);
	var dv_class = document.createElement("div");
	
		dv_class.className = "small-2 left columns";
	dv_class.appendChild(lb);
	dvr.appendChild(dv_class);
	if(row_class < i){
		document.getElementById("row_class").value = i;	
	}
	
	
	}
	document.getElementById(receiver).appendChild(dvr);
	
	document.getElementById('row_lvl').value = localStorage.getItem("clickcount");
}

function get1var(data_send,receiver,url){
	
	var fhttp;  
  fhttp = new XMLHttpRequest();
  fhttp.onreadystatechange = function() {
    if (fhttp.readyState == 4 && fhttp.status == 200) {
      
    document.getElementById(receiver).innerHTML = fhttp.responseText;
    }
  };
  
  fhttp.open("POST", url, true);
  fhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  fhttp.send(data_send);
}


function get2var(var1,var2,receiver,url){
	var val1 = document.getElementById(var1).value;
	var val2 = document.getElementById(var2).value;
	var fhttp;  
  fhttp = new XMLHttpRequest();
  fhttp.onreadystatechange = function() {
    if (fhttp.readyState == 4 && fhttp.status == 200) {
      
    document.getElementById(receiver).innerHTML = fhttp.responseText;
    }
  };
  
  fhttp.open("POST", url, true);
  fhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  fhttp.send('val1='+val1+'&val2='+val2);
}
function get3var(var1,var2,var3,receiver,url){
	var val1 = document.getElementById(var1).value;
	var val2 = document.getElementById(var2).value;
	var val3 = document.getElementById(var3).value;
	var fhttp;  
  fhttp = new XMLHttpRequest();
  fhttp.onreadystatechange = function() {
    if (fhttp.readyState == 4 && fhttp.status == 200) {
      
    document.getElementById(receiver).innerHTML = fhttp.responseText;
    }
  };
  
  fhttp.open("POST", url, true);
  fhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  fhttp.send('val1='+val1+'&val2='+val2+'&val3='+val3);
}