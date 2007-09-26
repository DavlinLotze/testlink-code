<?php
/** 
* TestLink Open Source Project - http://testlink.sourceforge.net/ 
* $Id: planTestersNavigator.php,v 1.10 2007/09/26 06:27:49 franciscom Exp $ 
*
* @author	Martin Havlat <havlat@users.sourceforge.net>
* 
* This page lists users and plan for assignment. 
* 
* 20051231 - scs - changes due to ADBdb
*/
require_once('../../config.inc.php');
require_once('common.php');
require_once('users.inc.php');
require_once('plan.inc.php');
require_once("lang_api.php");
testlinkInitPage($db);

// 20051120 - fm
// The current selected Product
$prod->id   = $_SESSION['testprojectID'];
$prod->name = $_SESSION['testprojectName'];
$type = isset($_GET['type']) ? $_GET['type'] : 'users';

$arrData = null;
if ($type == 'plans')
{
	$title = lang_get('nav_test_plan');
	$selected = 'selected="selected"';
	$arrData = getAllActiveTestPlans($db,$prod->id,FILTER_BY_PRODUCT);
}
else
{
	$title = lang_get('nav_users');
	$selected = '';
	$arrData = getAllUsers($db);
}

$smarty = new TLSmarty;
$smarty->assign('title', $title);
$smarty->assign('type', $type);
$smarty->assign('selected', $selected);
$smarty->assign('arrData', $arrData);
$smarty->display('planTestersNavigator.tpl');
?>
