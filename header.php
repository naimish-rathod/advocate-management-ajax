<?php
session_start();
include 'connection.php';

// Check if user is logged in
if (!isset($_SESSION['uname'])) {
    header("location:login.php");
    exit;
}

$user = $_SESSION['uname'];

// Fetch admin details
$stmt = $conn->prepare("SELECT * FROM `adv-nr`");
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();

// Fetch attendance data
$curdate = date('Y-m-d');
$attend = $conn->prepare("SELECT * FROM `attendance` WHERE DATE(`entry`) = ?");
$attend->bind_param("s", $curdate);
$attend->execute();
$attend->store_result();
$present_emp = $attend->num_rows > 0 ? $attend->num_rows : 0;

// Fetch total case data
$qryWork = "SELECT * FROM `work-data`";
$stmtWork = $conn->prepare($qryWork);
$stmtWork->execute();
$resWork = $stmtWork->get_result();
$workData = $resWork->fetch_all(MYSQLI_ASSOC);

$ntfyCountPend = 0;
$ntfyCountDone = 0;
foreach ($workData as $workRow) {
    if ($workRow['status'] === 'pending') {
        $ntfyCountPend++;
    } else {
        $ntfyCountDone++;
    }
}
$totalCase = $ntfyCountDone + $ntfyCountPend;

// Fetch today's cases
$cases = $conn->prepare("SELECT * FROM `work-data` WHERE DATE(`created_at`) = ?");
$cases->bind_param("s", $curdate);
$cases->execute();
$cases->store_result();
$present_cases = $cases->num_rows > 0 ? $cases->num_rows : 0;

$hasWorkData = (count($workData) > 0);
?>
<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>N.R Consultancy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/index-style.css">
     <link rel="icon" type="image/x-icon" href="img/justice.png">
</head>
<body>
    <!-- Navigation Bar -->
    <div class="container-fluid navbar-col shadow-lg">
        <nav class="navbar navbar-expand-sm container">
        <div class="container-fluid float-end">
            <ul class="navbar-nav nav-text">
                <li class="nav-item me-3">
                    <img src="img/munu.png" class="menu-img" data-bs-toggle="offcanvas" data-bs-target="#demo">
                </li>
                <li class="nav-item ms-4">
                    <a href="index.php" class="nav-link fs-5">Home</a>
                </li>
                <li class="nav-item">
                    <li  class="nav-item">
                     <a href="cases.php" class="nav-link fs-5">Cases</a>
                </li>
                </li>
                <li class="nav-item">
                    <a href="complate-case.php" class="nav-link fs-5">Completed<span class="ntfy"><?php echo htmlspecialchars($ntfyCountDone); ?></span></a>
                </li>
                <li class="nav-item">
                    <a href="pending-case.php" class="nav-link fs-5">Pending<span class="ntfy"><?php echo htmlspecialchars($ntfyCountPend); ?></span></a>
                </li>
            </ul>
        </div>
        <span class="uname me-3"><?php echo htmlspecialchars($row['name']); ?></span>
        <img alt="profile" src="<?php echo htmlspecialchars($row['user_img_src']); ?>" class="user_img me-4">
    </nav>
    </div>
    

    <!-- Sidebar -->
     <div class="offcanvas offcanvas-start sidebar text-center" id="demo">
        <div class="offcanvas-header">
            <h3 class="offcanvas-title col-wh">Dashboard</h3>
            <!-- <button class="btn btn-close text-reset" data-bs-dismiss="offcanvas"></button> --> <img src="img/close.png"  class="text-reset close" data-bs-dismiss="offcanvas" >
        </div>
        <div class="offcanvas-body mt-2">
                <hr class="col-wh">
            <p class="dash-font"><a class="logout-txt dash-font" href="admin-doc.php">Documents</a></p>
                <hr class="col-wh">
            <p class="dash-font ">Total case <span class="badge rounded-pill b-ntfy"> <?php echo htmlspecialchars($totalCase) ?></span></p>
                <hr class="col-wh">
            <p class="dash-font"><a class="logout-txt" href="Logout.php">Logout</a></p>
                <hr class="col-wh">
        </div>
     </div>
