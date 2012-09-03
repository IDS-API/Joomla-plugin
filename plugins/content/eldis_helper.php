<?php
//******************************************************************************
//* $Id:: eldis_helper.php 117 2011-12-15 19:27:38Z subhendu             $
//* $Revision:: 117                                                      $ 
//* $Author:: subhendu                                                   $
//* $LastChangedDate:: 2011-12-16 00:57:38 +0530 (Fri, 16 Dec 2011)      $
//******************************************************************************/
jimport('joomla.html.parameter');
class EldisHelper
{
   function updatePluginParameters($params)
   {
      $params->eldis_sync_date  =  JFactory::getDate();
      $str_plg_params = $this->convertAssocToStr("=",(array)$params);
      
      $plgFolder = "content";
      $plgName = "eldisapi";
      
      $db=&JFactory::getDBO();
      $sql="UPDATE `#__extensions` SET `params` = '".$str_plg_params."' WHERE `#__extensions`.`extension_id` =".$this->getPluginId($plgFolder,$plgName);
      $db->setQuery($sql);
      if($db->query())
         return true;
      else
         return false;
   }
  
  	function convertAssocToStr($glue=",",$assoc_arr = array())
   {
      $str = null;
      foreach($assoc_arr as $key => $val)
      {
         $str .= $key.$glue.$val."\n";
      }
      return $str;
   }
    	
   function getPluginId($folder,$name)
   {
      $db=&JFactory::getDBO();
      $sql='SELECT `extension_id` FROM `#__extensions` WHERE `folder`="'.$db->getEscaped($folder).'" AND `element`="'.$db->getEscaped($name).'"';
      $db->setQuery($sql);
      if(!($plg=$db->loadObject())){
         //JError::raiseError(100,'Fatal: Plugin is not installed or problem in SQL server.');
      }else return (int)$plg->extension_id;
   }
}
?>