<?php

class Devboard {
	public function render() {
		Output::i()->add('<pre>');
		$class = StudentClass::load(1);
		Output::i()->add(print_r($class->getStudents(), 1));
		Output::i()->add('</pre>');
	}
}