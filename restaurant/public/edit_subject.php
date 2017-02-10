<?php include("../includes/layouts/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/layouts/header.php"); ?>
<?php
  if (isset($_GET["subject"])){
    $selected_subject_id = $_GET["subject"];
    $selected_page_id = null;
  } elseif (isset($_GET["page"])){
    $selected_page_id = $_GET["page"];
    $selected_subject_id = null;
  } else{
    $selected_page_id = null;
    $selected_subject_id = null;
  }
  if ($selected_subject_id == null){
  	redirect_to('manage_content.php');
  } 
  
  $current_subject = find_subject_by_id($selected_subject_id);

  if (!$current_subject){
  	redirect_to('manage_content.php');
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST"){
  	//echo 'ahihi';
  	$name = $_POST["menu_name"];
	$position = (int) $_POST["position"];
	$visible = (int) $_POST["visible"];
	if ($name==""){

		$_SESSION['message'] = 'error';
		redirect_to('manage_content.php');	
	}
	if (update_subjects($selected_subject_id,$name,$position,$visible)){
		$_SESSION['message'] = 'Update Successful <3';
		redirect_to('manage_content.php');
		//echo 'ahihi';
	}
	else{
		$_SESSION['message'] = 'fail';
		//redirect_to('manage_content.php');
		//echo 'ahuhu';
	}
  }

?>

<div id="main">
  <div id="navigation">
		<?php require_once("../includes/layouts/navigation.php"); ?>
  </div>
  <div id="page">
  		<?php echo message(); ?>
		<h2>Edit Subject</h2>

		<form action="edit_subject.php?subject=<?php echo $current_subject['id']; ?>" method="post">
		  <p>Menu name:
		    <input type="text" name="menu_name" value="<?php echo $current_subject['menu_name'];  ?>" />
		  </p>
		  <p>Position:
		    <select name="position">
				<?php
					$subject_set = find_all_subjects();
					$subject_count = mysqli_num_rows($subject_set);
					for($count=1; $count <= ($subject_count); $count++) {
						echo "<option ";
						if  ($count == $current_subject['position']){
							echo "selected='selected' ";
						}
						echo "value=\"{$count}\">{$count}</option>";
					}
				?>
		    </select>
		  </p>
		  <p>Visible:
		    <input type="radio" name="visible" value="0" <?php echo $current_subject['visible']== 0 ? "checked":"" ?> /> No
		    &nbsp;
		    <input type="radio" name="visible" value="1" <?php echo $current_subject['visible']== 1 ? "checked":"" ?> /> Yes
		  </p>
		  <input type="submit" value="Edit Subject" name="submit" />
		</form>
		<br />
		<a href="manage_content.php">Cancel</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
