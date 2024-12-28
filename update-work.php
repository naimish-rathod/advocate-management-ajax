<?php
include 'connection.php';

extract($_POST);
// var_dump($_POST);
// var_dump($_FILES);

// array for store the path of multiple files 
    $allPath = [];

// Check if files were uploaded
    if (!empty($_FILES["file"]["name"][0])) {
        foreach ($_FILES["file"]["name"] as $key => $fileName) {

        	// this is path for specific case id and  this is for id no directory(folder) then it is created
        	$path = "documents/"."case id ".$case_id."/" ;
        	// this is the path there file is write 
        	$folder = $path.$fileName;

            $tempName = $_FILES["file"]["tmp_name"][$key];

            // check that the folder is exist if not exist then make the folder
            if(!is_dir($path)) {
            	if(mkdir($path, 0777, true)){
            		echo "made";
            	}
            }
            // Upload the file to the specified folder
            if (move_uploaded_file($tempName, $folder)) {
                echo "File uploaded successfully: " . $fileName . "<br>";
                $allPath[] = $folder;
            } else {
                echo "Failed to upload file: " . $fileName . "<br>";
            }   
        }
    } else {
        echo "No files uploaded.";
    }
//concat the all the path with comma separate format using implode 
    $storeAllPath = implode(",", $allPath);

// Update the database
    $stmt = $conn->prepare("UPDATE `work-data` SET `status` = ?, `case_cls_desc` = ?, `document` = ? WHERE `case_id` = ?");
    $stmt->bind_param("sssi", $option, $case_cls_desc, $storeAllPath, $case_id);
    $stmt->execute();

if ($stmt) {
    echo "updated";
} 
?>
