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

	$menu_item_name_ = '';
	$description = '';
	$type = '';
	$errors = array();
	
	
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		$menu_item_name = get_input($_POST['menu_item_name']);
		$description = get_input($_POST['description']);
		$type = get_input($_POST['type']);
		
		if ($menu_item_name == ''){
			$errors['menu_item_name'] = 'Menu Item name cannot be null';
		}
		if ($description == ''){
			$errors['description'] = 'Description cannot be null';
		}
		if ($type == ''){
			$errors['type'] = 'Type cannot be null mAN!!';
		}
		if (empty($errors) && add_new_menu_item($menu_item_name,$type,$description,$res_id)){
			redirect_to("manage_menu.php?restaurant={$res_id}");
		}
		else{
			echo 'erroessss';
		}
		
	}

?>

<div class="container">

  <form class="form-horizontal" method="post">
        <fieldset>
        	<legend>New Menu Item</legend>
        	
        	<div class="form-group">
        		<label for="email" class="control-label col-sm-3"><strong>Menu Item Name:</strong></label>
        		<div class="col-sm-4">	
        			<input type="text" name="menu_item_name" id="menu_item_name" placeholder="Enter your Menu Item Name here:" class="form-control">
        		</div>
        		<div class="col-sm-2 error"><?php echo array_key_exists('menu_item_name',$errors)?$errors['menu_item_name']:'' ?></div>
        	</div>
        	<div class="form-group">
        		<label for="email" class="control-label col-sm-3"><strong>Type:</strong></label>
        		<div class="col-sm-4">	
        			<input type="text" name="type" id="menu_type" placeholder="Enter your Type here:" class="form-control">
        		</div>
        		<div class="col-sm-2 error"><?php echo array_key_exists('type',$errors)?$errors['type']:'' ?></div>
        	</div>
        	<div class="form-group">
        		<label for="password" class="control-label col-sm-3"><strong>Description:</strong></label>
        		<div class="col-sm-4">
        			<textarea name="description" id="description" placeholder="Enter your description here:" class="form-control" rows="10"></textarea>
        		</div>
        		<div class="col-sm-2 error"><?php echo array_key_exists('description',$errors)?$errors['description']:'' ?></div>
        	</div>
        	<div class="form-group">
        		<div class="col-sm-offset-5 col-sm-2">
        			<button class="btn btn-primary btn-block">Submit</button>
        		</div>
        		
        	</div>
        </fieldset>
  </form>

</div>



<?php include("../includes/layouts/footer.php"); ?>