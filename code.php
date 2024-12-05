<?php

include 'connection.php';


if(isset($_POST['check-for-delete'])){
	
	$id  = $_POST['tempId'];
	// echo $id;
	$stmt = $conn->prepare("DELETE FROM `temp_user` WHERE `id` = ?");
	$stmt->bind_param("i", $id);
	$stmt->execute();

	if($stmt) {
		// header("location: index.php");
	}
}

?>