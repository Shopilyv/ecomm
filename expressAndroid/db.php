<?php 
$conn= mysqli_connect("localhost", "queensclassy", "WorthBil2030","queensclassy");
	///check if connection failed and show output
	if (!$conn) {
		# code...
		echo "Connection could not be made".mysqli_error($conn);
	}
?>