<?php

class Mark extends ActiveRecord
{
    public static $databaseTable = 'oceny';
    public static $idColumn = 'id';
    public static $columnNames = [
        'id',
        'ocena',
        'id_nauczyciela',
        'id_przedmiotu',
        'id_ucznia',
    ];
    public static function form($defaultValues = [])
    {
        $form = new \Nette\Forms\Form();
        $form->addRadioList(
            'ocena',
            'Ocena',
            [
                '1'=>'1',
                '2'=>'2',
                '3'=>'3',
                '4'=>'4',
                '5'=>'5',
                '6'=>'6',
            ]
        )->setRequired();
        $form->addSubmit('send', $defaultValues ? 'Edytuj' : 'Dodaj');
        return $form;
    }
}
