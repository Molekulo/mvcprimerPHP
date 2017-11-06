<?php
namespace App;

class Controller
{
	public static function checkUser()
	{
		Session::start();
		if (Session::get('user')) {
			return true;
		} else {
			return false;
		}
	}
}