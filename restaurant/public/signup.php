<?php include("../includes/layouts/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/layouts/header.php"); ?>

	<?php 
		$username = '';
		$password = '';
		$email = '';
		$errors = array();
		
		function valid_username($input){
			return $input and preg_match("^[a-zA-Z0-9_-]{3,20}$^", $input);
		}
		function valid_email($input){
			return $input and filter_var($input,FILTER_VALIDATE_EMAIL);
		}
		function valid_password($input){
			return strlen($input) >= 8;
		}
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			$username = get_input($_POST['username']);
			$password = get_input($_POST['password']);
			$email = get_input($_POST['email']);
			$password = password_encrypt($password);
			if (!valid_username($username)){
				$errors['username'] = 'Invalid username. Char and Num ony plz.';
			}
			if (!valid_email($email)){
				$errors['email'] = 'Invalid email,check your email again plz';
			}
			if (!valid_password($password)){
				$errors['password'] = 'Minimum 8 character password please';
			}
			if (empty($errors) && add_new_admin($username,$password,$email)){
				redirect_to('homepage.php');

			}
			else{
				echo 'Please Sign in <br>';
			}
		}

	?>


<div class="container">

  <form class="form-horizontal" method='post'>
        <fieldset>
        	<legend>Sign up</legend>
        	
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
        		<label for="email" class="control-label col-sm-3"><strong>Email:</strong></label>
        		<div class="col-sm-3">
        			<input type="text" name="email" id="email" placeholder="Enter your email here:" class="form-control" value="<?php echo $email ?>">
        		</div>
        		<div class="col-sm-3">
        				<p class="error"><?php echo array_key_exists('email',$errors) ? $errors['email']:'' ?></p>
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