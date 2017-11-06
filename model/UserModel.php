<?php
namespace App;

class UserModel extends Model
{
	public static function search($data)
	{
		$query = "SELECT username, email FROM users WHERE username = \"$data\" OR email = \"$data\"";
		return $query;
	}

	public static function getUser($user)
	{
		$query = "SELECT username FROM users WHERE username = \"$user\"";
		return $query;
	}

	public static function getPass($pass)
	{
		$query = "SELECT password FROM users WHERE password = \"$pass\"";
		return $query;
	}

	public static function registerUser($user, $email, $pass)
	{
		$query = "INSERT INTO users (username, email, password) VALUES (\"$user\" , \"$email\", \"$pass\")";
		return $query;
	}
}