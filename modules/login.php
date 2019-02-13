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
		if (isset($_SESSION['user_id'])) {
			return 'zalogowany';
		} else {
			if (!isset($_POST['login']) && !isset($_POST['pass'])) {
				return $this->loginForm();
			} else {
				$login = $_POST['login'];
				$pass = $_POST['pass'];
				$accounts = DB::i()->select("select * from users where login='$login' and pass='$pass'");
				if ($accounts==null) {
					return $this->loginForm();
				} else {
					$user = $accounts[0];
					$_SESSION['user_id'] = $user['id'];
					$_SESSION['user'] = new User($user);
					echo 'pomyślnie zalogowano';
				}
			}
		}
	}
}