<?php
session_start();
include("../config/db.php");

if(isset($_POST['login'])){

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn,$sql);
$user = mysqli_fetch_assoc($result);

if($user && password_verify($password,$user['password'])){

$_SESSION['user_id'] = $user['id'];
$_SESSION['role'] = $user['role'];

if($user['role']=="admin"){
header("Location: ../admin/dashboard.php");
}else{
header("Location: ../user/dashboard.php");
}

}else{
$error="Invalid email or password";
}

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Login</title>
<link rel="stylesheet" href="../css/style.css">

</head>

<body>

<div class="container">

<h2>User Login</h2>

<?php if(isset($error)){ echo "<p style='color:red'>$error</p>"; } ?>

<form method="POST">

Email
<input type="email" name="email" required>

Password
<input type="password" name="password" required>

<button name="login">Login</button>

</form>

<br>

<div class="nav">
<a href="register.php">Create Account</a>
</div>

</div>

</body>
</html>