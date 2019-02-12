<?php
/**
 * 
 */
class Module_marks 
{
	public $c;

	public function __construct($c)
	{
		$this->c = $c;
	}
	
	public function subjectsList()
	{
		$query = "select * from przedmiot";
		$subjects = [];
		$res = mysqli_query($c,$query);
		while ($row = mysqli_fetch_array($res)) {
			$subjects = $row['nazwa'];
		}
		print_r($subjects);
	}

	public function render()
	{
		$query = "select * from przedmiot";
		$subjects = [];
		$res = mysqli_query($this->c,$query);
		while ($row = mysqli_fetch_array($res)) {
			$subjects = $row['nazwa'];
		}
		print_r($subjects);
	}
}


?>