<?php include 'header.php'; ?>
<!-- ============================== html block start ============================== -->
<?php
// Prepare the SQL query to fetch completed cases
$comp = $conn->prepare("SELECT * FROM `work-data` WHERE DATE(`created_at`) = ?");
$comp->bind_param("s",$curdate ); //$curdate var is from header.php
$comp->execute();
$compRes = $comp->get_result();

if ($compRes->num_rows > 0) {
    $rows = $compRes->fetch_all(MYSQLI_ASSOC); // Fetch all rows as an associative array
} else {
    $rows = []; // Empty array if no data is found
}
?>

	<div class="thirteen mt-5">
	  <h1>Today's cases</h1>
	</div>
<div class="container mt-5">
    <table class="table table-bordered">
        <thead >
            <tr>
                <th class="table-head-col">Case ID</th>
                <th class="table-head-col">Employee ID</th>
                <th class="table-head-col">Client Name</th>
                <th class="table-head-col">Case Type</th>
                <th class="table-head-col">Case Description</th>
                <th class="table-head-col">Status</th>
                <th class="table-head-col">Case Date</th>
                <th class="table-head-col">Case Close Description</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($rows)) { ?>
                <?php foreach ($rows as $row) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['case_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['client-name']); ?></td>
                        <td><?php echo htmlspecialchars($row['case-type']); ?></td>
                        <td><?php echo htmlspecialchars($row['case-desc']); ?></td>
                        <td><?php echo htmlspecialchars($row['status']); ?></td>
                        <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                        <td><?php echo htmlspecialchars($row['case_cls_desc']); ?></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="8" class="text-center">No cases registered today</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
