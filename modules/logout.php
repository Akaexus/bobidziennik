<?php

class Module_logout {

	public function logout() {
		User::logout();
	}

	public function render() {
		if (User::loggedIn()) {
			return $this->logout();
			echo 'wylogowano';
		} else {
			echo 'najpierw się zaloguj';
		}
	}
}