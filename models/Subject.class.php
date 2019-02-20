<?php

require_once('ActiveRecord.class.php');

class Subject extends ActiveRecord {
	public static $databaseTable = 'oceny';
	public static $idColumn = 'id';
	public static $columnNames = [
		'id',
		'nazwa'
	];
}