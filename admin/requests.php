<?php
include("../config/db.php");

$search      = isset($_GET['search']) ? $_GET['search'] : "";
$filter_type = isset($_GET['relief_type']) ? $_GET['relief_type'] : "";

// Fetch all unique districts for dropdown
$district_sql = "SELECT DISTINCT district FROM relief_requests ORDER BY district ASC";
$district_result = mysqli_query($conn, $district_sql);

$sql = "SELECT relief_requests.*, users.name 
        FROM relief_requests 
        JOIN users ON relief_requests.user_id = users.id
        WHERE 1=1";

if(!empty($search)){
    $sql .= " AND district = '$search'";
}

if(!empty($filter_type)){
    $sql .= " AND relief_type LIKE '%$filter_type%'";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Relief Requests</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">

    <h2>All Relief Requests</h2>

    <form method="GET">

        <div style="display:flex; gap:10px; flex-wrap:wrap; align-items:center;">

            <!-- District Dropdown -->
            <select name="search" style="flex:1; min-width:200px; padding:10px; border:1px solid #ccc; border-radius:5px;">
                <option value="">-- All Districts --</option>
                <?php
                // Reset pointer and loop districts
                mysqli_data_seek($district_result, 0);
                while($d = mysqli_fetch_assoc($district_result)){
                    $selected = ($search == $d['district']) ? "selected" : "";
                    echo "<option value='" . htmlspecialchars($d['district']) . "' $selected>" . htmlspecialchars($d['district']) . "</option>";
                }
                ?>
            </select>

            <!-- Relief Type Dropdown -->
            <select name="relief_type" style="flex:1; min-width:200px; padding:10px; border:1px solid #ccc; border-radius:5px;">
                <option value="">-- All Relief Types --</option>
                <?php
                $types = ["Food", "Water", "Medicine", "Clothes", "Shelter"];
                foreach($types as $type){
                    $selected = ($filter_type == $type) ? "selected" : "";
                    echo "<option value='$type' $selected>$type</option>";
                }
                ?>
            </select>

            <button type="submit">Search</button>

            <?php if(!empty($search) || !empty($filter_type)){ ?>
                <a href="all_requests.php"
                   style="background:#e74c3c; color:white; padding:10px 15px;
                          border-radius:5px; text-decoration:none;">
                   Clear
                </a>
            <?php } ?>

        </div>

    </form>

    <br>

    <!-- Active filters display -->
    <?php if(!empty($search) || !empty($filter_type)){ ?>
    <div style="background:#eaf4fb; padding:10px 15px; border-radius:5px;
                border-left:4px solid #3498db; margin-bottom:10px; font-size:14px;">
        Filtering by:
        <?php if(!empty($search)) echo " <strong>District:</strong> " . htmlspecialchars($search); ?>
        <?php if(!empty($filter_type)) echo " &nbsp;|&nbsp; <strong>Relief Type:</strong> " . htmlspecialchars($filter_type); ?>
    </div>
    <?php } ?>

    <div class="table-wrapper">
        <table border="1">
            <tr>
                <th>Relief Request ID</th>
                <th>User</th>
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
            $count = 0;
            while($row = mysqli_fetch_assoc($result)){
                $count++;
            ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['relief_type']; ?></td>
                <td><?php echo $row['district']; ?></td>
                <td><?php echo $row['divisional_secretariat']; ?></td>
                <td><?php echo $row['gn_division']; ?></td>
                <td><?php echo $row['contact_person']; ?></td>
                <td><?php echo $row['contact_number']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <td><?php echo $row['family_members']; ?></td>
                <td><?php echo $row['severity_level']; ?></td>
                <td><?php echo $row['description']; ?></td>
            </tr>
            <?php } ?>

            <?php if($count == 0){ ?>
            <tr>
                <td colspan="12" style="text-align:center; color:#999; padding:20px;">
                    No relief requests found.
                </td>
            </tr>
            <?php } ?>

        </table>
    </div>

    <br>
    <a href="dashboard.php"><button>Back</button></a>

</div>
</body>
</html>