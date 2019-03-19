<?php
require_once('ActiveRecord.class.php');
class User extends ActiveRecord
{

	public static $databaseTable = 'users';
	public static $idColumn = 'id';
	public static $columnNames = [
		'id',
		'email',
		'pass',
		'login'
	];

	public function isNauczyciel()
	{
		$teachers = DB::i()->select([
			'select'=> '*',
			'from'=> Teacher::$databaseTable,
			'where'=> [
				['id_konta=?', $this->id]
			]
		]);
        if (count($teachers)) {
            return $teachers[0]['id'];
        }
        return false;
	}

	public function isUczen()
	{
		$students = DB::i()->select([
			'select'=> '*',
			'from'=> Student::$databaseTable,
			'where'=> [
				['id_konta=?', $this->id]
			]
		]);
		if ($students) {
			return true;
		} else {
			return false;
		}
	}

	public static function loggedIn() {
		if (array_key_exists('user', $_SESSION)) {
			return $_SESSION['user'];
		} else {
			return null;
		}
	}

	public static function getPermissionMap($user = false) {
		if ($user === false) {
			$user = User::loggedIn();
		}
		$p = [];
		 $user ? $p[] = 'u' : $p[] = 'g';
		 $user && $user->isUczen() ? $p[] = 's':null;
		 $user && $user->isNauczyciel() ? $p[] = 't':null;
		 return $p;
	}

	public static function login($login, $password) {
		$accounts = DB::i()->select([
			'select'=> '*',
			'from'=> static::$databaseTable,
			'where'=> [
				['login=?', $login],
				['pass=?', $password]
			]
		]);
		if ($accounts==null) {
			return null;
		} else {
			$user = new User($accounts[0]);
			$_SESSION['user'] = $user;
			return $user;
		}
	}

	public static function logout() {
		$_SESSION['user'] = null;
		session_destroy();
	}
}


// $query select * from user where id=1;
// $row = mysqli_fetch_assoc()
// [
// 	'id'=>234
// ]

// $user = new User($row);
