<?php

class Module_logout {

	public function logout() {
		session_destroy();
		return 'wylogowano';
	}

	public function render() {
		if ($_SESSION['user_id']) {
			return $this->logout();
		} else {
			echo 'najpierw się zaloguj';
		}
	}
}