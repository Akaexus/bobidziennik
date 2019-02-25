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
		}, DB::i()->select([
			'select'=> '*',
			'from'=> Student::$databaseTable,
			'where'=> [
				['id_klasy=?', $this->$columnID]
			]
		]));
		return $students;
	}


	public function leadingTeacher() {
		return Teacher::load($this->wychowawca);
	}

	public function getSubjects() {
		$columnID = static::$idColumn;
		$subjectsIDs = array_map(function($s) {
			return $s['id_przedmiotu'];
		}, DB::i()->select([
			'select'=> 'id_przedmiotu',
			'from'=> 'przypisania',
			'where'=> [
				['id_klasy=?', $this->$columnID]
			]
		]));

		$subjects = DB::i()->select('select * from '.Subject::$databaseTable.' where id in ('.implode(',', $subjectsIDs).')');
		$subjects = DB::i()->select([
			'select'=> '*',
			'from'=> Subject::$databaseTable,
			'where'=> [
				['id in ('.implode(',', array_map(function(){return '?';}, $subjectsIDs)), $subjectsIDs]
			]
		]);
		
		return $subjects;
	}
}