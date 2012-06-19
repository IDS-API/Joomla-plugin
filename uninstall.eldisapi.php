<?php
//******************************************************************************
//* $Id:: uninstall.eldisapi.php 120 2011-12-19 04:15:07Z subhendu       $
//* $Revision:: 120                                                      $ 
//* $Author:: subhendu                                                   $
//* $LastChangedDate:: 2011-12-19 09:45:07 +0530 (Mon, 19 Dec 2011)      $
//******************************************************************************/

$plgFolder = "content";
$plgName = "eldisapi";


function com_uninstall() {
$database = &JFactory::getDBO();
$query = "DELETE FROM #__extensions where `element`='com_eldisapi'";
$database->setQuery($query);
if (!$database->query())
JError::raiseNotice(100, $database->getErrorMsg());

$query = "DELETE FROM #__extensions where `element`='eldisapi'";
$database->setQuery($query);
if (!$database->query())
JError::raiseNotice(100, $database->getErrorMsg());
//$query = "DROP TABLE #__eldisapi";
//$database->setQuery($query);
//if (!$database->query())
//JError::raiseNotice(100, $database->getErrorMsg());
if (count(JError::getErrors()) > 0) {
echo "Error condition - Uninstallation not successfull! You have to manually remove com_eldisapi,eldisapi from '.._components'";
} else {
echo "Uninstallation successfull!";
}}
?>

