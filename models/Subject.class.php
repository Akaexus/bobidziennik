<?php

require_once('ActiveRecord.class.php');

class Subject extends ActiveRecord {
	public static $databaseTable = 'przedmiot';
	public static $idColumn = 'id';
	public static $columnNames = [
		'id',
		'nazwa'
	];
}