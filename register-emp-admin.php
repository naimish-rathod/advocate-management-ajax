<?php
include 'connection.php';

extract($_POST);
$fileName = $_FILES["profile"]["name"];
$tempName = $_FILES["profile"]["tmp_name"];

$folder = "user-dp/".$fileName;

$temp = $conn->prepare("SELECT COALESCE(MAX(id), 0) + 1 AS next_id FROM temp_user");
if (!$temp) {
    die("Prepare failed: " . $conn->error);
}
$temp->execute();
$result = $temp->get_result();

// Retrieve the next ID
$next_id = null;
if ($row = $result->fetch_assoc()) {
    $next_id = $row['next_id'];
}

$stmt = $conn->prepare("INSERT INTO `all-adv`(`id`, `pwd`, `name`, `edu`, `exp`, `work`, `available`, `user_img_src`) VALUES (?,?,?,?,?,?,?,?)");
$stmt->bind_param("isssssss", $next_id, $pwd, $name, $edu, $exp, $work, $available, $folder );
$stmt->execute();

if ($stmt) {
	header("location: index.php");
}

if ($_FILES["profile"]["error"] === UPLOAD_ERR_OK) {
	    if (move_uploaded_file($tempName, $folder)) {
	         
	    } else {
	         
	    }
	} else {
	    echo "Error uploading file: " . $_FILES["profile"]["error"];
	}


?>