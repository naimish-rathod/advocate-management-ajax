<?php include 'header.php';


// Get month value from GET request
if (isset($_GET['month'])) {
    $month = $_GET['month'];
} else {
    $month = date('m');  
}
 
 
$case = $conn->prepare("SELECT * FROM `work-data` WHERE MONTH(`created_at`) = ?");
$case->bind_param("i", $month);
$case->execute();
$caseRes = $case->get_result();

if ($caseRes->num_rows > 0) {
    $caseData = $caseRes->fetch_all(MYSQLI_ASSOC); 
} else {
    $caseData = [];  
}
?>

<div class="thirteen mt-5">
    <h1>Cases</h1>
</div>

<div class="container mt-5">
    <form action="cases.php"> 
        <select class="float-end option-sty option-sty-2 mb-2" name="month">
            <option value="01" <?php echo ($month == '01' ? 'selected' : ''); ?>>Jan</option>
            <option value="02" <?php echo ($month == '02' ? 'selected' : ''); ?>>Feb</option>
            <option value="03" <?php echo ($month == '03' ? 'selected' : ''); ?>>Mar</option>
            <option value="04" <?php echo ($month == '04' ? 'selected' : ''); ?>>Apr</option>
            <option value="05" <?php echo ($month == '05' ? 'selected' : ''); ?>>May</option>
            <option value="06" <?php echo ($month == '06' ? 'selected' : ''); ?>>Jun</option>
            <option value="07" <?php echo ($month == '07' ? 'selected' : ''); ?>>Jul</option>
            <option value="08" <?php echo ($month == '08' ? 'selected' : ''); ?>>Aug</option>
            <option value="09" <?php echo ($month == '09' ? 'selected' : ''); ?>>Sep</option>
            <option value="10" <?php echo ($month == '10' ? 'selected' : ''); ?>>Oct</option>
            <option value="11" <?php echo ($month == '11' ? 'selected' : ''); ?>>Nov</option>
            <option value="12" <?php echo ($month == '12' ? 'selected' : ''); ?>>Dec</option>
        </select>
        <input type="submit" value="Find" class="mb-2 float-end find-btn bg-purp col-wh me-3">
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="table-head-col">Case ID</th>
                <th class="table-head-col">Employee ID</th>
                <th class="table-head-col">Client Name</th>
                <th class="table-head-col">Case Type</th>
                <th class="table-head-col">Case Description</th>
                <th class="table-head-col">Status</th>
                <th class="table-head-col">Case Date</th>
                <th class="table-head-col">Document</th>
                <th class="table-head-col">Case Close Description</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($caseData)) { ?>
                <?php foreach ($caseData as $case) {    
                      $filePath = isset($case['document']) ? explode(",", $case['document']) : []; ?>
                    <tr>
                        <td><?php echo htmlspecialchars($case['case_id']); ?></td>
                        <td><?php echo htmlspecialchars($case['id']); ?></td>
                        <td><?php echo htmlspecialchars($case['client-name']); ?></td>
                        <td><?php echo htmlspecialchars($case['case-type']); ?></td>
                        <td><?php echo htmlspecialchars($case['case-desc']); ?></td>
                        <td><?php echo htmlspecialchars($case['status']); ?></td>
                        <td><?php echo htmlspecialchars($case['created_at']); ?></td>
                        <td class="btn-2">
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
                        <td><?php echo htmlspecialchars($case['case_cls_desc']); ?></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="10" class="text-center">No cases registered for this month</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>
<script src="script/response.js"></script><!-- Ajax jquery -->
</html>
