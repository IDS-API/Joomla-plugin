var jform_params_eldis_server
var paramseldis_sync_date;
var paramseldis_guid;
var jform_params_eldis_data_format;
var jform_params_mycategory;
var jform_params_eldis_sort_value;
var paramseldis_sort_formatsort_desc;
var paramseldis_sort_formatsort_asc;
var paramseldis_sort_formatdefault;
var jform_params_eldis_article_keyword;
var jform_params_eldis_article_publisher;
var jform_params_eldis_article_author;
var paramseldis_skip_days;
var jform_params_eldis_pub_year;
var jform_params_eldis_pub_before;
var jform_params_eldis_pub_after;
var jform_params_eldis_records;
var jform_params_eldis_obj_type;
var jform_params_eldis_article_country;
var jform_params_eldis_article_country_list;
var jform_params_eldis_article_theme_list;
var isValidGuid;
var server;
function checkURL(GUID)
{
   	var xmlhttp;
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			var res=xmlhttp.responseText;
			if(res)
			{
				getCountry(GUID);
				getThemes(GUID);
				jform_params_eldis_server.disabled=false;
				jform_params_eldis_data_format.disabled=false;
				jform_params_eldis_sort_value.disabled=false;
				jform_params_eldis_obj_type.disabled=false;
				jform_params_eldis_article_keyword.disabled=false;
				jform_params_eldis_article_publisher.disabled=false;
				jform_params_eldis_article_author.disabled=false;
				jform_params_eldis_pub_before.disabled=false;
				jform_params_eldis_pub_after.disabled=false;
				jform_params_eldis_records.disabled=false;
				jform_params_eldis_pub_year.disabled=false;
				objt=document.getElementById('jform_params_eldis_article_theme_list');
				objt.disabled=false;				
				jform_params_eldis_article_country.disabled=false;
				objc=document.getElementById('jform_params_eldis_article_country_list');
				objc.disabled=false;
				jform_params_mycategory.disabled=false;				
			}
			else 
			{  
				jform_params_eldis_server.disabled=true;
				jform_params_eldis_data_format.disabled=true;
				jform_params_eldis_sort_value.disabled=true;
				jform_params_eldis_obj_type.disabled=true;
			    jform_params_eldis_article_keyword.disabled=true;
				jform_params_eldis_article_publisher.disabled=true;
				jform_params_eldis_article_author.disabled=true;
				jform_params_eldis_pub_before.disabled=true;
				jform_params_eldis_pub_after.disabled=true;
				jform_params_eldis_records.disabled=true;
				jform_params_eldis_pub_year.disabled=true;
				objt=document.getElementById('jform_params_eldis_article_theme_list');
				objt.disabled=true;						
				jform_params_eldis_article_country.disabled=true;
				objc=document.getElementById('jform_params_eldis_article_country_list');
				objc.disabled=true;				
				jform_params_mycategory.disabled=true;
			}
		}
	}
	xmlhttp.open("GET","./components/com_eldisapi/elements/validate.php?type="+GUID,true);
	xmlhttp.send();
}

function validateGUID()
{

	server = document.getElementById("jform_params_eldis_server");
	jform_params_eldis_data_format= document.getElementById("jform_params_eldis_data_format");
	jform_params_eldis_sort_value= document.getElementById("jform_params_eldis_sort_value");
	jform_params_eldis_obj_type= document.getElementById("jform_params_eldis_sort_value");
	jform_params_eldis_article_keyword= document.getElementById("jform_params_eldis_article_keyword");
	jform_params_eldis_article_publisher= document.getElementById("jform_params_eldis_article_publisher");
	jform_params_eldis_article_author= document.getElementById("jform_params_eldis_article_author");
	jform_params_eldis_pub_before= document.getElementById("jform_params_eldis_pub_before");
	jform_params_eldis_pub_after= document.getElementById("jform_params_eldis_pub_after");
	jform_params_eldis_records= document.getElementById("jform_params_eldis_records");
	jform_params_eldis_article_country= document.getElementById("jform_params_eldis_article_country");
	jform_params_eldis_obj_type= document.getElementById("jform_params_eldis_obj_type");
	jform_params_mycategory= document.getElementById("jform_params_mycategory");
	jform_params_eldis_article_country_list= document.getElementById("jform_params_eldis_article_country_list");
	jform_params_eldis_article_theme_list= document.getElementById("jform_params_eldis_article_theme_list");
	jform_params_eldis_pub_year= document.getElementById("jform_params_eldis_pub_year");
	guid = document.getElementById("jform_params_eldis_guid");
	checkURL(guid.value)
}

function showPreview()
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			var resp=xmlhttp.responseText;
			document.getElementById("plugin-pane").innerHTML=resp;
		}
	}	
	xmlhttp.open("GET","./components/com_eldisapi/elements/preview.php",true);
	xmlhttp.send();
}

function getCountry(GUID)
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			var resp=xmlhttp.responseText;
			object=document.getElementById('jform_params_eldis_article_country_list');
			if(object!=null){
			object.innerHTML=resp;
			object.outerHTML=object.outerHTML;
			} 
		}
	}	
	   if(paramseldis_data_serverEldis.checked==true)
		   {
			  server=paramseldis_data_serverEldis.value;
		   }
			if(paramseldis_data_serverBridge.checked==true)
		   {
			  server=paramseldis_data_serverBridge.value;
		   }
		xmlhttp.open("GET","./components/com_eldisapi/elements/loadcountry.php?type="+GUID+"&server="+server,true);
	xmlhttp.send();	
}

function getThemes(GUID)
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}

	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			var resp=xmlhttp.responseText;
			object=document.getElementById('jform_params_eldis_article_theme_list');
			if(object!=null){
			object.innerHTML=resp;
			object.outerHTML=object.outerHTML;
			} 
		}
	}	
	
	 if(paramseldis_data_serverEldis.checked==true)
		   {
			  server=paramseldis_data_serverEldis.value;
		   }
			if(paramseldis_data_serverBridge.checked==true)
		   {
			  server=paramseldis_data_serverBridge.value;
		   }
		   
	xmlhttp.open("GET","./components/com_eldisapi/elements/loadthemes.php?type="+GUID+"&server="+server,true);
	xmlhttp.send();
		
}
function init()
{
	jform_params_eldis_pub_year= document.getElementById("jform_params_eldis_pub_year");
    jform_params_eldis_server = document.getElementById("jform_params_eldis_server");
	jform_params_eldis_data_format= document.getElementById("jform_params_eldis_data_format");
	jform_params_eldis_sort_value= document.getElementById("jform_params_eldis_sort_value");
	jform_params_eldis_obj_type= document.getElementById("jform_params_eldis_sort_value");
	jform_params_eldis_article_keyword= document.getElementById("jform_params_eldis_article_keyword");
	jform_params_eldis_article_publisher= document.getElementById("jform_params_eldis_article_publisher");
	jform_params_eldis_article_author= document.getElementById("jform_params_eldis_article_author");
	jform_params_eldis_pub_before= document.getElementById("jform_params_eldis_pub_before");
	jform_params_eldis_pub_after= document.getElementById("jform_params_eldis_pub_after");
	jform_params_eldis_records= document.getElementById("jform_params_eldis_records");
	jform_params_eldis_article_country= document.getElementById("jform_params_eldis_article_country");
	jform_params_eldis_obj_type= document.getElementById("jform_params_eldis_obj_type");
	jform_params_mycategory= document.getElementById("jform_params_mycategory");
	jform_params_eldis_article_country_list= document.getElementById("jform_params_eldis_article_country_list");
	jform_params_eldis_article_theme_list= document.getElementById("jform_params_eldis_article_theme_list");
	guid = document.getElementById("jform_params_eldis_guid");
	paramseldis_data_serverEldis=document.getElementById("jform_params_eldis_data_server0");
	paramseldis_data_serverBridge=document.getElementById("jform_params_eldis_data_server1");
	checkURL(guid.value);
}
function popitup(url) 
		{
		var formate;
		countries=document.getElementById("jform_params_eldis_article_country_list").value;
		themes=document.getElementById("jform_params_eldis_article_theme_list").value;
		num_records=document.getElementById("jform_params_eldis_records").value;
		guid = document.getElementById("jform_params_eldis_guid").value;
		sort=  document.getElementById("jform_params_eldis_sort_value").value;
		before= document.getElementById("jform_params_eldis_pub_before").value;
		after= document.getElementById("jform_params_eldis_pub_after").value;
		paramseldis_sort_formatsort_desc= document.getElementById("jform_params_eldis_sort_format2");
		paramseldis_sort_formatsort_asc= document.getElementById("jform_params_eldis_sort_format1");
		paramseldis_sort_formatdefault= document.getElementById("jform_params_eldis_sort_format0");
		year= document.getElementById("jform_params_eldis_pub_year").value;
		
		if(paramseldis_data_serverEldis.checked==true)
		{
		server=paramseldis_data_serverEldis.value;
		}
		if(paramseldis_data_serverBridge.checked==true)
		{
		server=paramseldis_data_serverBridge.value;
		}
		if(paramseldis_sort_formatsort_desc.checked==true)
		{
			formate=paramseldis_sort_formatsort_desc.value;
		}
		else if(paramseldis_sort_formatsort_asc.checked==true)
		{
			formate= paramseldis_sort_formatsort_asc.value;
		}
		else
		{
			formate= "default";
		}
		newwindow=window.open("./components/com_eldisapi/elements/"+url+'&country='+countries+'&themes='+themes+"&num="+num_records+"&GUID="+guid +"&before="+before+"&after="+ after+"&year="+year +"&sort="+sort+"&formate="+formate+"&server="+server ,null,'height=600px,width=600px');
		if (window.focus) {newwindow.focus();}
	    return false;
	
}
window.onload = init;
function createFromMultiSelection(src, dest)
{	
	themes=document.getElementById(src).value;
	if(document.getElementById(dest).value=="")
	{
		document.getElementById(dest).value= themes ;
	}
	else
	{
		document.getElementById(dest).value= document.getElementById(dest).value +","+themes;
	}	
}