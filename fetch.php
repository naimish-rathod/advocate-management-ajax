<?php

include 'connection.php';
$statuss = "pending";   

// Prepare and execute the SQL query
$tempUser = $conn->prepare("SELECT * FROM `temp_user` WHERE `status` = ?");
$tempUser->bind_param("s", $statuss);
$tempUser->execute();
$tempUserRes = $tempUser->get_result();

$result_array = [];

if ($tempUserRes->num_rows > 0) {
     
    while ($row = $tempUserRes->fetch_assoc()) {
        $result_array[] = $row; // Add the entire row to the result array
    }

    // Output the result as JSON
    header('Content-type: application/json');
    echo json_encode($result_array);
} else {
    echo json_encode([]);
}

?>
