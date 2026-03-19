<?php
include("../config/db.php");

$id = $_GET['id'];

$sql = "SELECT * FROM relief_requests WHERE id='$id'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

$type = $_POST['relief_type'];
$district = $_POST['district'];
$severity = $_POST['severity'];

$update = "UPDATE relief_requests 
SET relief_type='$type',
district='$district',
severity_level='$severity'
WHERE id='$id'";

mysqli_query($conn,$update);

header("Location: view_requests.php");

}
?>

<h2>Update Request</h2>

<form method="POST">

Relief Type
<input type="text" name="relief_type" value="<?php echo $row['relief_type']; ?>">

<br><br>

District
<input type="text" name="district" value="<?php echo $row['district']; ?>">

<br><br>

Severity
<select name="severity">

<option>Low</option>
<option>Medium</option>
<option>High</option>

</select>

<br><br>

<button name="update">Update</button>

</form>