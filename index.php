<?php
use Nette\Forms\Rule;

	define('BD_ROOT_PATH', __DIR__.'/');
	define('DEV_MODE', true);
	require_once('autoload.php');
	require_once('vendor/autoload.php');

	session_start();
    // g - guest
    // u - user
    // s - student
    // t - teacher
	$controllers = [
		'devboard'=> [
			'permissions'=> ['u']
		],
	    'login'=> [
	        'permissions'=> ['g']
	    ],
	    'logout' => [
	    	'permissions'=> ['u']
	    ],
	    'marks' => [
	    	'permissions'=> ['u']
	    ],
	    'studentClasses' => [
	    	'permissions'=> ['u']
	    ],
	    'studentStats' => [
	    	'permissions'=> ['u']
	    ]
	];

	$allowed = false;
	foreach (User::getPermissionMap() as $perm) {
		if (in_array($perm, Controller::$controllers[Request::i()->controller]['permissions'])) {
			$allowed = true;
		}
	}

	if ($allowed) {
		require "controllers/".Request::i()->controller.".php";
		$controller = ucfirst(Request::i()->controller);
		$page = new $controller();
	} else {
		Output::i()->add('error brak dostępu');
	}
	Output::i()->render();
?>
