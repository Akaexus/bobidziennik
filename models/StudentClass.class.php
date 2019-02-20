<?php

require_once('ActiveRecord.class.php');

class StudentClass extends ActiveRecord {
	public static $databaseTable = 'klasa';
	public static $idColumn = 'id';
	public static $columnNames = [
		'id',
		'nazwa',
		'rok',
		'symbol',
		'wychowawca'
	];

	public function getStudents() {
		$columnID = static::$idColumn;
		$students = array_map(function ($studentData) {
			return new Student($studentData);
		}, DB::i()->select('select * from '.Student::$databaseTable.' where id_klasy = "'.$this->$columnID.'"'));
		return $students;
	}
}