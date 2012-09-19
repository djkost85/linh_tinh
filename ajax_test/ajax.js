// JavaScript Document
function obj(){
	td = navigator.appName;
	if(td == "Microsoft Internet Explorer"){
		dd = new ActiveXObject("Microsoft.XMLHTTP");	
	}else{
		dd = new XMLHttpRequest();	
	}
	return dd;
}

http = obj();

function loadXMLDoc(id,p){
	document.getElementById("ketqua").innerHTML = "Đang xử lý...";
	url = "process.php?id="+id+"&page="+p;
	http.open("get",url,true);
	http.onreadystatechange=process;
	http.send(null);	
}

function process(){
	if(http.readyState == 4 && http.status == 200){
		document.getElementById("ketqua").innerHTML = http.responseText;	
	}
}