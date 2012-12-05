<?php
//******************************************************************************
//* $Id:: eldisapi.php 128 2011-12-26 05:41:14Z subhendu                 $
//* $Revision:: 128                                                      $ 
//* $Author:: subhendu                                                   $
//* $LastChangedDate:: 2011-12-26 11:11:14 +0530 (Mon, 26 Dec 2011)      $
//******************************************************************************/


// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// Import library dependencies
jimport('joomla.plugin.plugin');
jimport('joomla.filesystem.file');
jimport('joomla.html.parameter');
 
class plgContentEldisAPI extends JPlugin
{
   /**
    * Constructor
    *
    * For php4 compatability we must not use the __constructor as a constructor for
    * plugins because func_get_args ( void ) returns a copy of all passed arguments
    * NOT references.  This causes problems with cross-referencing necessary for the
    * observer design pattern.
    */
    
   function plgContentEldisAPI( &$subject )
   {
      parent::__construct( $subject );
      $current_date =  JFactory::getDate(); // get current date

      $this->_plugin = JPluginHelper::getPlugin( 'content', 'eldisapi' ); // get plugin object
      $pluginParams = new JParameter( $this->_plugin->params );  			// get plugin parameters object

     /*********** PLUGIN PARAMS *********/
      $plgParams->eldis_sync_date 	      = $pluginParams->def("eldis_sync_date","0000-00-00 00:00:00");
      $plgParams->eldis_skip_days 	      = $pluginParams->def("eldis_skip_days","2");
      
      $plgParams->eldis_guid 			      = $pluginParams->get("eldis_guid");
      $plgParams->eldis_server		      = $pluginParams->get("eldis_server");
      $plgParams->eldis_data_format  	   = $pluginParams->get("eldis_data_format");
      $plgParams->eldis_obj_type		      = $pluginParams->get("eldis_obj_type");
      $plgParams->eldis_records		      = $pluginParams->get("eldis_records");
      $plgParams->eldis_pub_after	   	= $pluginParams->get("eldis_pub_after");
      $plgParams->eldis_pub_before	      = $pluginParams->get("eldis_pub_before");
      $plgParams->eldis_pub_year		      = $pluginParams->get("eldis_pub_year");
		$plgParams->eldis_article_author    = $pluginParams->get("eldis_article_author");
		$plgParams->eldis_article_publisher = $pluginParams->get("eldis_article_publisher");
		$plgParams->eldis_article_country   = $pluginParams->get("eldis_article_country");
		$plgParams->eldis_article_keyword   = $pluginParams->get("eldis_article_keyword");
		$plgParams->eldis_article_theme     = $pluginParams->get("eldis_article_theme");	
		$plgParams->eldis_sort_value	    = $pluginParams->get("eldis_sort_value");
		$plgParams->eldis_sort_format	    = $pluginParams->get("eldis_sort_format");
		$plgParams->eldis_data_server	    = $pluginParams->get("eldis_data_server");
		$plgParams->mycategory 				 = $pluginParams->get("mycategory");		
      /****************************/
      
      $d1 = strtotime($plgParams->eldis_sync_date);  	// last sync date
      $d2 = strtotime($current_date);     			// current date
        
      $days = trim($plgParams->eldis_skip_days);
      $days = (is_numeric($days))? (int)$days : 2;
      // Include the syndicate functions only once
      require_once( dirname(__FILE__).DS.'eldis_helper.php' );
      require_once( dirname(__FILE__).DS.'eldis_installer.php' );
      $eldisHelper 	= new EldisHelper();
      $eldisInstaller = new EldisInstaller();
      
      $time_diff = ($d2-$d1);
      $skip_days = ($days*(60*60*24));
      
        if($time_diff >= $skip_days)    // if difference between current date and sync date is greater than or equals to two days
        {
         if($this->isEldisObjectTableExist())
         {
            if($id = $eldisInstaller->getEldisUserID())
            {
               $eldis_guid 		= $plgParams->eldis_guid;
               $eldis_server 		= $plgParams->eldis_server;
               $eldis_data_format	= $plgParams->eldis_data_format;
               $eldis_obj_type 	= $plgParams->eldis_obj_type;
               $eldis_records 		= $plgParams->eldis_records;
               $eldis_pub_after 	= $plgParams->eldis_pub_after;
               $eldis_pub_before 	= $plgParams->eldis_pub_before;
               $eldis_pub_year 	= $plgParams->eldis_pub_year;
					$eldis_article_author		= $plgParams->eldis_article_author;
					$eldis_article_publisher		= $plgParams->eldis_article_publisher;
					$eldis_article_country		= $plgParams->eldis_article_country;
					$eldis_article_keyword		= $plgParams->eldis_article_keyword;
					$eldis_article_theme		= $plgParams->eldis_article_theme;					
					$eldis_sort_format		= $plgParams->eldis_sort_format;
					$eldis_sort_value		= $plgParams->eldis_sort_value;
					$eldis_data_server		= $plgParams->eldis_data_server;
		
               //extra
					$extra='';
					if ($eldis_pub_after !=''){$extra .='&document_published_after='.$eldis_pub_after;}
					if ($eldis_pub_before !=''){$extra .='&document_published_before='.$eldis_pub_before;}
					if ($eldis_pub_year !=''){$extra .='&document_published_year='.$eldis_pub_year;}					
					if ($eldis_article_author !=''){$extra .='&author='.$eldis_article_author;}
					if ($eldis_article_publisher !=''){$extra .='&publisher='.$eldis_article_publisher;}
					if ($eldis_article_country !=''){$extra .='&country='.$eldis_article_country;}
					if ($eldis_article_keyword !=''){$extra .='&q='.$eldis_article_keyword;}
					if ($eldis_article_theme !=''){$extra .='&theme='.$eldis_article_theme;}	
 					if (($eldis_sort_format !='default') &&($eldis_sort_value !='default')){$extra .='&'.$eldis_sort_format.'='.$eldis_sort_value;}
             
                     $api_url = "http://api.ids.ac.uk/openapi/".$eldis_data_server."/search/documents/full?num_results=".$eldis_records.$extra."&_token_guid=".$eldis_guid."&_accept=application/xml";
					$xml = @simplexml_load_file($api_url);  // valid url
               
               if($xml)
               {
                  $eldisInstaller->showContentFromXml($id,$xml); // creating content from rss
                  /* updating parameters */
                  $eldisHelper->updatePluginParameters($plgParams);
               }
            }
            else{ return false;}		//eldis user does not exist
         }
         else{ return false;}		//eldis' object table does not exist
      }
      else{ return false; }		// run later
   }
   
   function isEldisObjectTableExist()
   {
       $eldisInstaller = new EldisInstaller();
      $table_exist = false;
      $table_name = "eldis_objects";
      $col_name = 'object_id';
      $db =& JFactory::getDBO();
      $tableList = $db->getTableList();
      $table_key_name = $db->getPrefix().$table_name;
      if(!in_array($table_key_name,$tableList))
      {
         $table_exist = $eldisInstaller->createEldisObjectTable($table_name,$col_name);
      }
      else
      {
         $table_exist = true;
      }
      return $table_exist;
   }

}
?>