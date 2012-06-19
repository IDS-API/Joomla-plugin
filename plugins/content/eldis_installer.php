<?php
//******************************************************************************
//* $Id:: eldis_installer.php 148 2012-02-07 13:14:07Z subhendu          $
//* $Revision:: 148                                                      $ 
//* $Author:: subhendu                                                   $
//* $LastChangedDate:: 2012-02-07 18:44:07 +0530 (Tue, 07 Feb 2012)      $
//******************************************************************************/

class EldisInstaller
{
	function createEldisObjectTable($table_name,$col_name)
	{
		$table_name = "#__".$table_name;
		$db =& JFactory::getDBO();
		$query = "create table IF NOT EXISTS ".$db->nameQuote($table_name)." ( ".$db->nameQuote($col_name)." varchar(20) NOT NULL, primary key ( ".$db->nameQuote($col_name)."));";
		$db->setQuery( $query );
		if($db->query())
			return true;
		else
			return false;
	}
  
	function getEldisUserID()
	{
		$fname = "Eldis";
		$lname = "";
		$username = "eldisapi";
		$email = "abc@eldis.com";
		
		$db=&JFactory::getDBO();
		$query = "select id 
				from ".$db->nameQuote('#__users')."
				where ".$db->nameQuote('username')." = ".$db->quote($username).";";
		$db->setQuery($query);
		if($id = $db->loadResult())
		{
			return (int)$id;  //user exist
		}
		else
		{
			if($user = $this->create_eldis_user($fname, $lname, $username, $email))
			{
				return $user->id;
			}
			else
			{
				return false;
			}
		}
			
	}
   
   function create_eldis_user($fname,$lname,$uname,$email)
   { 
      $firstname = $fname;
      $lastname = $lname; 
      $username = $uname; 

      // get the ACL
      $acl =& JFactory::getACL();

      /* get the com_user params */
      jimport('joomla.application.component.helper');
      $usersParams = &JComponentHelper::getParams( 'com_users' );
       
      $user = JFactory::getUser(0); // set to "0" else admin user information will be loaded

      $data = array();

      // get the default usertype
      $usertype = $usersParams->get( 'new_usertype' );
      if (!$usertype) {
         $usertype = 'Registered';
      }

      // set up the "main" user information
      $data['name'] = $firstname.' '.$lastname;
      $data['username'] = $username;
      $data['email'] = $email;
      $data['gid'] = $user->getAuthorisedGroups();  // generate the gid from the usertype
       
      $textLength=9;
      $alphanum = "ABDFGHJKMNPRSTUVWXYZ23456789aefhjmnprt";
      $user_pas= substr(str_shuffle($alphanum), 0, $textLength);
      $data['password'] = $user_pas; // set the password
      $data['password2'] = $user_pas; // confirm the password
      $data['sendEmail'] = 0;

      $data['block'] = 0; 
      if (!$user->bind($data)) {
         return false;
      }

      if (!$user->save()) {
         return false;
      }
      return $user;
   }
   
   function showContentFromXml($userid,$xml)
   {
		$this->_plugin = JPluginHelper::getPlugin( 'content', 'eldisapi' );
		$pluginParams = new JParameter( $this->_plugin->params );
		$plgParams->mycategory = $pluginParams->get("mycategory");
		$db3 =& JFactory::getDBO();
		$obj_qry1 = "select id from ".$db3->nameQuote('#__categories'). "where id =". $plgParams->mycategory;
		$db3->setQuery($obj_qry1);
		$section = $db3->loadResultArray();
	  
      $content_elements = $xml->xpath('/root/results/list-item');
      if($content_elements)
      {     
         $stored_object_ids = array();
         $fetched_object_ids = array();
         $stored_object_ids = $this->getStoredObjectIds();
         foreach ($content_elements as $list_item)
         {$fetched_object_ids[] = $list_item->object_id;}
       
         $result = array_diff($fetched_object_ids, $stored_object_ids);  // get only those ids those are not exist in db
            
         foreach ($content_elements as $list_item)
         {
            $object_id = $list_item->object_id;
            if(in_array($object_id,$result))
            {
               $alias = JFilterOutput::stringURLSafe($list_item->title);
               $keywords = $this->convertXmlElementToStr(",",$list_item->keyword);
               $read_more = $list_item->website_url;
               $current_date = date("Y-m-d h:i:s");
               $db =& JFactory::getDBO();
               $obj_qry = "insert into ".$db->nameQuote('#__eldis_objects')." values (".$db->quote($object_id).");";
               $db->setQuery($obj_qry);
               if($db->query())
               {
                  $content_qry = "INSERT INTO ".$db->nameQuote('#__content')." (
											`id` ,
											`title` ,
											`alias` ,
											`title_alias` ,
											`introtext` ,
											`fulltext` ,
											`state` ,
											`sectionid` ,
											`mask` ,
											`catid` ,
											`created` ,
											`created_by` ,
											`created_by_alias` ,
											`modified` ,
											`modified_by` ,
											`checked_out` ,
											`checked_out_time` ,
											`publish_up` ,
											`publish_down` ,
											`images` ,
											`urls` ,
											`attribs` ,
											`version` ,
											`parentid` ,
											`ordering` ,
											`metakey` ,
											`metadesc` ,
											`access` ,
											`hits` ,
											`metadata`,
											`language`
											)
											VALUES (
											NULL , ".$db->quote($list_item->title).", ".$db->quote($alias).", '', ".$db->quote($list_item->headline).", ".$db->quote($list_item->description."\n<br/>Source: <a target='blank' href='".$read_more."'>Eldis</a>").", '0', ".$section[0].", '0', ".$plgParams->mycategory.", ".$db->quote($current_date).", ".$db->quote($userid).", '', '0000-00-00 00:00:00', '0', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '1', '0', '0', ".$db->quote($keywords).", '', '0', '0', '', '*'
											);";
                  $db2 =& JFactory::getDBO();
                  $db2->setQuery($content_qry);
                  if($db2->query())
                     $db2->insertid();
               }
            }
         } 
      }else{return false;}
   }
   
   
   function getStoredObjectIds()
   {
      $ids = array();
      $table_name = "eldis_objects";
      $col_object_id = 'object_id';
      $db =& JFactory::getDBO();
      $query = "SELECT ".$db->nameQuote($col_object_id)." FROM ".$db->nameQuote("#__".$table_name).";";
      $db->setQuery($query);
      $result = $db->loadResultArray();
      if($result)
         $ids = $result;
      
      return $ids;
   }
   
   function convertXmlElementToStr($glue,$element)
   {
      $str ="";
      $children = $element->children();
      if(count($children)>0)
      {
        $keys_count = count($children);
        $i=0;
         foreach($children as $child)
         {
            $str .= $child;
            $str .= ($i<($keys_count-1))? $glue." " : "";
            $i++;
         }
      }
      return $str;
   }
}
?>