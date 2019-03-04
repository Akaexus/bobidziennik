<?php

class Request {
	protected $__data = [];
	protected $__protectedProperties = [
		'__data',
		'__protectedProperties',
		'controller',
	];
	public function __construct() {
		$data = array_merge($_POST, $_GET);
		foreach ($data as $key => $value) {
			if (!in_array($key, $this->__protectedProperties) && preg_match('/^[a-zA-Z][a-zA-Z0-9_]*$/', $key)) {
				$this->$key = trim(htmlspecialchars($value));		
			} else {
				unset($data[$key]);
			}
		}

		if(User::loggedIn()) {
			if (array_key_exists('s', $data) && array_key_exists($data['s'], Controller::$controllers)) {
				$this->controller = $data['s'];
			} else {
				$this->controller = array_keys(Controller::$controllers)[0];
			}
		} else {
			$this->controller = 'login';
		}
	}

	public static $instance;
	static function i() {
		if (self::$instance === null) {
			require_once(BD_ROOT_PATH.'db.php');
			self::$instance = new Request;
		}
		return self::$instance;
	}
}