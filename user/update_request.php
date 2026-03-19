<?php
include("../config/db.php");

// Safety check - if no id provided, redirect back
if(!isset($_GET['id']) || empty($_GET['id'])){
    header("Location: view_requests.php");
    exit();
}

$id = $_GET['id'];

if(isset($_POST['update'])){

    $type     = implode(",", $_POST['relief_type']);
    $district = $_POST['district'];
    $severity = $_POST['severity'];

    $update = "UPDATE relief_requests 
               SET relief_type='$type',
                   district='$district',
                   severity_level='$severity'
               WHERE id='$id'";

    mysqli_query($conn, $update);
    header("Location: view_requests.php");
    exit();
}

// Fetch AFTER the POST block so $row is always loaded fresh
$sql    = "SELECT * FROM relief_requests WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$row    = mysqli_fetch_assoc($result);

// Safety check - if record not found, redirect back
if(!$row){
    header("Location: view_requests.php");
    exit();
}

$selected = explode(",", $row['relief_type']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Update Request</title>
</head>
<body>

<div class="container">
<h2>Update Request</h2>

<form method="POST" action="update_request.php?id=<?php echo $id; ?>">

<label>Relief Type</label>
<select name="relief_type[]" multiple required size="5">
    <?php
    $options = ["Food", "Water", "Medicine", "Clothes", "Shelter"];
    foreach($options as $option){
        $sel = in_array($option, $selected) ? "selected" : "";
        echo "<option value='$option' $sel>$option</option>";
    }
    ?>
</select>
<small style="color:#888">Hold Ctrl (Windows) or Cmd (Mac) to select multiple</small>

<br><br>

<label>District</label>
<input type="text" name="district" value="<?php echo $row['district']; ?>">

<br><br>

<label>Severity</label>
<select name="severity">
    <?php
    foreach(["Low", "Medium", "High"] as $level){
        $sel = ($row['severity_level'] == $level) ? "selected" : "";
        echo "<option value='$level' $sel>$level</option>";
    }
    ?>
</select>

<br><br>

<button name="update">Update</button>

</form>
</div>

</body>
</html>