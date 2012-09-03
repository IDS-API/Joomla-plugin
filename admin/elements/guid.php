<?php
//******************************************************************************
//* $Id:: guid.php 130 2011-12-26 08:41:40Z subhendu                     $
//* $Revision:: 130                                                      $ 
//* $Author:: subhendu                                                   $
//* $LastChangedDate:: 2011-12-26 14:11:40 +0530 (Mon, 26 Dec 2011)      $
//******************************************************************************/
defined('_JEXEC') or die('Restricted access');
jimport('joomla.form.formfield');
$document = &JFactory::getDocument();
$document->addScript( JURI::root(true).'/administrator/components/com_eldisapi/eldis.js');
jimport('joomla.filesystem.file');

class JFormFieldGuid extends JFormField {
	protected $type = 'Guid';
 	public function getInput() 
	{
		$plgFolder = "content";
      $plgName = "eldisapi";
		$plugin =&JPluginHelper::getPlugin($plgFolder, $plgName);
		if ($plugin)
		{
			$params_object = new JParameter($plugin->params);
			$param_item = $params_object->get('eldis_guid');
			$param_text='';
		}
		else
		{
			$param_item ='';
			$param_text ='<br/><span style="color:#ff0000;"><small>Please enable plugin</small></span>';
		}

		return '<input type="text" style="width:100;" value="'.$param_item.'" name="jform[params][eldis_guid]"  id="'.$this->id.'"  onblur="validateGUID()" class=""/>'.$param_text;
	}
}