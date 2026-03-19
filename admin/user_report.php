<?php
include("../config/db.php");

if(!isset($_GET['id']) || empty($_GET['id'])){
    header("Location: users.php");
    exit();
}

$user_id = $_GET['id'];

// Get user details
$user_sql = "SELECT * FROM users WHERE id='$user_id'";
$user_result = mysqli_query($conn, $user_sql);
$user = mysqli_fetch_assoc($user_result);

if(!$user){
    header("Location: users.php");
    exit();
}

// Get all relief requests by this user
$sql = "SELECT * FROM relief_requests WHERE user_id='$user_id' ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
$total = mysqli_num_rows($result);

// Count severity levels
$severity_counts = ['High' => 0, 'Medium' => 0, 'Low' => 0];

// Count relief types
$type_counts = ['Food' => 0, 'Water' => 0, 'Medicine' => 0, 'Clothes' => 0, 'Shelter' => 0];

// Temp fetch for counts
$temp_sql = "SELECT relief_type, severity_level FROM relief_requests WHERE user_id='$user_id'";
$temp_result = mysqli_query($conn, $temp_sql);
while($temp = mysqli_fetch_assoc($temp_result)){
    $level = trim($temp['severity_level']);
    if(isset($severity_counts[$level])) $severity_counts[$level]++;

    $types = explode(",", $temp['relief_type']);
    foreach($types as $type){
        $type = trim($type);
        if(isset($type_counts[$type])) $type_counts[$type]++;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Report - <?php echo $user['name']; ?></title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">

    <h2>Relief Request Report</h2>

    <!-- User Info Card -->
    <div style="background:#eaf4fb; border-left:5px solid #3498db; padding:15px 20px;
                border-radius:6px; margin-bottom:25px;">
        <p><strong>Name:</strong> <?php echo $user['name']; ?></p>
        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
        <p><strong>Total Requests:</strong> <?php echo $total; ?></p>
    </div>

    <!-- Summary Tables Side by Side -->
    <div style="display:flex; gap:30px; flex-wrap:wrap; margin-bottom:30px; align-items:flex-start;">

        <!-- Relief Type Summary -->
        <div style="flex:1; min-width:220px; max-width:48%;">
            <h3 style="margin-bottom:10px; color:#2c3e50; border-bottom:2px solid #3498db; padding-bottom:6px;">
                Relief Type Summary
            </h3>
            <table border="1" style="width:100%; min-width:unset;">
                <tr>
                    <th>Relief Type</th>
                    <th>Count</th>
                </tr>
                <?php foreach($type_counts as $type => $count){ ?>
                <tr>
                    <td><?php echo $type; ?></td>
                    <td><?php echo $count; ?></td>
                </tr>
                <?php } ?>
                <tr style="background:#f0f0f0; font-weight:bold;">
                    <td>Total</td>
                    <td><?php echo array_sum($type_counts); ?></td>
                </tr>
            </table>
        </div>

        <!-- Severity Summary -->
        <div style="flex:1; min-width:220px; max-width:48%;">
            <h3 style="margin-bottom:10px; color:#2c3e50; border-bottom:2px solid #3498db; padding-bottom:6px;">
                Severity Summary
            </h3>
            <table border="1" style="width:100%; min-width:unset;">
                <tr>
                    <th>Severity Level</th>
                    <th>Count</th>
                </tr>
                <?php
                $badge_colors = [
                    'High'   => ['bg' => '#ffe0e0', 'color' => '#c0392b'],
                    'Medium' => ['bg' => '#fff4e0', 'color' => '#e67e22'],
                    'Low'    => ['bg' => '#e0ffe0', 'color' => '#27ae60'],
                ];
                foreach($severity_counts as $level => $count){
                    $bg    = $badge_colors[$level]['bg'];
                    $color = $badge_colors[$level]['color'];
                ?>
                <tr>
                    <td>
                        <span style="background:<?php echo $bg; ?>; color:<?php echo $color; ?>;
                                     padding:3px 10px; border-radius:10px; font-weight:bold;
                                     font-size:13px;">
                            <?php echo $level; ?>
                        </span>
                    </td>
                    <td><?php echo $count; ?></td>
                </tr>
                <?php } ?>
                <tr style="background:#f0f0f0; font-weight:bold;">
                    <td>Total</td>
                    <td><?php echo array_sum($severity_counts); ?></td>
                </tr>
            </table>
        </div>

    </div>

    <!-- Full Request Details Table -->
    <h3 style="margin-bottom:10px; color:#2c3e50; border-bottom:2px solid #3498db; padding-bottom:6px;">
        All Requests Detail
    </h3>

    <div class="table-wrapper">
        <table border="1" style="min-width:1100px;">
            <tr>
                <th>Request ID</th>
                <th>Relief Type</th>
                <th>District</th>
                <th>Divisional Secretariat</th>
                <th>GN Division</th>
                <th>Contact Person</th>
                <th>Contact Number</th>
                <th>Address</th>
                <th>Family Members</th>
                <th>Severity</th>
                <th>Description</th>
            </tr>

            <?php
            mysqli_data_seek($result, 0);
            $count = 0;
            while($row = mysqli_fetch_assoc($result)){
                $count++;
            ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['relief_type']; ?></td>
                <td><?php echo $row['district']; ?></td>
                <td><?php echo $row['divisional_secretariat']; ?></td>
                <td><?php echo $row['gn_division']; ?></td>
                <td><?php echo $row['contact_person']; ?></td>
                <td><?php echo $row['contact_number']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <td><?php echo $row['family_members']; ?></td>
                <td>
                    <?php
                    $level = $row['severity_level'];
                    $bg    = $badge_colors[$level]['bg']    ?? '#eee';
                    $color = $badge_colors[$level]['color'] ?? '#333';
                    ?>
                    <span style="background:<?php echo $bg; ?>; color:<?php echo $color; ?>;
                                 padding:3px 10px; border-radius:10px; font-weight:bold;
                                 font-size:13px;">
                        <?php echo $level; ?>
                    </span>
                </td>
                <td><?php echo $row['description']; ?></td>
            </tr>
            <?php } ?>

            <?php if($count == 0){ ?>
            <tr>
                <td colspan="11" style="text-align:center; color:#999; padding:20px;">
                    This user has no relief requests.
                </td>
            </tr>
            <?php } ?>

        </table>
    </div>

    <br>
    <a href="users.php"><button>Back to Users</button></a>

</div>
</body>
</html>