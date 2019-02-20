<?php

require_once('ActiveRecord.class.php');

class Mark extends ActiveRecord {
	public static $databaseTable = 'oceny';
	public static $idColumn = 'id';
	public static $columnNames = [
		'id',
		'ocena',
		'id_nauczyciela',
		'id_przedmiotu',
		'id_ucznia',
	];
}