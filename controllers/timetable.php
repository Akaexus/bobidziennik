<?php

class Timetable extends Controller {
    public function execute()
    {
        // code...
    }

    public function manage() {
        if (isset(Request::i()->class)) {
            try {
                $class = StudentClass::load(Request::i()->class);
                $timetable = $class->getTimetable();
                $template = Output::i()->renderTemplate('timetable', 'timetable', [
                    'class'=> $class,
                    'timetable'=> $timetable,
                    'hours'=> StudentClass::$hours,
                ]);
                Output::i()->add($template);
            } catch (\Exception $e) {
                Output::i()->error('1001', 'Nie ma takiej klasy!');
            }

        } else {
            $classes = array_map(function($e) {return new StudentClass($e);}, DB::i()->select([
                'select'=> '*',
                'from'=> StudentClass::$databaseTable
            ]));
            $template = Output::i()->renderTemplate('timetable', 'list', [
                'classes'=>$classes
            ]);
            Output::i()->add($template);
        }
    }
}
