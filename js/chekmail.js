var xmlHttp 

function showMail(str) 
{ 
if (str.length<=3) 
{
document.getElementById("txtMail").innerHTML="<img src='imgs/error.png'/>" 
return 
} 
xmlHttp=GetXmlHttpObject() 
if (xmlHttp==null) 
{ 
alert ("Browser does not support HTTP Request") 
return 
} 
var url="inc/getmail.php" 
url=url+"?w="+str 
url=url+"&sid="+Math.random() 
xmlHttp.onreadystatechange=stateChangeds 
xmlHttp.open("GET",url,true) 
xmlHttp.send(null) 
} 

function stateChangeds() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete") 
{ 
document.getElementById("txtMail").innerHTML=xmlHttp.responseText 
} 
} 

function GetXmlHttpObject() 
{ 
var xmlHttp=null; 
try 
{ 
xmlHttp=new XMLHttpRequest(); 
} 
catch (e) 
{ 
try 
{ 
xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); 
} 
catch (e) 
{ 
xmlHttp=new ActiveXObject("Microsoft.XMLHTTP"); 
} 
} 
return xmlHttp; 
} 