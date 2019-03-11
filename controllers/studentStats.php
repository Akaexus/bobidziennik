<?php


class StudentStats extends Controller
{

	public function manage()
	{
        $student = $this->student;					// pobranie danych ucznia
        $studentClass = $student->getClass();						// pobranie informacji o klasie
        $studentLeader = Teacher::load($studentClass->wychowawca);	// pobranie informacji o wychowawcy

        $subjects = array_map(function($student) {					// pobranie informacji o przedmiotach
            return new Subject($student);
        }, DB::i()->select([
            'select'=> '*',
            'from'=> Subject::$databaseTable
        ]));


        $marks = array_map(function($student) {						// pobranie informacji o ocenach
            return new Mark($student);
        }, DB::i()->select([
            'select'=> '*',
            'from'=> Mark::$databaseTable,
            'where'=> [
                ["id_ucznia = ?", $student->id]
            ]
        ]));


        $template = Output::i()->renderTemplate('studentStats', 'stats', [
            'student'=> $student,
            'studentClass'=> $studentClass,
            'studentLeader'=> $studentLeader,
            'subjects'=> $subjects,
            'marks'=> $marks
        ]);
        Output::i()->add($template);
	}

	public function execute()
	{
        if (User::loggedIn()->isUczen()) {
            $this->student = Student::getByUserId(User::loggedIn()->id);
        } else {
            $this->student = Student::load(Request::i()->id);
        }

	}
}


?>
