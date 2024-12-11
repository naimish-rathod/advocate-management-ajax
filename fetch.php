 
<?php
// this file is used for the select/retrive the information from the database table 
include 'connection.php';
$statuss = "pending";   

if(isset($_GET['tempData'])) {
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
}

if(isset($_GET['perData'])) {
    $emp = $conn->prepare("SELECT * FROM `all-adv`");
    $emp->execute();
    $emp_res=$emp->get_result();

    $result_array_per = [];

    if($emp_res->num_rows > 0) {
        while ($row = $emp_res->fetch_assoc()){
            $result_array_per[] = $row;

        }
        header('Content-type: application/json');
        echo json_encode($result_array_per);
    } else {
        echo json_decode([]);
    }
}

?>
