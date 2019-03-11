<?php

class Dashboard extends Controller {
	public function manage() {
		Output::i()->add(Output::i()->renderTemplate('dashboard', 'dashboard'));
	}
	public function execute()
	{
		# code...
	}
}
