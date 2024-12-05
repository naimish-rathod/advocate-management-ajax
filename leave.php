<?php

include 'connection.php';

extract($_GET);
//set time zone
date_default_timezone_set('Asia/Kolkata');  
//set time format and store in var
$curtime = date('Y-m-d H:i:s');


$stmt=$conn->prepare("UPDATE `attendance` SET `quit`=? WHERE id = ?");
$stmt->bind_param("si", $curtime, $id);
$stmt->execute();

if($stmt) {
	header("location: user-index.php");
}

?>