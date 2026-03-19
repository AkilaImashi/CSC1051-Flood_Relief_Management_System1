<?php
include("../config/db.php");

if(!isset($_GET['id']) || empty($_GET['id'])){
    header("Location: users.php");
    exit();
}

$id = $_GET['id'];

// Check if user has any relief requests
$check = "SELECT COUNT(*) as total FROM relief_requests WHERE user_id='$id'";
$result = mysqli_query($conn, $check);
$row = mysqli_fetch_assoc($result);

if($row['total'] > 0){
    // User has relief requests - redirect with error message
    header("Location: users.php?error=cannot_delete&id=$id");
    exit();
}

// Safe to delete - no relief requests found
$sql = "DELETE FROM users WHERE id='$id'";
mysqli_query($conn, $sql);

header("Location: users.php?success=deleted");
exit();
?>