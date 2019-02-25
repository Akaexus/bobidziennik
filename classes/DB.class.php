<?php

	class DB {
		public $config;
		public $c;
		function __construct($config) {
			$this->config = $config;
			$this->c = mysqli_connect($config['host'], $config['user'], $config['pass'], $config['db']);
			if (mysqli_connect_error($this->c)) {
				throw new Exception('failed to connect to db');
			}
		}

		function query($q) {
			return $this->c->query($q);
		}

		function select($q) {
			$query = $this->query($q);
			if (!mysqli_num_rows($query)) {
				return null;
			} else {
				$results = [];
				while ($r = $query->fetch_assoc()) {
					$results[] = $r;
				}
				return $results;
			}
		}

		// SINGLETON
		public static $instance;
		static function i() {
			if (self::$instance === null) {
				require_once(BD_ROOT_PATH.'db.php');
				self::$instance = new DB($DB);
			}
			return self::$instance;
		}
	}