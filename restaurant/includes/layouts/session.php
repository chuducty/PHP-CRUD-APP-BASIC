<?php

	session_start();
	if  (!isset($_SESSION['username'])){
		$_SESSION['username'] = null;
	}
	function message() {
		if (isset($_SESSION["message"])) {
			$output = "<div class=\"message\">";
			$output .= htmlentities($_SESSION["message"]);
			$output .= "</div>";
			
			// clear message after use
			$_SESSION["message"] = null;
			
			return $output;
		}
	}
	
?>