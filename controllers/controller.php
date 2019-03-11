<?php



abstract class Controller {
	public static $controllers = [
        'studentClasses' => [
            'permissions'=> ['u']
        ],
		// 'dashboard'=> [
		// 	'permissions'=> ['u']
		// ],
	    'login'=> [
	        'permissions'=> ['g']
	    ],
	    'logout' => [
	    	'permissions'=> ['u']
	    ],
	    'marks' => [
	    	'permissions'=> ['u']
	    ],
		'studentStats' => [
			'permissions'=> ['u']
		],
		'subject' => [
			'permissions'=> ['u']
		]
	];
	abstract public function execute();
	public function __construct() {
		$this->execute();
		if (array_key_exists('do', $_GET)) {
			$req = $_GET['do'];
			if (strlen($req) === 0 || $req[0] === '_') {
				$this->execute();
			} else {
				if (method_exists($this, $req)) {
					$this->$req();
				} else {
					$this->manage();
				}
			}
		} else {
			$this->manage();
		}
	}
}
