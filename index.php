<?php
	require_once('db.php');
	session_start();
	$c = mysqli_connect($DB['host'], $DB['user'], $DB['pass'], $DB['db']);
	if (!$c) {
		die('błąd połączenia');
	}

	$modules = [
		'login',
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
	$page = new $module($c);
	echo $page->render();
?>
