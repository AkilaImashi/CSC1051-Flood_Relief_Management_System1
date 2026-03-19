<?php
include("../config/db.php");

$sql = "SELECT relief_type, COUNT(*) as total FROM relief_requests GROUP BY relief_type";

$result = mysqli_query($conn,$sql);
?>
<link rel="stylesheet" href="../css/style.css">
<div class="container">

<h2>Relief Summary Report</h2>

<table border="1">

<tr>
<th>Relief Type</th>
<th>Total Requests</th>
</tr>

<?php
while($row=mysqli_fetch_assoc($result)){
?>

<tr>
<td><?php echo $row['relief_type']; ?></td>
<td><?php echo $row['total']; ?></td>
</tr>

<?php
}
?>

</table>

<br>

<a href="dashboard.php">Back</a>
</div>