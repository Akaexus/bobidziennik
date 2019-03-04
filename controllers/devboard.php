<?php

class Devboard extends Controller {
	public function manage() {
		Output::i()->add('<pre>');
		$class = Student::load(1);
		Output::i()->add(print_r($class->getMarks(), 1));
		Output::i()->add('</pre>');
	}
	public function execute()
	{
		# code...
	}
}