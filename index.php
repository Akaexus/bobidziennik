<?php
	require_once('models/User.class.php');
	require_once('classes/DB.class.php');

	session_start();
	$modules = [
	    'login'=> [
	        // g - guest
	        // u - user
	        // s - student
	        // t - teacher
	        'permissions'=> ['g', 'u', 's', 't']
	    ],
	    'logout' => [
	    	'permissions'=> ['u', 's', 't']	
	    ],
	    'marks' => [
	    	'permissions'=> ['u', 's', 't']
	    ]
];

	if (!isset($_GET['s'])) {
		$module = array_keys($modules)[0];
	} else {
		$module = $_GET['s'];
	}

	if (!array_key_exists($module, $modules)) {
		$module = 'login';
	}

	require "modules/$module.php";
	$allowed = false;
	$logged = isset($_SESSION['user_id']);
	if (in_array('g',$modules[$module]['permissions']) && !$logged) {
		$allowed = true;
	}
	if ($logged) {
		if (in_array('u',$modules[$module]['permissions'])) {
			$allowed = true;
		}
		if (in_array('s',$modules[$module]['permissions']) && $_SESSION['user']->isUczen()) {
			$allowed = true;
		}
		if (in_array('t',$modules[$module]['permissions']) && $_SESSION['user']->isNauczyciel()) {
			$allowed = true;
		}
	}
	
	$module = 'Module_'.$module;
	$page = new $module();
	echo $page->render();
?>
