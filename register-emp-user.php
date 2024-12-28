<?php
include 'connection.php';

session_start();
// Extract POST data
extract($_POST);

// Handle file upload
$fileName = $_FILES["profile"]["name"];
$tempName = $_FILES["profile"]["tmp_name"];
$folder = "user-dp/" . $fileName;

if ($_FILES["profile"]["error"] === UPLOAD_ERR_OK) {
    if (!move_uploaded_file($tempName, $folder)) {
        echo "Failed to move the uploaded file.";
        exit;
    }
} else {
    echo "Error uploading file: " . $_FILES["profile"]["error"];
    exit;
}
// change the format of the time 
$inTime = DateTime::createFromFormat('H:i', $availableIn);
$outTime = DateTime::createFromFormat('H:i', $availableOut);

$inTimeAvl = $inTime->format('h:i A');
$outTimeAvl = $outTime->format('h:i A');
$available = $inTimeAvl . " To " . $outTimeAvl;

// Insert record
$stmt = $conn->prepare("INSERT INTO `temp_user`(`pwd`, `name`, `edu`, `exp`, `work`, `available`, `user_img_src`) VALUES (?,?,?,?,?,?,?)");
$stmt->bind_param("sssssss", $pwd, $name, $edu, $exp, $work, $available, $folder);
$stmt->execute();
?>

