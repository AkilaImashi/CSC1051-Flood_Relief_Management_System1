<?php
session_start();
include("../config/db.php");

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM relief_requests WHERE user_id='$user_id'";
$result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Relief Requests</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">

<h2>My Relief Requests</h2>

<table border="1">

<tr>
<th>ID</th>
<th>Relief Type</th>
<th>District</th>
<th>Severity</th>
<th>Action</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result)){
?>

<tr>

<td><?php echo $row['id']; ?></td>

<td>
    <?php 
    $types = explode(",", $row['relief_type']);
    foreach($types as $t){
        echo "<span style='background:#3498db;color:white;padding:2px 7px;
              border-radius:10px;margin:2px;display:inline-block;font-size:12px;'>
              " . trim($t) . "
              </span>";
    }
    ?>
</td>

<td><?php echo $row['district']; ?></td>
<td><?php echo $row['severity_level']; ?></td>

<td>
<a href="update_request.php?id=<?php echo $row['id']; ?>">Edit</a>
|
<a href="delete_request.php?id=<?php echo $row['id']; ?>">Delete</a>
</td>

</tr>

<?php
}
?>

</table>

<br>
<a href="dashboard.php">Back</a>
</div>

</body>
</html>