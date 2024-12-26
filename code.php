<?php
// this file is use for perform operation like delete update and insert using where clause and logic
include 'connection.php';
$id  = $_POST['tempId'];
$status = "approved";
// For delete the temparary user
	if(isset($_POST['check-for-delete'])){
		$stmt = $conn->prepare("DELETE FROM `temp_user` WHERE `id` = ?");
		$stmt->bind_param("i", $id);
		$stmt->execute();
	}
//For insert temp user into main advocate data 
	if(isset($_POST['check-for-per-insert'])){
		$stmt = $conn->prepare("SELECT * FROM `temp_user` WHERE `id` = ?");
		$stmt->bind_param("i", $id);
		$stmt->execute();
		if($stmt) {
			$stmtRes = $stmt->get_result();

			if($stmtRes->num_rows > 0) {
				$temp = $stmtRes->fetch_assoc();
			}
		}
		$reg = $conn->prepare("INSERT INTO `all-adv`(`id`, `pwd`, `name`, `edu`, `exp`, `work`, `available`, `user_img_src`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
		$reg->bind_param("isssssss", $temp['id'], $temp['pwd'], $temp['name'], $temp['edu'], $temp['exp'], $temp['work'], $temp['available'], $temp['user_img_src']);
		$reg->execute();

		if($reg) {
			$updateTemp = $conn->prepare("UPDATE `temp_user` SET `status`= ? WHERE `id`= ?");
			$updateTemp->bind_param("si", $status, $id );
			$updateTemp->execute();
		}
	}
?>