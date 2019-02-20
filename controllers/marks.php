<?php

class Marks extends Controller
{

	
	public function subjectsNames()
	{
		$subjects = DB::i()->select('select id,nazwa from przedmiot');
		Output::i()->add(print_r($subjects, 1));
	}

	public function subjectsIds()
	{
		$ids = DB::i()->select('select id from przedmiot');
		Output::i()->add(print_r($ids, 1));
	}
	
	public function studentMarks()
	{
		$output = $this->subjectsNames();
		$marks = DB::i()->select('select ocena from oceny where id_przedmiotu='.$this->subjects[id]);
	}

	public function execute()
	{

		$output = $this->subjectsNames();

		Output::i()->add($output);
	}
}



?>