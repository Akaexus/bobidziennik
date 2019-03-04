<?php

abstract class ActiveRecord {
	public static $databaseTable;
	public static $idColumn;
	public static $columnNames;
	public $_new = false;
	public function __construct($data) {
		foreach ($data as $key => $value) {
			$this->$key = $value;
		}
	}

	public function getId() {
		$idColumn = static::$idColumn;
		return $this->$idColumn;
	}

	public function save() {
		$idColumn = static::$idColumn;
		$values = [];
		if (!$this->_new) {
			foreach (static::$columnNames as $column) {
				$values[] = $this->$column;
			}
			$query = 'update '.static::$databaseTable.' set ';
			$params = [];
			foreach (static::$columnNames as $column) {
				$params[] = "{$column}='{$this->$column}'";
			}
			$query .= implode(',', $params);
			$query .= ' where '.static::$idColumn.'='.$this->$idColumn;
			DB::i()->query($query);
		} else {
			$values = [];
			foreach (static::$columnNames as $column) {
				$values[$column] = $this->$column;
			}
			DB::i()->insert(static::$databaseTable, $values);
		}
	}

	public static function load($id) {
		$entity = DB::i()->select([
			'select'=> implode(',', static::$columnNames),
			'from'=> static::$databaseTable,
			'where'=> [
				[static::$idColumn.'=?', $id]
			],
			'limit'=> 1
		]);
		// $entity = DB::i()->select("select ".implode(',', static::$columnNames)." from ".static::$databaseTable." where ".static::$idColumn."='{$id}' limit 1");
		if (!$entity) {
			throw new Exception;
		} else {
			$entity = $entity[0];
		}
		$class = get_called_class();
		return new $class($entity);
	}

	public function delete() {
		$idColumn = static::$idColumn;
		DB::i()->query('delete from '.static::$databaseTable.' where '.$idColumn.'='.$this->$idColumn);
	}
}
