<?php
include("../config/db.php");
$sql = "SELECT * FROM users";
$result = mysqli_query($conn,$sql);
?>

<link rel="stylesheet" href="../css/style.css">

<div class="container">

<h2>All Users</h2>

<table border="1">
<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Action</th>
</tr>

<?php
while($row=mysqli_fetch_assoc($result)){
?>

<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['email']; ?></td>
<td>
<a href="delete_user.php?id=<?php echo $row['id']; ?>">Delete</a>
</td>
</tr>

<?php
}
?>

</table>

<br>
<a href="dashboard.php">Back</a>

</div>