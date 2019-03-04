<?php


class StudentStats extends Controller
{
	public function marksOverview()
	{
		$student = Student::load($this->studentId);
		$studentClass = $student->getClass();
		// print_r($studentClass);
		$studentLeader = Teacher::load($studentClass->wychowawca);
		// print_r($studentLeader);

		$template = Output::i()->getTemplate('StudentStats', 'stats');
		Output::i()->add($template->render([
			'student'=> $student,
			'studentClass'=> $studentClass,
			'studentLeader'=> $studentLeader
		]));
	}


	public function manage()
	{

	}

	public function execute()
	{
		$this->studentId = $_GET['id'];
	}

}



?>
