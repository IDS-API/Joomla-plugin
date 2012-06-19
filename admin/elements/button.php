<?php
//******************************************************************************
//* $Id:: button.php 125 2011-12-26 05:40:17Z subhendu                   $
//* $Revision:: 125                                                      $ 
//* $Author:: subhendu                                                   $
//* $LastChangedDate:: 2011-12-26 11:10:17 +0530 (Mon, 26 Dec 2011)      $
//******************************************************************************/
$document = &JFactory::getDocument();
$document->addScript( JURI::root(true).'/administrator/components/com_eldisapi/eldis.js');
defined('_JEXEC') or die('Restricted access');
jimport('joomla.form.formfield');
class JFormFieldButton extends JFormField {
 
	protected $type = 'button';
 	public function getInput() {
			return '<input value="Preview" type="button" style="width:100;"  onclick="popitup(\'preview.php?search=1\');"/>';
	}
}