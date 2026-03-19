<?php
include("../config/db.php");

// Relief type counts
$sql = "SELECT relief_type FROM relief_requests";
$result = mysqli_query($conn, $sql);

$counts = [
    'Food'      => 0,
    'Water'     => 0,
    'Medicine'  => 0,
    'Clothes'   => 0,
    'Shelter'   => 0,
];

while($row = mysqli_fetch_assoc($result)){
    $types = explode(",", $row['relief_type']);
    foreach($types as $type){
        $type = trim($type);
        if(isset($counts[$type])){
            $counts[$type]++;
        }
    }
}

$total = array_sum($counts);

// Severity level counts
$severitySql = "SELECT severity_level, COUNT(*) as total FROM relief_requests GROUP BY severity_level";
$severityResult = mysqli_query($conn, $severitySql);

$severity = [
    'High'   => 0,
    'Medium' => 0,
    'Low'    => 0,
];

while($row = mysqli_fetch_assoc($severityResult)){
    $level = trim($row['severity_level']);
    if(isset($severity[$level])){
        $severity[$level] = $row['total'];
    }
}

$severityTotal = array_sum($severity);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relief Summary Report</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/report.css">
</head>
<body>

<div class="container">

    <h2>Relief Summary Report</h2>

    <div class="report-wrapper">

        <!-- Relief Type Table -->
        <div class="report-section">
            <h3>Relief Type Summary</h3>
            <table border="1">
                <tr>
                    <th>Relief Type</th>
                    <th>Total Requests</th>
                </tr>
                <?php foreach($counts as $type => $count){ ?>
                <tr>
                    <td><?php echo $type; ?></td>
                    <td><?php echo $count; ?></td>
                </tr>
                <?php } ?>
                <tr class="total-row">
                    <td>Total</td>
                    <td><?php echo $total; ?></td>
                </tr>
            </table>
        </div>

        <!-- Severity Level Table --><br><br>
        <div class="report-section">
            <h3>Severity Level Summary</h3>
            <table border="1">
                <tr>
                    <th>Severity Level</th>
                    <th>Total Requests</th>
                </tr>
                <?php foreach($severity as $level => $count){ ?>
                <tr>
                    <td>
                        <span class="badge badge-<?php echo strtolower($level); ?>">
                            <?php echo $level; ?>
                        </span>
                    </td>
                    <td><?php echo $count; ?></td>
                </tr>
                <?php } ?>
                <tr class="total-row">
                    <td>Total</td>
                    <td><?php echo $severityTotal; ?></td>
                </tr>
            </table>
        </div>

    </div>

    <br>
    <a href="dashboard.php"><button>Back</button></a>

</div>

</body>
</html>