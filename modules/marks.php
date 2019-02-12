<?php

class Module_marks 
{
	public $c;

	public function __construct($c)
	{
		$this->c = $c;
	}
	
	public function subjectsNames()
	{
		$query = "select nazwa from przedmiot";
		$subjects = [];
		$res = mysqli_query($this->c,$query);
		while ($row = mysqli_fetch_array($res)) {
			array_push($subjects, $row['nazwa']);
		}
		return print_r($subjects, 1);
	}

	public function subjectsIds()
	{
		$query = "select id from przedmiot";
		$ids = [];
		$res = mysqli_query($this->c,$query);
		while ($row = mysqli_fetch_array($res)) {
			array_push($ids, $row['id']);
		}
		return print_r($ids, 1);
	}
	
	public function studentMarks()
	{
		# code...
	}

	public function render()
	{
		$output = $this->subjectsNames();
		

		return $output;
	}
}



?>