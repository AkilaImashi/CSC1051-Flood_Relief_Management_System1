<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['user_id'])){
header("Location: ../auth/login.php");
}

if(isset($_POST['submit'])){

$user_id = $_SESSION['user_id'];
$relief_type = implode(",", $_POST['relief_type']);
$district = $_POST['district'];
$ds = $_POST['ds'];
$gn = $_POST['gn'];
$contact_person = $_POST['contact_person'];
$contact_number = $_POST['contact_number'];
$address = $_POST['address'];
$family_members = $_POST['family_members'];
if($family_members <= 0){
    echo "Family members must be a positive number";
    exit();
}
$severity = $_POST['severity'];
$description = $_POST['description'];

$sql = "INSERT INTO relief_requests
(user_id,relief_type,district,divisional_secretariat,gn_division,contact_person,contact_number,address,family_members,severity_level,description)
VALUES
('$user_id','$relief_type','$district','$ds','$gn','$contact_person','$contact_number','$address','$family_members','$severity','$description')";

if(mysqli_query($conn,$sql)){
echo "<script>
alert('Request submitted successfully');
window.location='create_request.php';
</script>";
}

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Create Relief Request</title>

<link rel="stylesheet" href="../css/style.css">
<script src="../js/script.js"></script>

</head>

<body>

<div class="container">

<h2>Create Relief Request</h2>

<form method="POST" name="requestForm" onsubmit="return validateRequestForm()">


<label>Relief Type</label>
<select name="relief_type[]" multiple required size="5">
    <option value="Food">Food</option>
    <option value="Water">Water</option>
    <option value="Medicine">Medicine</option>
    <option value="Clothes">Clothes</option>
    <option value="Shelter">Shelter</option>
</select>
<small style="color:#888">Hold Ctrl (Windows) or Cmd (Mac) to select multiple</small>

<br><br>

District
<label>Select District</label>
<select name="district" required>
<option value="">--Select District--</option>
<option value="Ampara">Ampara</option>
<option value="Anuradhapura">Anuradhapura</option>
<option value="Badulla">Badulla</option>
<option value="Batticaloa">Batticaloa</option>
<option value="Colombo">Colombo</option>
<option value="Galle">Galle</option>
<option value="Gampaha">Gampaha</option>
<option value="Hambantota">Hambantota</option>
<option value="Jaffna">Jaffna</option>
<option value="Kalutara">Kalutara</option>
<option value="Kandy">Kandy</option>
<option value="Kegalle">Kegalle</option>
<option value="Kilinochchi">Kilinochchi</option>
<option value="Kurunegala">Kurunegala</option>
<option value="Mannar">Mannar</option>
<option value="Matale">Matale</option>
<option value="Matara">Matara</option>
<option value="Monaragala">Monaragala</option>
<option value="Mullaitivu">Mullaitivu</option>
<option value="Nuwara Eliya">Nuwara Eliya</option>
<option value="Polonnaruwa">Polonnaruwa</option>
<option value="Puttalam">Puttalam</option>
<option value="Ratnapura">Ratnapura</option>
<option value="Trincomalee">Trincomalee</option>
<option value="Vavuniya">Vavuniya</option>
</select>

<br><br>

Divisional Secretariat
<input type="text" name="ds" required>

<br><br>

GN Division
<input type="text" name="gn">

<br><br>

Contact Person
<input type="text" name="contact_person" required>

<br><br>

Contact Number
<input type="text" name="contact_number" required>

<br><br>

Address
<textarea name="address"></textarea>

<br><br>

<label>Family Members</label>
<input type="number" name="family_members" min="1" required>

<br><br>

Severity Level
<select name="severity">
<option>Low</option>
<option>Medium</option>
<option>High</option>
</select>

<br><br>

Description
<textarea name="description"></textarea>

<br><br>

<button name="submit">Submit Request</button>

</form>

</div>

</body>
</html>