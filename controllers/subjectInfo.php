<?php

class SubjectInfo extends Controller
{
    public function manage()
    {
        $class = StudentClass::load($this->classId);
        $subject = Subject::load($this->subjectId);
        Output::i()->addBreadcrumb(
            [
                ['name'=> 'Klasy', 'url'=> "?s=studentClasses"],
                ['name'=> $class->name(), 'url'=> "?s=studentClasses&do=overview&id={$class->id}"],
                ['name'=> $subject->name(), 'url'=> "?s=subjectInfo&class={$class->id}&subject={$subject->id}"],
            ]
        );
        Output::i()->title = "Przedmiot {$subject->name()}";

        $students = $class->getStudents();

        foreach ($students as $student) {
            $student->marks = $student->getMarks($subject);
        }


        $template = Output::i()->renderTemplate(
            'subjectInfo',
            'subjectInfo',
            [
                'students'=> $students,
                'subject'=> $subject,
                'class'=> $class,
            ]
        );
        Output::i()->add($template);
    }
    public function execute()
    {
        try {
            if (isset(Request::i()->class) && isset(Request::i()->subject)) {
                $this->classId = Request::i()->class;
                $this->subjectId = Request::i()->subject;
            } else {
                throw new \InvalidArgumentException();
            }
        } catch (InvalidArgumentException $e) {
            Output::i()->error(1000, 'Nieprawidłowy przedmiot!');
        }
    }
}



?>
