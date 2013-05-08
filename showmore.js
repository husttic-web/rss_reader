var xmlHttp;

function showHint(str)
{
if (str.length==0)
  { 
  document.getElementById("txtHint").innerHTML=" ";
  return;
  }
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request");
  return
  } 
var url="showmore.php";
url=url+"?q="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);

} 

function stateChanged() 
{ 

if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
    {
	
	xmlDoc=xmlHttp.responseXML;
	txt="<table border='1'>"+"<tr>";
	x=xmlDoc.getElementsByTagName("channel");
	b=xmlDoc.getElementsByTagName("title");
	c=xmlDoc.getElementsByTagName("link");	
	d=xmlDoc.getElementsByTagName("description");
	e=xmlDoc.getElementsByTagName("pubdate");
	 txt=txt +"<td>"+ x[0].childNodes[0].nodeValue+"</td>" ;
	 txt=txt +"<td>"+ b[0].childNodes[0].nodeValue+"</td>" ;
	 txt=txt +"<td>"+ c[0].childNodes[0].nodeValue+"</td>" ;
	 txt=txt +"<td>"+ d[0].childNodes[0].nodeValue+"</td>" ;
	 txt=txt +"<td>"+ e[0].childNodes[0].nodeValue+"</td>" ;
	 txt=txt+"</tr>"+"</table>";
    document.getElementById("a").innerHTML=txt;
 
 
  
 
      }
}

function GetXmlHttpObject()
{
var xmlHttp=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttp=new XMLHttpRequest();
 }
catch (e)
 {
 // Internet Explorer
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