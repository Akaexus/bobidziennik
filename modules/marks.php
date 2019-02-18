<?php

class Module_marks 
{

	
	public function subjectsNames()
	{
		$subjects = DB::i()->select('select nazwa from przedmiot');
		return print_r($subjects, 1);
	}

	public function subjectsIds()
	{
		$ids = DB::i()->select('select id from przedmiot');
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