<?php include 'header.php';  

// Prepare the SQL query to fetch completed cases
$comp = $conn->prepare("SELECT
                *
            FROM
                `all-adv`
            INNER JOIN `attendance` ON `attendance`.`id` = `all-adv`.`id`
            WHERE
                DATE(`attendance`.`entry`) = ?");

$comp->bind_param("s",$curdate ); //$curdate var is from header.php
$comp->execute();
$compRes = $comp->get_result();

if ($compRes->num_rows > 0) {
    $rows = $compRes->fetch_all(MYSQLI_ASSOC); // Fetch all rows as an associative array
} else {
    $rows = []; // Empty array if no data is found
}
?>

	<div class="thirteen emp-head mt-5">
	  <h1>Available employee</h1>
	</div>
<div class="container mt-5">
    <table class="table table-bordered">
        <thead class="text-center">
            <tr>
                <th class="table-head-col">Profile</th>
                <th class="table-head-col">ID</th>
                <th class="table-head-col">Password</th>
                <th class="table-head-col">Emp Name</th>
                <th class="table-head-col">Education</th>
                <th class="table-head-col">Experiance</th>
                <th class="table-head-col">Work</th>
                <th class="table-head-col">Available</th>
                <th class="table-head-col">Entry time</th>
                <th class="table-head-col">Exit time</th>
            </tr>
        </thead>
        <tbody class="text-valign text-center">
            <?php if (!empty($rows)) { ?>
                <?php foreach ($rows as $row) { ?>
                    <tr>
                        <td><img alt="profile" src="<?php echo htmlspecialchars($row['user_img_src']); ?>" class="user-img-tab"></td>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['pwd']); ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['edu']); ?></td>
                        <td><?php echo htmlspecialchars($row['exp']); ?></td>
                        <td><?php echo htmlspecialchars($row['work']); ?></td>
                        <td><?php echo htmlspecialchars($row['available']); ?></td>
                        <td><?php echo htmlspecialchars($row['entry']); ?></td>
                        <td><?php echo htmlspecialchars($row['quit']); ?></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="10" class="text-center">No employee available today</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
