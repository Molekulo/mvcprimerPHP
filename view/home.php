<?php
echo "Welcome " . App\Session::get('user') . "<br>";
?>
<a href="index.php?page=search&q="><button>Pretrazite</button></a>
<a href="index.php?page=logout"><button>Odjavite se</button></a>