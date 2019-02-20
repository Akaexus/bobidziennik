<?php
	require_once('models/User.class.php');
	require_once('models/StudentClass.class.php');
	require_once('models/Student.class.php');
	require_once('models/Subject.class.php');
	require_once('models/Mark.class.php');
	require_once('classes/DB.class.php');
	require_once('classes/Output.class.php');
	require_once('controllers/controller.php');
	session_start();
	$controllers = [
		'devboard'=> [
			'permissions'=> ['u']
		],
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
		$controller = array_keys($controllers)[0];
	} else {
		$controller = $_GET['s'];
	}

	if (!array_key_exists($controller, $controllers)) {
		$controller = 'login';
	}

	$allowed = false;
	foreach (User::getPermissionMap() as $perm) {
		if (in_array($perm, $controllers[$controller]['permissions'])) {
			$allowed = true;
		}
	}

	if ($allowed) {
		require "controllers/$controller.php";
		$controller = ucfirst($controller);
		$page = new $controller();
	} else {
		Output::i()->add('error brak dostępu');
	}
	Output::i()->render();
?>
