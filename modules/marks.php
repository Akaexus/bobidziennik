<?php
/**
 * 
 */
class Module_marks 
{
	
	public function subjectsList()
	{
		$this->c = $c;
		$query = "select * from przedmiot";
		$subjects = [];
		$res = mysqli_query($c,$query);
		while ($row = mysqli_fetch_array($res)) {
			$subjects = $row['nazwa'];
		}
		print_r($subjects);
	}
}


?>