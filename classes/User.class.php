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
		global $c;
		$query = mysqli_query($c,"SELECT * from nauczyciele where id_konta=$this->id");
		if (mysqli_num_rows($query)>0) {
			return true;
		}
	}
	public function isUczen($data)
	{
		global $c;
		$query = mysqli_query($c,"SELECT * from uczen where id_konta=$this->id");
		if (mysqli_num_rows($query)>0) {
			return true;
		}
	}

	public static function load($id) {
		global $c;
		$query = $c->query('select * from users where id='.$id);
		if (mysqli_num_rows($query)) {
			return new User($query->fetch_assoc());
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