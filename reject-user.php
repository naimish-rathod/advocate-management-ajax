<?php

include 'connection.php';

$id  = $_GET['id'];
// echo $id;
$stmt = $conn->prepare("DELETE FROM `temp_user` WHERE `id` = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

if($stmt) {
	header("location: index.php");
}

?>