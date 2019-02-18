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
	        'permissions'=> ['g']
	    ],
	    'logout' => [
	    	'permissions'=> ['u']	
	    ],
	    'marks' => [
	    	'permissions'=> ['u']
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

	$allowed = false;
	foreach (User::getPermissionMap() as $perm) {
		if (in_array($perm, $modules[$module]['permissions'])) {
			$allowed = true;
		}
	}

	if ($allowed) {
		require "modules/$module.php";
		
		$module = 'Module_'.$module;
		$page = new $module();
		echo $page->render();
	} else {
		echo 'error brak dostępu';
	}
?>
