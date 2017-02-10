<?php include("../includes/layouts/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/layouts/header.php"); ?>

<?php 
    if ($_SESSION['username']==null){
        redirect_to('signin.php');
    }
	$res_name = '';
	$description = '';
	$errors = array();
	
	
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		$res_name = get_input($_POST['res_name']);
		$description = get_input($_POST['description']);
		
		
		if ($res_name == ''){
			$errors['res_name'] = 'Restaurant name cannot be null';
		}
		if ($description == ''){
			$errors['description'] = 'Description cannot be null';
		}
		if (empty($errors) && add_new_res($res_name,$description,$_SESSION['username'])){
			redirect_to('manage_res.php');
		}
		else{
			echo 'erroessss';
		}
		
	}

	?>


<div class="container">

  <form class="form-horizontal" method="post">
        <fieldset>
        	<legend>New Restaurant</legend>
        	
        	<div class="form-group">
        		<label for="email" class="control-label col-sm-3"><strong>Restaurant Name:</strong></label>
        		<div class="col-sm-4">	
        			<input type="text" name="res_name" id="res_name" placeholder="Enter your Restaurant name here:" class="form-control">
        		</div>
        		<div class="col-sm-2 error"><?php echo array_key_exists('res_name',$errors)?$errors['res_name']:'' ?></div>
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
