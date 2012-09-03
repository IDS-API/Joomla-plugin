<?php 
//******************************************************************************
//* $Id:: loadthemes.php 106 2011-12-15 11:58:15Z subhendu               $
//* $Revision:: 106                                                      $ 
//* $Author:: subhendu                                                   $
//* $LastChangedDate:: 2011-12-15 17:28:15 +0530 (Thu, 15 Dec 2011)      $
//******************************************************************************/
$type=$_REQUEST["type"];
$server=$_REQUEST["server"];
$api_url ="http://api.ids.ac.uk/openapi/".$server."/get_all/themes/?num_results=500&_token_guid=".$type."&_accept=application/xml";
$xml = @simplexml_load_file($api_url);
if($xml)
{
	$content_elements = $xml->xpath('/root/results/list-item');
	if($content_elements)
	{  
		foreach ($content_elements as $list_item)
		{
		   $title = $list_item->title;
		   echo "<option value=\"".$title ."\">".$title ."</option>";
		}
	}
}	
 ?>