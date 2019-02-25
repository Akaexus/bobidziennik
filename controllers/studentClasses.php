<?php


class StudentClasses extends Controller {

	public function list() {
		$classes = array_map(function($student) {
			return new StudentClass($student);
		}, DB::i()->select('select * from '.StudentClass::$databaseTable));
		$template = Output::i()->getTemplate('studentClasses', 'list');
		Output::i()->add($template->render([
			'classes'=> $classes
		]));
	}

	public function overview() {
		$classID = $_GET['id'];
		$class = StudentClass::load($classID);
		$template = Output::i()->getTemplate('studentClasses', 'overview');
		Output::i()->add($template->render([
			'class'=> $class,
			'students'=> $class->getStudents()
		]));
	}

	public function execute() {
	}
}