<?php
session_start();

if(!isset($_SESSION['user_id'])){
header("Location: ../auth/login.php");
}
?>

<!DOCTYPE html>
<html>
<head>

<title>User Dashboard</title>
<link rel="stylesheet" href="../css/style.css">

</head>

<body>

<div class="container">

<h2>User Dashboard</h2>

<div class="cards">

<div class="card">
<a href="create_request.php">Create Request</a>
</div>

<div class="card">
<a href="view_requests.php">View My Requests</a>
</div>

<div class="card">
<a href="../auth/logout.php">Logout</a>
</div>

</div>

</div>

</body>
</html>