<?php 
//******************************************************************************
//* $Id:: loadthemes.php 107 2012-07-24 simonc			             		  	$
//* $Revision:: 107                                                    			$ 
//* $Author:: simonc                                                   			$
//* $LastChangedDate:: 2012-07-24									   			$
//******************************************************************************/
$type=$_REQUEST["type"];
$server=$_REQUEST["server"];
$api_url ="http://api.ids.ac.uk/openapi/".$server."/get_all/themes/?extra_fields=level&num_results=1200&_token_guid=".$type."&_accept=application/xml";
$xml = @simplexml_load_file($api_url);
if($xml)
{
	$content_elements = $xml->xpath('/root/results/list-item');
	if($content_elements)
	{  
		foreach ($content_elements as $list_item)
		{
		 $title = $list_item->title;
		 $level = $list_item->level;
		   
		   if ($level==1)
                  {
                 echo "<option  style=\"background-color:#eeeeee;\" value=\"".$title ."\">".$title . "</option>";
                  }
                  elseif ($level==2)
                  {
                  echo "<option value=\"".$title ."\">&nbsp;&nbsp;".$title . "</option>";   
                  }
				  else 
				  {
				  echo "";
				  }
                  /*elseif ($level==3)
                  {
                  echo "<option value=\"".$title ."\">&nbsp;&nbsp;&nbsp;&nbsp;".$title . "</option>";   
                  }
                  elseif ($level==4)
                  {
                  echo "<option value=\"".$title ."\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$title . "</option>";   
                  }*/
		}
	}
}	
 ?>