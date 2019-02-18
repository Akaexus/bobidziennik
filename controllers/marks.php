<?php

class Marks implements Controller
{

	
	public function subjectsNames()
	{
		$subjects = DB::i()->select('select id,nazwa from przedmiot');
		return print_r($subjects, 1);
	}

	public function subjectsIds()
	{
		$ids = DB::i()->select('select id from przedmiot');
		return print_r($ids, 1);
	}
	
	public function studentMarks()
	{
		$output = $this->subjectsNames();
		$marks = DB::i()->select('select ocena from oceny where id_przedmiotu='.$this->subjects[id]);
	}

	public function render()
	{

		$output = $this->subjectsNames();

		return $output;
	}
}



?>