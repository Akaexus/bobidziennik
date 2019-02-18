<?php
/**
 */
 // * 
class User
{
	public $id;
	public $mail;
	public $pass;
	public $login;
	function __construct($data)
	{
		$this->id = $data['id'];
		$this->email = $data['email'];
		$this->pass = $data['pass'];
		$this->login = $data['login'];
	}

	public function isNauczyciel($data)
	{
		$teachers = DB::i()->select("SELECT * from nauczyciele where id_konta=$this->id");
		if ($teachers) {
			return true;
		} else {
			return false;
		}
	}
	public function isUczen($data)
	{
		$students = DB::i()->select("SELECT * from uczen where id_konta=$this->id");
		if ($students) {
			return true;
		} else {
			return false;
		}
	}

	public static function load($id) {
		global $c;
		$user = $this->select('select * from users where id='.$id);
		
		if (mysqli_num_rows($user)) {
			return new User($user[0]);
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