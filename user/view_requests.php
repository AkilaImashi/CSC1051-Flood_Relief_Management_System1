<?php
session_start();
include("../config/db.php");

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM relief_requests WHERE user_id='$user_id'";
$result = mysqli_query($conn,$sql);
?>
<link rel="stylesheet" href="../css/style.css">
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
<td><?php echo $row['relief_type']; ?></td>
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