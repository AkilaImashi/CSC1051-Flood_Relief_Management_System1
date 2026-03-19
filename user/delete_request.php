<?php
include("../config/db.php");

$id = $_GET['id'];

$sql = "DELETE FROM relief_requests WHERE id='$id'";

mysqli_query($conn,$sql);

header("Location: view_requests.php");
?>