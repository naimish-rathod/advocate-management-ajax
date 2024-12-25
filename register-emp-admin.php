<?php
include 'connection.php';
// delete
extract($_POST);
$fileName = $_FILES["profile"]["name"];
$tempName = $_FILES["profile"]["tmp_name"];
$folder = "user-dp/".$fileName;

if ($_FILES["profile"]["error"] === UPLOAD_ERR_OK) {
    if (!move_uploaded_file($tempName, $folder)) {
        echo "Failed to move the uploaded file.";
        exit;
    }
} else {
    echo "Error uploading file: " . $_FILES["profile"]["error"];
    exit;
}

$temp = $conn->prepare("SELECT COALESCE(MAX(id), 0) AS next_id FROM temp_user");
if (!$temp) {
    die("Prepare failed: " . $conn->error);
}
$temp->execute();
$result = $temp->get_result();

// Retrieve the next ID
$next_id = null;
if ($row = $result->fetch_assoc()) {
    $next_id = $row['next_id'] + 1;
}

$inTime = DateTime::createFromFormat('H:i', $availableIn);
$outTime = DateTime::createFromFormat('H:i', $availableOut);

$inTimeAvl = $inTime->format('h:i A');
$outTimeAvl = $outTime->format('h:i A');
$available = $inTimeAvl . " To " . $outTimeAvl;

$stmt = $conn->prepare("INSERT INTO `all-adv`(`id`, `pwd`, `name`, `edu`, `exp`, `work`, `available`, `user_img_src`) VALUES (?,?,?,?,?,?,?,?)");
$stmt->bind_param("isssssss", $next_id, $pwd, $name, $edu, $exp, $work, $available, $folder );
$stmt->execute();

if ($stmt) {
	// header("location: index.php");
	echo "Inserted";

}
?>