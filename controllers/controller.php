<?php



abstract class Controller {
	abstract public function execute();
	public function __construct() {
		if (array_key_exists('do', $_GET)) {
			$req = $_GET['do'];
			if (!strlen($req) || $req[0] = '_') {
				$this->execute();
			} else {
				if (method_exists($this, $req)) {
					$this->$req();
				} else {
					$this->execute();
				}
			}
		} else {
			$this->execute();
		}
	}
}