<?php

class Login extends Controller {

	public function manage() {
		if (User::loggedIn()) {
			Output::i()->add('zalogowany');
		} else {
			$form = new \Nette\Forms\Form();
			$form->addText('login', 'Login')->setRequired('Wypełnij pole login.');
			$form->addPassword('pass', 'Hasło')->setRequired('Wypełnij pole login.');
			$form->addSubmit('send', 'Zaloguj');
			if ($form->isSuccess()) {
				$formValues = $form->getValues();
				$logged = User::login($formValues['login'], $formValues['pass']);
				if ($logged) {
					Output::i()->redirect('/');
				} else {
					Output::i()->add($form);
				}
			} else {
				Output::i()->add($form);
			}
		}
	}
	public function execute()
	{
		# code...
	}
}
