<?php
session_start();

if($_SESSION['role']!="admin"){
header("Location: ../auth/login.php");
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Admin Dashboard</title>
<link rel="stylesheet" href="../css/style.css">

</head>

<body>

<div class="container">

<h2>Admin Dashboard</h2>

<div class="cards">

<div class="card">
<a href="users.php">Manage Users</a>
</div>

<div class="card">
<a href="requests.php">Relief Requests</a>
</div>

<div class="card">
<a href="reports.php">Reports</a>
</div>

</div>

<br><br>

<div class="nav">
<a href="../auth/logout.php">Logout</a>
</div>

</div>

</body>
</html>