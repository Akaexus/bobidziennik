<?php

class Logout implements Controller {

	public function _logout() {
		User::logout();
	}

	public function render() {
		if (User::loggedIn()) {
			$this->_logout();
			Output::i()->add('wylogowano');
		}
	}
}