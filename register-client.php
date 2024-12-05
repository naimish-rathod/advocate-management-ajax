<?php

include 'connection.php';

extract($_GET);

// print_r($_GET);

$stmt = $conn->prepare("INSERT INTO `work-data`(`id`, `client-name`, `case-type`, `case-desc`) VALUES(?, ?, ?, ?)");
$stmt->bind_param("isss",$employeeId, $cname, $ctype, $cdesc);
$stmt->execute();

if($stmt){
	header("location: index.php");
}
?>