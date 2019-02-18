<?php

class Module_login {
	public function loginForm() {
		$output = <<<HTML
<form method="post">
	<label>
		Login: <input type="text" name="login">
	</label>
	<label>
		Password: <input type="password" name="pass">
	</label>
	<input type="submit" value="Zaloguj">
</form>
HTML;
		return $output;
	}

	public function render() {
		if (User::loggedIn()) {
			return 'zalogowany';
		} else {
			if (!isset($_POST['login']) && !isset($_POST['pass'])) {
				return $this->loginForm();
			} else {
				$login = $_POST['login'];
				$pass = $_POST['pass'];
				$logged = User::login($login, $pass);
				if ($logged) {
					echo 'pomyślnie zalogowano';
				} else {
					return $this->loginForm();
				}
			}
		}
	}
}