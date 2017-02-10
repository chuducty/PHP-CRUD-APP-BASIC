<?php include("../includes/layouts/session.php"); ?>
<?php require_once("../includes/db_connection.php") ?>
<?php require_once("../includes/functions.php") ?>


<?php require_once("../includes/layouts/header.php"); ?>

<div class="container"> <h1>Welcome: <?php echo $_SESSION['username'];  ?></h1></div>
<div class="container">
  <div></div>
</div>



<?php require_once("../includes/layouts/footer.php"); ?>
<?php
  // 5. Close database connection
  
  mysqli_close($conn);
?>
