<?php

require_once('ActiveRecord.class.php');

class Subject extends ActiveRecord {
	public static $databaseTable = 'przedmiot';
	public static $idColumn = 'id';
	public static $columnNames = [
		'id',
		'nazwa'
	];

    public function name() {
        return $this->nazwa;
    }

    public function __toString()
    {
        return $this->nazwa;
    }
}
