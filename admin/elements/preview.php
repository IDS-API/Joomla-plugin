<?php 
//******************************************************************************
//* $Id:: preview.php 142 2011-12-27 12:01:44Z subhendu                  $
//* $Revision:: 142                                                      $ 
//* $Author:: subhendu                                                   $
//* $LastChangedDate:: 2011-12-27 17:31:44 +0530 (Tue, 27 Dec 2011)      $
//******************************************************************************/
   $extra ="";
  	$countries=$_REQUEST["country"];
	if($countries !="")
	{
		$countries= explode(',',$countries);
		$countries=implode('|',$countries);
	}
	else 
	{
		$countries =="";
	}
	$GUID=$_REQUEST["GUID"];
	$themes=$_REQUEST["themes"];
	if($themes !="")
	{
		$themes= explode(',',$themes);
		$themes=implode('|',$themes);
	}
	else
	{
		$themes =="";
	}
   $before=$_REQUEST["before"];
   $before=$_REQUEST["before"];
   $server=$_REQUEST["server"];
   $after=$_REQUEST["after"];
   $year=$_REQUEST["year"];
   $sort=$_REQUEST["sort"];
   $formate =$_REQUEST["formate"];
   $requesttype="&_accept=application/xml";
   $baseurl ="http://api.ids.ac.uk/openapi/".$server."/search/documents/full?num_results=10";
   $guid="&_token_guid=".$GUID;

   if($before !="")
	{   $before="&metadata_published_before=".$before;  }
   else
   {   $before=="";   } 
   
   if($after !="")
	{   $after="&metadata_published_after=".$after;   }
   else
   {   $after=="";   } 
  
   if($year !="")
	{   $year="&metadata_published_year=".$year;   }
   else
   {   $year=="";   }
   
   if($themes !="")
	{   $themes="&theme=".$themes;   }
   else
   {   $themes=="";   }
   
   if($countries !="")
	{   $countries="&country=".$countries;   }
   else
   {   $countries=="";   }
   
   //server_name
   if (($formate !='default') &&($sort !='default')){$extra .='&'.$formate.'='.$sort;}
  	$api_url =$baseurl .$guid. $themes.$countries.$requesttype.$before.$after.$year.$extra;
   $xml = @simplexml_load_file($api_url);
	if($xml)
	{
		$content_elements = $xml->xpath('/root/results/list-item');
		if($content_elements)
		{ 
			echo"<div style='overflow:scroll; width:580px; height:580px;'> ";
			foreach ($content_elements as $list_item)
			{
				$title = $list_item->title;
				$long_abstract= $list_item->description;
				echo "<span style='font-family: verdana; font-size: 12px;font-weight:bold;'> ".$title."</span><br/>";
				echo "<span style='font-family: verdana; font-size: 12px;'> ".$long_abstract."</span> ";
				echo "<br/><hr style='width:90%;'/>";
			}
			echo "</div>";
		}
	}
	else
	{
		echo '<h3>IDS API Token-GUID or key not valid</h3><p>In order to successfully use this plugin, users are required to sign up for a unique Token-GUID or key. To register for an API key visit <a href="http://api.ids.ac.uk/accounts/register/" target="_blank">http://api.ids.ac.uk/accounts/register/</a>. Once obtained, enter this key into the <em>API Token-GUID or key</em> section of the plugin parameters.</p>';		
	}
?> 