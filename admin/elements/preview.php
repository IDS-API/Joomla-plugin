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
   $baseurl ="http://api.ids.ac.uk/openapi/".$server."/get_all/documents/full?num_results=10";
   $guid="&_token_guid=".$GUID;
   $before="&metadata_published_before=".$before;
   $after="&metadata_published_after=".$after;
   $year="&metadata_published_year=".$year;
   //server_name
   if (($formate !='default') &&($sort !='default')){$extra .='&'.$formate.'='.$sort;}
  	$api_url =$baseurl .$guid.  "&theme=".$countries. "&country=".$themes.$requesttype.$before.$after.$year.$extra;
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
		echo '<h3>GUID not valid</h3><p>In order to successfully use the API, users are required to sign up with a Unique ID. It is required that these tokens are sent with every request within the HTTP header. To register for an API key visit <a href="http://api.ids.ac.uk/accounts/register/" target="_blank">http://api.ids.ac.uk/accounts/register/</a></p>';
	}
?> 