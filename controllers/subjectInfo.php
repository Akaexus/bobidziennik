<?php

class SubjectInfo extends Controller
{
	public function manage()
	{
        $class = StudentClass::load($this->classId);
        $subject = Subject::load($this->subjectId);
        $students = $class->getStudents();

        foreach ($students as $student) {
            $student->marks = $student->getMarks($subject);
        }


        $template = Output::i()->renderTemplate('subjectInfo', 'subjectInfo', [
            'students'=> $students,
            'subject'=> $subject
        ]);
        Output::i()->add($template);
	}
	public function execute()
	{
        $this->classId = $_GET['id'];
        $this->subjectId = $_GET['subject'];
	}
}



?>
