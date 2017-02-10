<?php include("../includes/layouts/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/layouts/header.php"); ?>

<?php 
	$username = '';
	$password = '';
	
	$errors = array();
	
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		$username = get_input($_POST['username']);
		$password = get_input($_POST['password']);
		
		$admin = attempt_login($username,$password);
		if ($admin){
			$_SESSION['username'] = $admin['username'];
			redirect_to('homepage.php');
		}
		else{
			$errors['login'] ="Username or password not correct";
		}
		
	}

?>

<div class="container">
	<p class="error"><?php echo array_key_exists('login',$errors) ? $errors['login']:'' ?></p>
</div>
<div class="container">

  <form class="form-horizontal" method='post'>
        <fieldset>
        	<legend>Sign in</legend>
        	
        	<div class="form-group">
        		<label for="username" class="control-label col-sm-3"><strong>User Name:</strong></label>
        		<div class="col-sm-3">	
        			<input type="text" name="username" id="username" placeholder="Enter your email here:" class="form-control" value="<?php echo $username ?>">
        		</div>
        		
        		<div class="col-sm-3">
        				<p class="error"><?php echo array_key_exists('username',$errors) ? $errors['username']:'' ?></p>
        		</div>
        	</div>
        	<div class="form-group">
        		<label for="password" class="control-label col-sm-3"><strong>Password:</strong></label>
        		<div class="col-sm-3">
        			<input type="password" name="password" id="passowrd" placeholder="Enter your password here:" class="form-control">
        		</div>
        		<div class="col-sm-3">
        				<p class="error"><?php echo array_key_exists('password',$errors) ? $errors['password']:'' ?></p>
        		</div>
        	</div>
        	
        	<div class="form-group">
        		<div class="col-sm-offset-4 col-sm-2">
        			<button class="btn btn-primary btn-block">Submit</button>
        		</div>
        	</div>

        </fieldset>
  </form>

</div>
<?php include("../includes/layouts/footer.php"); ?>