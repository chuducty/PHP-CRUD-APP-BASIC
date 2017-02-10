<?php include("../includes/layouts/session.php"); ?>
<?php require_once("../includes/db_connection.php") ?>
<?php require_once("../includes/functions.php") ?>


<?php require_once("../includes/layouts/header.php"); ?>


<?php
	if ($_SESSION['username']){
		echo "<div class='col-sm-4'><a href='new_res.php'>Click to create restaurants</a></div>";
	}

?>
<?php
	if (!$restaurants = get_restaurants()){
		echo 'Wrong Query';
	}

	while ($res = mysqli_fetch_assoc($restaurants)){
		display_restaurant($res);
	}

?>




<?php require_once("../includes/layouts/footer.php"); ?>
<?php
  // 5. Close database connection
  
  mysqli_close($conn);
?>
