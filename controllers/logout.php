<?php

class Logout extends Controller {

	public function _logout() {
		User::logout();
	}

	public function manage() {
		if (User::loggedIn()) {
			$this->_logout();
			Output::i()->add('wylogowano');
		}
	}
	public function execute()
	{
		# code...
	}
}