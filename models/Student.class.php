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

	public function __toString() {
		return "{$this->imie} {$this->nazwisko}";
	}

	public function getClass()
	{
		$studentClass = studentClass::load($this->id_klasy);
		return $studentClass;
	}

	// public function leadingTeacher() {
	// 	return Teacher::load($this->wychowawca);
	// }

	public function getLeader()
	{
		$studentLeader = studentClass::load($this->wychowawca);
		return $studentLeader;
	}

	public function getMarks($subject = NULL) {
		$whereClause = ['id_ucznia = '.$this->getId()];
		if ($subject) {
			if ($subject instanceof Subject) {
				$whereClause[] = 'id_przedmiotu = '.$subject->getId();
			} else {
				$whereClause[] = 'id_przedmiotu = '.$subject;
			}
		}
		$whereClause = implode(' AND ', $whereClause);
		$marks = DB::i()->select([
			'select'=> '*',
			'from'=> Mark::$databaseTable,
			'where'=> [
				['id_przedmiotu=?', ($subject instanceof Subject ? $subject->getId() : $subject)]
			]
		]);
		return $marks;
	}
}