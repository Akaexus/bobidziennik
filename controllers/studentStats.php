<?php


class StudentStats extends Controller
{

    public function manage()
    {
        $student = $this->student;                    // pobranie danych ucznia
        $studentClass = $student->getClass();                        // pobranie informacji o klasie
        $studentLeader = Teacher::load($studentClass->wychowawca);    // pobranie informacji o wychowawcy
        Output::i()->title = "Uczen {$student->name()}";
        Output::i()->addBreadcrumb(
            [
                ['name'=> 'Klasy', 'url'=> "?s=studentClasses"],
                ['name'=> $studentClass->name(), 'url'=> "?s=studentClasses&do=overview&id={$studentClass->id}"],
                ['name'=> $student->name(), 'url'=> "?s=studentStats&id={$student->id}"],
            ]
        );
        $subjects = Subject::loadAll();
        $marks = Mark::loadAll(
            [
                ["id_ucznia = ?", $student->id]
            ]
        );

        $template = Output::i()->renderTemplate(
            'studentStats',
            'stats',
            [
                'student'=> $student,
                'studentClass'=> $studentClass,
                'studentLeader'=> $studentLeader,
                'subjects'=> $subjects,
                'marks'=> $marks
            ]
        );
        Output::i()->add($template);
    }

    public function edit()
    {
        if (User::loggedIn()->isNauczyciel()) {
            Output::i()->title = 'Edytuj ucznia';
            $user = User::load($this->student->id_konta);
            $class = $this->student->getClass();
            Output::i()->addBreadcrumb(
                [
                    ['name'=> 'Klasy', 'url'=> "?s=studentClasses"],
                    ['name'=> $class->name(), 'url'=> "?s=studentClasses&do=overview&id={$class->id}"],
                    ['name'=> $this->student->name(), 'url'=> "?s=studentStats&id={$this->student->id}"],
                    ['name'=> 'Edytuj', 'url'=> "?s=studentStats&do=edit&id={$this->student->id}"],
                ]
            );
            $form = Student::form(
                [
                    'email'=> $user->email,
                    'login'=> $user->login,
                    'imie'=> $this->student->imie,
                    'nazwisko'=> $this->student->nazwisko,
                    'pesel'=> $this->student->pesel,
                ]
            );
            if ($form->isSuccess()) {
                $values = $form->getValues();
                foreach ($values as $key => $value) {
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

    public function addMark()
    {
        if (User::loggedIn()->isNauczyciel()) {
            if (ctype_digit(Request::i()->subject)) {
                Output::i()->title = 'Dodaj ocene';
                try {
                    $form = Mark::form();
                    $subject = Subject::load(Request::i()->subject);
                    $template = Output::i()->renderTemplate(
                        'studentStats',
                        'mark',
                        [
                            'student'=> $this->student,
                            'subject'=> $subject,
                            'markForm'=> $form,
                        ]
                    );
                    $class = $this->student->getClass();
                    Output::i()->addBreadcrumb(
                        [
                            ['name'=> 'Klasy', 'url'=> "?s=studentClasses"],
                            ['name'=> $class->name(), 'url'=> "?s=studentClasses&do=overview&id={$class->id}"],
                            ['name'=> $subject->name(), 'url'=> "?s=subjectInfo&class={$class->id}&subject={$subject->id}"],
                            ['name'=> 'Dodaj ocene', 'url'=> "?s=studentStats&do=addMark&id={$this->student->id}&subject={$subject->id}"],
                        ]
                    );
                    if ($form->isSuccess()) {
                        $values = $form->getValues();
                        $mark = new Mark(
                            [
                                'ocena'=> $values['ocena'],
                                'id_przedmiotu'=> $subject->id,
                                'id_ucznia'=> $this->student->id,
                                'id_nauczyciela'=> User::loggedIn()->isNauczyciel()
                            ]
                        );
                        $mark->_new = true;
                        $mark->save();

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
