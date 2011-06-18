<?
	define('IN_MYBB', NULL);
	global $mybb, $lang, $query, $db, $cache, $plugins, $displaygroupfields;
	require_once '/home/arflux-rpg/public_html/forum/global.php';
	require_once 'class.MyBBIntegrator.php';
	$MyBBI = new MyBBIntegrator($mybb, $db, $cache, $plugins, $lang, $config); 
	if (!$MyBBI->isLoggedIn())
	{
		header( 'Location: http://arflux-rpg.com/forum/member.php?action=login' );
	}
?>