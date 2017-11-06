<?php
namespace App;

class Model
{
	public static function execute($method, $param1 = null, $param2 = null, $param3 = null)
	{
		$conn = Database::connect();
		$row = $conn->query(static::$method($param1, $param2, $param3));
		return $row;
	}
}