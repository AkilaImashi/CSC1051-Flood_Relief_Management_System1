<?php
include("../config/db.php");

if(isset($_POST['register'])){

    $name  = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // 1. Check if email already exists
    $check = "SELECT id FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $check);

    if(mysqli_num_rows($result) > 0){
        echo "<script>alert('Email already registered. Please use a different email.'); window.history.back();</script>";
    } else {
        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

        // 2. Only ONE mysqli_query() call
        if(mysqli_query($conn, $sql)){
            echo "<script>
                alert('Registered successfully');
                window.location='login.php';
            </script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Register</title>
<link rel="stylesheet" href="../css/style.css">

</head>

<body>

<div class="container">

<h2>User Registration</h2>

<form method="POST">

Name
<input type="text" name="name" required>

Email
<input type="email" name="email" required>

Password
<input type="password" name="password" required>

<button name="register">Register</button>

</form>

<br>

<div class="nav">
<a href="login.php">Back to Login</a>
</div>

</div>

</body>
</html>