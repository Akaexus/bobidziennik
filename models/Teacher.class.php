<?php

class Teacher extends ActiveRecord
{
    public static $databaseTable = 'nauczyciel';
    public static $idColumn = 'id';
    public static $columnNames = [
        'id',
        'id_konta',
        'imie',
        'nazwisko'
    ];

    public function user()
    {
        return User::load($this->id_konta);
    }

    public function __toString()
    {
        return "{$this->imie} {$this->nazwisko}";
    }

}
