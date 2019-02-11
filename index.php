<?php
	require_once('db.php');
	$c = mysqli_connect($DB['host'], $DB['user'], $DB['pass'], $DB['db']);
	if (!$c) {
		die('błąd połączenia');
	}

	$modules = [
		'login'
	];

	if (!isset($_GET['s'])) {
		$module = $modules[0];
	} else {
		$module = isset($_GET['s']);
	}
	
	if (!in_array($modules, $module)) {
		$module = 'login';
	}
	require "modules/$module.php";
	$module = 'Module_'.$module;
	$page = new $module();
	echo $page->render();
?>
