<?php include("../includes/layouts/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/layouts/header.php"); ?>


<?php 
	if (isset($_GET['restaurant'])){
		
		$res_id = $_GET['restaurant'];
	}
	else{
		
		redirect_to('manage_res.php');
	}
	if ($_SESSION['username']!= null && editable($_SESSION['username'],$res_id)){
		echo "<div class='col-sm-12'><a href='new_menu_item.php?restaurant={$res_id}'>Click to add menu item</a></div>";
	}
	

	$menu = get_menu_by_res_id($res_id);
	while ($menu_item = mysqli_fetch_assoc($menu)){
		display_menu($menu_item);
	}
	
?>




<?php include("../includes/layouts/footer.php"); ?>