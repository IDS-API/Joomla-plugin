<?php
//******************************************************************************
//* $Id:: multilistcountry.php 120 2011-12-19 04:15:07Z subhendu         $
//* $Revision:: 120                                                      $ 
//* $Author:: subhendu                                                   $
//* $LastChangedDate:: 2011-12-19 09:45:07 +0530 (Mon, 19 Dec 2011)      $
//******************************************************************************/
defined('_JEXEC') or die( 'Restricted access' );
defined('JPATH_BASE') or die();
jimport("joomla.html.parameter.element");
$document = &JFactory::getDocument();
$document->addScript( JURI::root(true).'/administrator/components/com_eldisapi/eldis.js');
class JElementMultiListCountry extends JFormField
{
	var $_name = 'MultiListCountry';
	function getInput()
	{
		$options = array ();
		$options[] = JHTML::_('select.option', "Countries", JText::_("Countries"));
		$attribs	= ' ';
		
		if ($v = $node->attributes( 'size' )) {
			$attribs	.= 'size="50"';
		}
		if ($v = $node->attributes( 'class' )) {
			$attribs	.= 'class="'.$v.'"';
		} else {
			$attribs	.= 'class="inputbox"';
		}
		if ($m = $node->attributes( 'multiple' ))
		{
			$attribs	.= ' multiple="multiple"';
		}
		
		$attribs	.= 'ondblclick=createFromMultiSelection("paramseldis_article_country_list","paramseldis_article_country")';
		return JHTML::_('select.genericlist', $options, $this->name, $attribs, 'value', 'text', $this->value, $this->id);
	}
}