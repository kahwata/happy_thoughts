function getThought(author){

		if(author==""){
			document.getElementById("celebQuotes").innerHtml="";
			return;
		}
	if (window.XMLHttpRequest) {
    // code for modern browsers
    xmlhttp = new XMLHttpRequest();
 } else {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}



	 xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("celebQuotes").innerHTML=xmlhttp.responseText;
    }
}
		xmlhttp.open("GET","../private/getThoughts.php?query="+author ,true);
		xmlhttp.send();
	
}
function changeTextColor(){
	document.getElementById("main_title").style.color = "#ff0000";
}
function changeFont(){
	document.getElementById("main_title").style.fontFamily = "Impact,Charcoal,sans-serif";
}
function reset(){
	document.getElementById("main_title").style.fontFamily = "Times New Roman,Times,serif";
	document.getElementById("main_title").style.color = "black";
}
function showResult(str) {
  if (str.length==0) { 
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","../../private/linksearch.php?q="+str,true);
  xmlhttp.send();
}

