<?php

require_once('ActiveRecord.class.php');

class Student extends ActiveRecord {
	public static $databaseTable = 'uczen';
	public static $idColumn = 'id';
	public static $columnNames = [
		'id',
		'id_konta',
		'id_klasy',
		'imie',
		'nazwisko',
		'pesel',
		'photo',
	];
}