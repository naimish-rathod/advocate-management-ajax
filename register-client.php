<?php

include 'connection.php';

extract($_POST);
 
$stmt = $conn->prepare("INSERT INTO `work-data`(`id`, `client-name`, `case-type`, `case-desc` ,`email`, `contact`) VALUES(?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issssi",$employeeId, $cname, $ctype, $cdesc, $ceml, $ccont);
$stmt->execute();

echo $cname;
echo $ctype;
echo $cdesc;
if($employeeId) {
	echo $employeeId;
}else{
	echo "id not passing";
}

if($stmt){
	echo "New case";
}
?>
