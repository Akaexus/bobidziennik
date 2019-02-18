<?php

	require_once('models/User.class.php');
	require_once('classes/DB.class.php');

	session_start();
	$modules = [
		'login',
		'logout',
		'marks'
	];

	if (!isset($_GET['s'])) {
		$module = $modules[0];
	} else {
		$module = $_GET['s'];
	}
	
	if (!in_array($module, $modules)) {
		$module = 'login';
	}
	require "modules/$module.php";
	$module = 'Module_'.$module;
	$page = new $module();
	echo $page->render();
?>
