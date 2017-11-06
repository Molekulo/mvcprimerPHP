<h1>Pretraga po email adresi ili po korisnickom imenu</h1>
<form method="GET" action="">
	<input type="" name="page" value='search' hidden="true">
	Pretrazite email ili username : <input type="text" name="q">
	<input type="submit">
</form>
Rezultati:<br>
<?php
if ($row->num_rows == 0) {
	echo "Nema rezultata za pojam $q";
} else {
	while ($red = $row->fetch_object()) {
		if ($red->username == $q) {
			echo "Postoji korisnik sa imenom {$q} i koji ima email adresu $red->email<br>";
		}
		if ($red->email == $q) {
			echo "Postoji email adresa sa imenom {$q} i koji ima korisnicko ime $red->username<br>";
		}
	}
}
?><br>
<a href="index.php?page=home"><button>Idite na pocetnu stranu</button></a>
<a href="index.php?page=logout"><button>Odjavite se</button></a>