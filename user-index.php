<?php
session_start();
include 'connection.php';

$user = $_SESSION['user_uname'];
if (!$user) {
    header("location:login.php");
    exit();
}

// Fetch user details
$qry = "SELECT * FROM `all-adv` WHERE id = ?";
$stmt = $conn->prepare($qry);
$stmt->bind_param("i", $user);
$stmt->execute();
if ($stmt) {
    $res = $stmt->get_result();
    $row = $res->fetch_assoc();
}

// Fetch work data
$qryWork = "SELECT * FROM `work-data` WHERE id = ?";
$stmtWork = $conn->prepare($qryWork);
$stmtWork->bind_param("i", $user);
$stmtWork->execute();
$resWork = $stmtWork->get_result();
$workData = $resWork->fetch_all(MYSQLI_ASSOC);

// Calculate notification counts
$ntfyCountPend = 0;
$ntfyCountDone = 0;
foreach ($workData as $workRow) {
    if ($workRow['status'] === 'pending') {
        $ntfyCountPend++;
    } else {
        $ntfyCountDone++;
    }
}

// Total cases count
$totalCase = $ntfyCountDone + $ntfyCountPend;

// Check if work data exists
$hasWorkData = (count($workData) > 0);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>N.R Consultancy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/index-style.css">
</head>
<body>
   <div class="container-fluid navbar-col shadow-lg">
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-sm navbar-col container">
            <div class="container-fluid float-end">
                <ul class="navbar-nav nav-text">
                    <li class="nav-item me-3">
                        <img src="img/munu.png" class="menu-img" data-bs-toggle="offcanvas" data-bs-target="#demo">
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link fs-5">Completed <span class="ntfy"><?php echo htmlspecialchars($ntfyCountDone); ?></span></a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link fs-5">Pending <span class="ntfy"><?php echo htmlspecialchars($ntfyCountPend); ?></span></a>
                    </li>
                </ul>
            </div>
            <span class="uname me-3"><?php echo htmlspecialchars($row['name']); ?></span>
            <img alt="Profile" src="<?php echo htmlspecialchars($row['user_img_src']); ?>" class="user_img me-4">
        </nav>
   </div>
   
    <!-- Sidebar -->
    <div class="offcanvas offcanvas-start sidebar text-center" id="demo">
        <div class="offcanvas-header">
            <h3 class="offcanvas-title col-wh">Dashboard</h3>
            <img src="img/close.png" class="text-reset close" data-bs-dismiss="offcanvas">
        </div>
        <div class="offcanvas-body mt-2">
            <hr class="col-wh">
            <p class="dash-font"><a class="logout-txt dash-font" href="user-doc.php">Documents</a></p>
            <hr class="col-wh">
            <div>
                <p class="dash-font">Attendance</p>
                <a href="attend.php?id=<?php echo htmlspecialchars($row['id']); ?>&name=<?php echo htmlspecialchars($row['name']); ?>" class="btn btn-etr rounded-pill"><b>Entry</b></a>
                <a href="leave.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-cls rounded-pill"><b>Exit</b></a>
            </div>
            <hr class="col-wh">
            <p class="dash-font">Total case <span class="badge rounded-pill b-ntfy"><?php echo htmlspecialchars($totalCase); ?></span></p>
            <hr class="col-wh">
            <p class="dash-font"><a class="logout-txt" href="Logout.php">Logout</a></p>
            <hr class="col-wh">
        </div>
    </div>
    <div class="thirteen mt-5">
        <h1>Cases</h1>
    </div>
    <!-- Work Data -->
    <div class="container mt-5">
        <?php if ($hasWorkData): ?>
            <table class="table table-striped table-bordered text-center">
                <tr>
                    <th class="table-head-col">Case ID</th>
                    <th class="table-head-col">Client Name</th>
                    <th class="table-head-col">Case Description</th>
                    <th class="table-head-col">Status</th>
                    <th class="table-head-col">Case Close Description</th>
                    <th class="table-head-col">Document</th>
                    <th class="table-head-col"></th>
                </tr>
                <?php foreach ($workData as $rowWork): ?>
                    <tr>
                        <form action="update-work.php" method="post" enctype="multipart/form-data">
                            <td><?php echo htmlspecialchars($rowWork['case_id']); ?></td>
                            <td><?php echo htmlspecialchars($rowWork['client-name']); ?></td>
                            <td class="text-start"><?php echo htmlspecialchars($rowWork['case-desc']); ?></td>
                            <td>
                                <label for="optionSelect">Status: <?php echo htmlspecialchars($rowWork['status']); ?></label>
                                <select id="optionSelect" name="option" class="option-sty">
                                    <option value="pending">Pending</option>
                                    <option value="done">Done</option>
                                </select>
                            </td>
                            <td>
                                <textarea class="form-control" rows="4" name="case_cls_desc" placeholder="Enter the case expense and close description"></textarea>
                            </td>
                            <td>
                                <input type="file" name="file[]" class="form-control" multiple>
                            </td>
                            <td>
                                <input type="submit" value="Update" class="btn radius bg-purp col-wh">
                                <input type="hidden" name="case_id" value="<?php echo htmlspecialchars($rowWork['case_id']); ?>">
                            </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No work data available.</p>
        <?php endif; ?>
    </div>
</body>
</html>
