<?php

class Devboard extends Controller {
	public function execute() {
		Output::i()->add('<pre>');
		$class = StudentClass::load(1);
		Output::i()->add(print_r($class->getSubjects(), 1));
		Output::i()->add('</pre>');
	}
}