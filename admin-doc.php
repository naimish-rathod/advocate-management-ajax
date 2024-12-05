<?php include 'header.php'; 

// Fetch advocate names indexed by work-data id
$advName = $conn->prepare("
    SELECT
        `work-data`.`id` AS work_id,
        `all-adv`.`name` AS advocate_name
    FROM
        `all-adv`
    INNER JOIN `work-data` ON `work-data`.`id` = `all-adv`.`id`
");
$advName->execute();
$res = $advName->get_result();

// Store advocate names in an associative array
$advNameD = [];
while ($row = $res->fetch_assoc()) {
    // set the key and value like this 2 = "naimish"
    $advNameD[$row['work_id']] = $row['advocate_name'];
}

?>

<!-- ===========================
         Document Table
=============================== -->
<div class="container mt-5">
    <table class="table table-bordered table-striped">
        <tr>
            <th class="table-head-col">Case id</th>
            <th class="table-head-col">Advocate name</th>
            <th class="table-head-col">Client name</th>
            <th class="table-head-col">Files</th>
        </tr>

        <?php if ($hasWorkData) { ?>
            <?php foreach ($workData as $rowWork) { 
                // Split the document paths into an array
                $temp = $rowWork['document'];
                $filePath = explode(",", $temp); 
            ?>
                <tr class="text-valign text-center">
                    <td><?php echo htmlspecialchars($rowWork['case_id']); ?></td>
                    <!-- here $rowWork id is match to the $advNameD then it print like $advName[1] print_r($advNameD) for understanding-->
                    <td><?php echo htmlspecialchars($advNameD[$rowWork['id']] ?? "No Advocate"); ?></td>
                    <td><?php echo htmlspecialchars($rowWork['client-name']); ?></td>
                   <td class="text-start">
                            <?php foreach ($filePath as $file): ?>
                                <?php if ($file): 
                                    $fileP = strtolower(pathinfo($file,PATHINFO_EXTENSION));
                                     $image = in_array($fileP, ['png', 'jpeg', 'jpg', 'svg']); ?>
                                    <br>
                                    <?php if($image): ?>
                                        
                                        <img class="doc-img" src="<?php echo htmlspecialchars($file); ?>">
                                        <a class="btn bg-l-purp col-blk ms-3" href="<?php echo htmlspecialchars($file); ?>" download>Download </a><br>
                                    <?php else : ?>
                                         <a class="btn bg-purp col-wh" href="<?php echo htmlspecialchars($file); ?>" target="_blank">See</a>
                                         <a class="btn bg-l-purp col-blk" href="<?php echo htmlspecialchars($file); ?>" download>Download: <?php echo basename($file); ?></a><br>
                                    <?php endif; ?>
                                    
                                <?php else: ?>
                                    No document uploaded!
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="4" class="text-center">No records found</td>
            </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
