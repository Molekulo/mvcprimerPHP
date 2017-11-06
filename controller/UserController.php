<?php
namespace App;

class UserController extends Controller
{
	public static function index()
	{
		if (isset($_GET['page'])) {
			$method = $_GET['page'];
		} else {
			$method = 'home';
		}

		if (isset($_GET['q'])) {
			$q = $_GET['q'];
		} else {
			$q = null;
		}
		
		if (method_exists("App\UserController", $method)) {
			static::$method($q);
		} else {
			static::home();
		}
	}

	public static function home()
	{
		if (static::checkUser()) {
			include "view/home.php";
		} else {
			echo "<h1>Morate da se ulogujete da biste videli pocetnu stranicu!</h1><br>";
			static::login();
		}	 
	}

	public static function login()
	{
		if (static::checkUser()) {
			echo "<h1>Prijavite se!</h1><br>";
			static::home();
		} else {
			include "view/login.php";
			if ($_POST) {
				$user = $_POST['user'];
				$pass = sha1($_POST['pass']);
				Session::start();
				$getUser = UserModel::execute('getUser', $user);
				$getPass = UserModel::execute('getPass', $pass);
				if ($getUser->num_rows == 1 && $getPass->num_rows == 1 ) {
					Session::set('user', $user);
					header("Location: index.php?page=home");
				} else {
					echo "Korisnicko ime ili sifra nisu tacni!";
				}
			}
		}
	}

	public static function logout()
	{
		if (static::checkUser()) {
			Session::delete('user');
			echo "<h1>Uspesno ste se odjavili!</h1><br>";
		} else {
			echo "<h1>Prijavite se</h1><br>";
		}
		static::login();
	}

	public static function register()
	{
		if (static::checkUser()) {
			echo "<h1>Vec ste se registrovali</h1><br>";
			static::home();
		} else {
			echo "<h1>Registrujte se</h1><br>";
			include "view/register.php";
			if ($_POST) {
				$user = $_POST['user'];
				$email = $_POST['email'];
				$pass = sha1($_POST['pass']);
				if ( $user == '' || $email == '' || $pass =='') {
					echo "Morate uneti sva polja!";
				} else {
					$registerUser = UserModel::execute('registerUser', $user, $email, $pass);
					if ($registerUser) {
						echo "Uspesna registracija! Mozete da se logujete";
					} else {
						echo "Greska, neuspesna registracija";
					}
				}
			}
		}
	}

	public static function search($q)
	{
		if (static::checkUser()) {
			$row = UserModel::execute('search', $q);
			include "view/result.php";
		} else {
			echo "<h1>Morate da se ulogujete da biste videli rezultate</h1><br>";
			static::login();
		}	
	}
}