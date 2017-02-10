<?php 
function get_input($input){
		
	$input = htmlspecialchars($input);
	return escape($input);
}
function redirect_to($location){
	header("Location: ".$location);
	exit;
}

function escape($text){
	global $conn;
	return mysqli_real_escape_string($conn,$text);
}
function get_restaurants(){
	global $conn;
	$query  = "SELECT * ";
	$query .= "FROM restaurant ";
	
	
	$results = mysqli_query($conn, $query);
	// while ($res = mysqli_fetch_assoc($results)){
	// 	var_dump($res);
	// }
	if (!$results){
		return false;
	}	
	return $results;

}
function display_restaurant($res){
	echo "<div class='container text-center'>";
	echo "<h2 class='col-sm-12'>".$res['res_nam	e'].'</h2>';
	echo "<div class='col-sm-12'>".$res['description'].'</div>';
	echo "<div class='col-sm-12'><a href='manage_menu.php?restaurant={$res['id']}'>Click to see their menu</a></div>";
	echo "</div>";
	echo "<hr>";
}
function display_menu($menu_item){
	echo "<div class='container-fluid'>";
	echo "<h2 class='col-sm-12'>".$menu_item['name'].'</h2>';
	echo "<div class='col-sm-12'><i>".$menu_item['type'].'</i></div>';
	echo "<div class='col-sm-12'>".$menu_item['description'].'</div>';
	
	echo "</div>";
	echo "<hr>";
}
function add_new_res($res_name,$description,$username){
	global $conn;
	$query  = "insert into restaurant(res_name,description) ";
	$query .= "values ('{$res_name}','{$description}')";

	if (!mysqli_query($conn,$query)){
		return false;
	}
	$query = "SELECT LAST_INSERT_ID() as lastid";
	$results = mysqli_query($conn,$query);
	if (!$results){
		return false;
	}
	$item = mysqli_fetch_assoc($results);
	$id = $item['lastid'];
	$query  = "insert into editable(username,id) ";
	$query .= "values ('{$username}','{$id}')";
	
	if (!mysqli_query($conn,$query)){
		return false;
	}
	return true;
}
function add_new_menu_item($menu_item_name,$type,$description,$res_id){
	global $conn;
	$query  = "insert into menu_item(name,type,description,res_id) ";
	$query .= "values ('{$menu_item_name}','{$type}','{$description}','{$res_id}')";

	if (mysqli_query($conn,$query)){
		return true;
	}
	return false;
}
function add_new_admin($username,$pass,$email){
	global $conn;
	$query  = "insert into admin(username,h_pass,email) ";
	$query .= "values('{$username}','{$pass}','{$email}')";
	if (mysqli_query($conn,$query)){
		return true;
	}
	return false;
}
function get_menu_by_res_id($res_id){
	global $conn;
	$query  = "select * from menu_item where res_id = {$res_id}";
	$results = mysqli_query($conn, $query);
	if (!$results){
		die('asdasd');
		return false;
	}	
	return $results;

}

function generate_salt($salt_length){
	// temp, i will read the salt algo later;
	return "123456789HGngjTYUkLDFVBCnQ";
}
function password_encrypt($pass){
	$hash_format = "$2y$10$";
	$salt_length = 25;
	$salt = generate_salt($salt_length);
	$format_and_salt = $hash_format . $salt;
	$hash = crypt($pass,$format_and_salt);
	return $hash;
}
function password_check($password,$existing_hash){
	$hash = crypt($password,$existing_hash);
	if ($hash == $existing_hash){
		return true;
	}
	else{
		return false;
	}
}
function attempt_login($username,$pass){
	//var_dump($pass);
	global $conn;
	$query  = "select * from admin where username='{$username}'";
	$result = mysqli_query($conn,$query);

	$admin = mysqli_fetch_assoc($result);
	if ($admin){
		//echo $pass;
		if (password_check($pass,$admin['h_pass'])){

			return $admin;
		}
	}
	return false;

}
function editable($username,$res_id){
	global $conn;
	$query = "select * from editable where username='{$username}'";
	$results = mysqli_query($conn,$query);
	while ($item = mysqli_fetch_assoc($results)){
		if ($item['id'] == $res_id){
			return true;
		}
	}
	return false;
}
?>