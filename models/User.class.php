<?php
require_once('ActiveRecord.class.php');
class User extends ActiveRecord
{

	protected static $databaseTable = 'users';
	protected static $idColumn = 'id';
	protected static $columnNames = [
		'id',
		'email',
		'pass',
		'login'
	];
	public function isNauczyciel()
	{
		$teachers = DB::i()->select("SELECT * from nauczyciel where id_konta=$this->id");
		if ($teachers) {
			return true;
		} else {
			return false;
		}
	}
	public function isUczen()
	{
		$students = DB::i()->select("SELECT * from uczen where id_konta=$this->id");
		if ($students) {
			return true;
		} else {
			return false;
		}
	}
}


// $query select * from user where id=1;
// $row = mysqli_fetch_assoc()
// [
// 	'id'=>234
// ]

// $user = new User($row);