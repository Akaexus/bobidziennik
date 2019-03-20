<?php


class StudentStats extends Controller
{

	public function manage()
	{
        $student = $this->student;					// pobranie danych ucznia
        $studentClass = $student->getClass();						// pobranie informacji o klasie
        $studentLeader = Teacher::load($studentClass->wychowawca);	// pobranie informacji o wychowawcy
        Output::i()->title = "Uczen {$student->name()}";
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

    public function edit()
    {
        if (User::loggedIn()->isNauczyciel()) {
            Output::i()->title = 'Edytuj ucznia';
            $user = User::load($this->student->id_konta);
            $form = Student::form([
                'email'=> $user->email,
                'login'=> $user->login,
                'imie'=> $this->student->imie,
                'nazwisko'=> $this->student->nazwisko,
                'pesel'=> $this->student->pesel,
            ]);
            if ($form->isSuccess()) {
                $values = $form->getValues();
                foreach($values as $key => $value) {
                    $this->student->$key = $value;
                }
                $this->student->save();
                Output::i()->redirect('?s=studentStats&id='.$this->student->id);
            } else {
                Output::i()->add($form);
            }
        } else {
            Output::i()->redirect('?s=studentStats&id='.$this->student->id);
        }
    }

    public function addMark() {
        if (User::loggedIn()->isNauczyciel()) {
            if (ctype_digit(Request::i()->subject)) {
                Output::i()->title = 'Dodaj ocene';
                try {
                    $form = Mark::form();
                    $subject = Subject::load(Request::i()->subject);
                    $template = Output::i()->renderTemplate('studentStats', 'mark', [
                        'student'=> $this->student,
                        'subject'=> $subject,
                        'markForm'=> $form,
                    ]);
                    if ($form->isSuccess()) {
                        $values = $form->getValues();
                        $mark = new Mark([
                            'ocena'=> $values['ocena'],
                            'id_przedmiotu'=> $subject->id,
                            'id_ucznia'=> $this->student->id,
                            'id_nauczyciela'=> User::loggedIn()->isNauczyciel()
                        ]);
                        $mark->_new = true;
                        $mark->save();
                        $class = $this->student->getClass();
                        Output::i()->redirect("?s=subjectInfo&class={$class->id}&subject={$subject->id}");
                    } else {
                        Output::i()->add($template);
                    }
                } catch (\Exception $e) {
                    Output::i()->error(1000, 'Nieprawidłowy przedmiot lub uczeń!');
                }
            } else {
                Output::i()->error(1000, 'Nieprawidłowy przedmiot!');
            }
        } else {
            Output::i()->error(403, 'Nie masz uprawnień do tej strony!');
        }
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
