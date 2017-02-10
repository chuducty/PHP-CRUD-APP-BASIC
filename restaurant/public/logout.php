<?php include("../includes/layouts/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>


<?php
	$_SESSION['username'] = null;
	redirect_to('homepage.php');



?>