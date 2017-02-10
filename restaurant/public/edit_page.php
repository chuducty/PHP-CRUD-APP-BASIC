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
  
  $current_page = find_page_by_id($selected_page_id);
  if (!cu)

<div id="main">
  <div id="navigation">
		<?php require_once("../includes/layouts/navigation.php"); ?>
  </div>
  <div id="page">
  		<?php echo message(); ?>
		<h1>Edit Page </h1>
		<form method="post" action="edit_page.php">
			<label for="menu_name">Page name</label>
			<input type="text" name="menu_name">
		</form>
	</div>
</div>


<?php include("../includes/layouts/footer.php"); ?>