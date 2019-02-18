<?php

class Login implements Controller {
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
			Output::i()->add('zalogowany');
		} else {
			if (!isset($_POST['login']) && !isset($_POST['pass'])) {
				Output::i()->add($this->loginForm());
			} else {
				$login = $_POST['login'];
				$pass = $_POST['pass'];
				$logged = User::login($login, $pass);
				if ($logged) {
					Output::i()->redirect('/');
				} else {
					Output::i()->add($this->loginForm());
				}
			}
		}
	}
}