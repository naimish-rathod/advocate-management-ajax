<?php

include "connection.php";

extract($_GET);


// echo $name;

$curdate = date('Y-m-d');


$stmt= $conn->prepare("SELECT id FROM `attendance` WHERE `id` = ? AND DATE(`entry`) = ?");
$stmt->bind_param("is", $id, $curdate);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows>0) {
	header("location: user-index.php");
}else {

	$stmt=$conn->prepare("INSERT INTO `attendance` (`id`, `name`) VALUES(?,?)");

	$stmt->bind_param("is", $id, $name);
	$stmt->execute();

	if ($stmt) {
		header("location: user-index.php");
	}
}

?>