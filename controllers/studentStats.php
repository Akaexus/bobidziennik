<?php


class StudentStats extends Controller
{
	public function MarksOverview()
	{
		$student = Student::load($this->studentId);
		$studentClass = $student->getClass();

		$template = Output::i()->getTemplate('StudentStats', 'stats');
		Output::i()->add($template->render([
			'student'=> $student,
			'studentClass'=> $studentClass
		]));
	}
	

	public function manage()
	{
		$this->studentId = $_GET['id'];
	}

	public function execute()
	{
		# code...
	}

}



?>