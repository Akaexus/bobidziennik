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
		$res = mysqli_query($this->c,$query);
		while ($row = mysqli_fetch_array($res)) {
			$subjects = $row['nazwa'];
		}
		return print_r($subjects, 1);
	}

	public function render()
	{
		$output = $this->subjectsList();
		return $output;
	}
}


?>