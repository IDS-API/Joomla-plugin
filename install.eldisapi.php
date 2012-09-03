<?php
//******************************************************************************
//* $Id:: install.eldisapi.php 134 2011-12-26 10:06:35Z subhendu         $
//* $Revision:: 134                                                      $ 
//* $Author:: subhendu                                                   $
//* $LastChangedDate:: 2011-12-26 15:36:35 +0530 (Mon, 26 Dec 2011)      $
//******************************************************************************/
defined('_JEXEC') or die('Restricted access');
jimport('joomla.installer.installer');

$installer = new JInstaller();
$installer->install($this->parent->getPath('source').'/plugins');

$database = &JFactory::getDBO();
$query = "UPDATE #__menu SET `alias` = 'Eldis OpenAPI' WHERE `path`='eldis-openapi'";
$database->setQuery($query);
if (!$database->query())
JError::raiseNotice(100, $database->getErrorMsg());

$database = &JFactory::getDBO();
$query = "UPDATE #__extensions SET `protected` = '1' , `enabled` = '1' WHERE `element`='eldisapi'";
$database->setQuery($query);
if (!$database->query())
JError::raiseNotice(100, $database->getErrorMsg());

echo "<p>Installation of Plugin successfull</p>";
return true;
?>
