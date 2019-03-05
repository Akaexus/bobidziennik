<?php


class StudentClasses extends Controller {

	public function overview() {
		$classID = $_GET['id'];
		$class = StudentClass::load($classID);
		$template = Output::i()->getTemplate('studentClasses', 'overview');
		Output::i()->add($template->render([
			'class'=> $class,
			'students'=> $class->getStudents()
		]));
	}

	public function _getForm($defaultValues = null) {

	}

	public function execute() {

	}

	public function add() {
		$form = StudentClass::form();
		if ($form->isSuccess()) {
			$fv = $form->getValues();
			$studentClass = new StudentClass([
				'nazwa'=> $fv->nazwa,
				'symbol'=> $fv->symbol,
				'rok'=> $fv->rok,
				'wychowawca'=> $fv->wychowawca
			]);
			$studentClass->_new = true;
			$id = $studentClass->save();
			Output::i()->redirect('?s=studentClasses&id='.$id);
		} else {
			$template = Output::i()->getTemplate('studentClasses', 'add');
			Output::i()->add($template->render([
				'form'=> $form
			]));
		}
	}

	public function manage()
	{
		$classes = array_map(function($student) {
			return new StudentClass($student);
		}, DB::i()->select([
			'select'=> '*',
			'from'=> StudentClass::$databaseTable
		]));
		$template = Output::i()->getTemplate('studentClasses', 'list');
		Output::i()->add($template->render([
			'classes'=> $classes
		]));
	}
}
