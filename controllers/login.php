<?php

class Login extends Controller{
	public function manage() {
		if (User::loggedIn()) {
			Output::i()->add('zalogowany');
		} else {
			$loginForm = Output::i()->getTemplate('login', 'form');
			if (!isset($_POST['login']) && !isset($_POST['pass'])) {
				Output::i()->add($loginForm->render());
			} else {
				$login = $_POST['login'];
				$pass = $_POST['pass'];
				$logged = User::login($login, $pass);
				if ($logged) {
					Output::i()->redirect('/');
				} else {
					Output::i()->add($loginForm->render());
				}
			}
		}
	}
	public function execute()
	{
		# code...
	}
}