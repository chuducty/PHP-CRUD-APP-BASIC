<?php 
	$pass = '8997';
	$salt = "123456789HGngjTYUkLDFVBCnQ";
	$f = "$2y$10$";
	echo "Length: ". strlen($salt);
	$fh = $f.$salt;
	$hash = crypt($pass,$fh);
	echo "<br>";
	echo $hash;
	$hash2 = crypt('8997','$2y$10$123456789HGngjTYUkLDFOg0jEyL51nLOP6.B6PW.lIvdwoDgVJLa');
	echo "<br>";
	echo $hash2;


?>