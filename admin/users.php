<?php
include("../config/db.php");
$sql = "SELECT * FROM users";
$result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">

<h2>All Users</h2>

<?php
if(isset($_GET['error']) && $_GET['error'] == 'cannot_delete'){
    echo "<div style='background:#ffe0e0; color:#c0392b; padding:12px 18px; 
          border-left:5px solid #c0392b; border-radius:5px; margin-bottom:15px;'>
          Cannot delete this user. They have existing relief requests. 
          Please delete their requests first.
          </div>";
}

if(isset($_GET['success']) && $_GET['success'] == 'deleted'){
    echo "<div style='background:#e0ffe0; color:#27ae60; padding:12px 18px; 
          border-left:5px solid #27ae60; border-radius:5px; margin-bottom:15px;'>
          User deleted successfully.
          </div>";
}
?>

<table border="1">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td>
        <!-- View Report link added -->
        <a href="user_report.php?id=<?php echo $row['id']; ?>"
           style="background:#3498db; color:white; padding:5px 10px;
                  border-radius:4px; text-decoration:none; margin-right:5px;">
           View Report
        </a>
        <a href="delete_user.php?id=<?php echo $row['id']; ?>"
           style="background:#e74c3c; color:white; padding:5px 10px;
                  border-radius:4px; text-decoration:none;">
           Delete
        </a>
    </td>
</tr>
<?php } ?>

</table>

<br>
<a href="dashboard.php"><button>Back</button></a>

</div>
</body>
</html>