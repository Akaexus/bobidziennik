<?php

class Timetable extends Controller
{
    public function execute()
    {
        Output::i()->addBreadcrumb(
            [
                ['name'=> 'Plany lekcji', 'url'=> '?s=timetable'],
            ]
        );
    }

    public function manage()
    {
        if (isset(Request::i()->class)) {
            try {
                $classID = Request::i()->class;
                $class = StudentClass::load($classID);
                Output::i()->addBreadcrumb(
                    [
                        ['name'=> $class->name(), 'url'=> "?s=timetable&class={$classID}"],
                    ]
                );
                Output::i()->title = "Plan lekcji klasy {$class->name()}";
                $timetable = $class->getTimetable();
                $template = Output::i()->renderTemplate(
                    'timetable',
                    'timetable',
                    [
                        'class'=> $class,
                        'timetable'=> $timetable,
                        'hours'=> StudentClass::$hours,
                    ]
                );
                Output::i()->add($template);
            } catch (\Exception $e) {
                Output::i()->error('1001', 'Nie ma takiej klasy!');
            }

        } else {
            Output::i()->title = 'Lista klas';
            $classes = array_map(
                function($e) {
                    return new StudentClass($e);
                },
                DB::i()->select(
                    [
                        'select'=> '*',
                        'from'=> StudentClass::$databaseTable
                    ]
                )
            );
            $template = Output::i()->renderTemplate(
                'timetable',
                'list',
                [
                    'classes'=>$classes
                ]
            );
            Output::i()->add($template);
        }
    }
}
