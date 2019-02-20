<?php

class Logout extends Controller {

	public function _logout() {
		User::logout();
	}

	public function execute() {
		if (User::loggedIn()) {
			$this->_logout();
			Output::i()->add('wylogowano');
		}
	}
}