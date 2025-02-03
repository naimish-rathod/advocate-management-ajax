 <?php
// this file is used for the select/retrive the information from the database table 
 session_start();
include 'connection.php';
$statuss = "pending"; 
$curdate = date('Y-m-d'); 
if(isset($_SESSION['user_uname']){
    $user = $_SESSION['user_uname'];
}
//Get temp_user table data
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
//Get all-adv table data
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
//Get the total number of cases(record in the table)
    if (isset($_GET['total_cases'])) {
        
        $stmt = $conn->prepare("SELECT count(`case_id`) AS total_cases FROM `work-data`");
        $stmt->execute();
        $stmtRes = $stmt->get_result();
        $row = $stmtRes->fetch_assoc();

        echo $row['total_cases'];

    }
//Find the count of today's case
    if(isset($_GET['present_cases'])) {
        $cases=$conn->prepare("SELECT * FROM `work-data` WHERE DATE(`created_at`) = ?");
        $cases->bind_param("s",$curdate);
        $cases->execute();
        $cases->store_result();
        $present_cases = 0;
        if ($cases->num_rows >= 0) {
            $present_cases = $cases->num_rows;
            echo $present_cases;
        }       
    }
//Find the count of today available employee
    if(isset($_GET['today_emp'])) {
        $quit = "0000-00-00 00:00:00";
        $attend=$conn->prepare("SELECT * FROM `attendance` WHERE DATE(`entry`) = ? AND DATE(`quit`) = ?");
        $attend->bind_param("ss",$curdate,$quit);
        $attend->execute();
        $attend->store_result();
        $present_emp = 0;
            if($attend->num_rows >= 0){
                $present_emp=$attend->num_rows;
                echo $present_emp;
            }
    }
//Featch user work data from the work-data table
    if (isset($_GET['user_case'])){ 
        $qryWork = "SELECT * FROM `work-data` WHERE id = ?";
        $stmtWork = $conn->prepare($qryWork);
        $stmtWork->bind_param("i", $user);
        $stmtWork->execute();
        $resWork = $stmtWork->get_result();

        $result_arr_case = [];

        if($resWork-> num_rows>0) {
            while($workData = $resWork->fetch_assoc()){
                $result_arr_case[] = $workData;
            }
            header('Content-type: application/json');
            echo json_encode($result_arr_case);
        }else {
            echo json_encode([]);
        }
    }
?>
