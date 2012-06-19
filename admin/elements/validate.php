<?php 
//******************************************************************************
//* $Id:: validate.php 112 2011-12-15 18:22:59Z subhendu                 $
//* $Revision:: 112                                                      $ 
//* $Author:: subhendu                                                   $
//* $LastChangedDate:: 2011-12-15 23:52:59 +0530 (Thu, 15 Dec 2011)      $
//******************************************************************************/	
$type=$_REQUEST["type"];
$api_url ="http://api.ids.ac.uk/openapi/eldis/get_all/countries/?num_results=1&_token_guid=".$type."&_accept=application/xml";
$xml = @simplexml_load_file($api_url);
$title="";
if($xml)
	{
		$content_elements = $xml->xpath('/root/results/list-item');
		if($content_elements)
		{     
			foreach ($content_elements as $list_item)
			{
			   $title = $list_item->title;
			}
		}
		echo $title;
	}				
 ?>