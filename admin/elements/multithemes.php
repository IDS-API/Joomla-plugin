<?php
//******************************************************************************
//* $Id:: multithemes.php 125 2011-12-26 05:40:17Z subhendu              $
//* $Revision:: 125                                                      $ 
//* $Author:: subhendu                                                   $
//* $LastChangedDate:: 2011-12-26 11:10:17 +0530 (Mon, 26 Dec 2011)      $
//******************************************************************************/
defined('_JEXEC') or die('Restricted access');
jimport('joomla.form.formfield');
class JFormFieldMultiThemes extends JFormField 
{
	protected $type = 'multithemes';
	public function getInput() 
	{
		$countries='<select ondblclick=createFromMultiSelection("jform_params_eldis_article_theme_list","jform_params_eldis_article_theme") multiple="multiple" id="'.$this->id.'" name="'.$this->name.'">';
		$countries=$countries. '<option value="Themes" >Themes</option>';
		$countries=$countries. '</select>';
		return $countries;
	}
}