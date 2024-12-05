<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include 'connection.php';

if (isset($_POST['uname']) && isset($_POST['pwd'])) {
    $uname = $_POST['uname'];
    $pwd = $_POST['pwd'];
    
    /* ===============================
            check for admin 
    ==================================*/
    $qry = "SELECT * FROM `adv-nr` WHERE `uname` = ? AND `pwd` = ?";
    $stmt = $conn->prepare($qry);

    if ($stmt) {
        $stmt->bind_param("ss", $uname, $pwd);
        $stmt->execute();
        
        $result = $stmt->get_result();  

        if ($result->num_rows > 0) {
            $_SESSION['uname'] = $uname;  
            header("Location: index.php");  
            exit(); 
        }
        
        $stmt->close();
    }  

    /* ===============================
            check for user 
    ==================================*/
    $qryUser  = "SELECT * FROM `all-adv` WHERE `id`=? AND `pwd`=?";
    $stmtUser  = $conn->prepare($qryUser );

    if($stmtUser ) {
        $stmtUser ->bind_param("ss", $uname, $pwd);
        $stmtUser ->execute();

        $resultUser  = $stmtUser ->get_result();

        if($resultUser ->num_rows > 0){
            $_SESSION['user_uname'] = $uname; // Set session variable for user
            header("Location: user-index.php");
            exit();
        }
    }
    
    // If both checks fail, redirect to login
    header("Location: login.php");
    exit();
}
?>