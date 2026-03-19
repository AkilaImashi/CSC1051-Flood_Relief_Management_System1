
<?php
include("../config/db.php");

$search = "";

if(isset($_GET['search'])){
    $search = $_GET['search'];

    $sql = "SELECT relief_requests.*, users.name 
            FROM relief_requests 
            JOIN users ON relief_requests.user_id = users.id
            WHERE district LIKE '%$search%'";
}else{

    $sql = "SELECT relief_requests.*, users.name 
            FROM relief_requests 
            JOIN users ON relief_requests.user_id = users.id";
}

$result = mysqli_query($conn,$sql);
?>
<link rel="stylesheet" href="../css/style.css">

<div class="container">

<h2>All Relief Requests</h2>

<!-- <form method="GET">

<input type="text" name="search" placeholder="Search district">

<button type="submit">Search</button>

</form> -->
<form method="GET">
    <input type="text" name="search" placeholder="Search district">
    <button type="submit">Search</button>
</form>

<br>
<table>

<tr>
<th>Request ID</th>
<th>User</th>
<th>Relief Type</th>
<th>District</th>

<th>GN Division</th>
<th>Contact Person</th>
<th>Contact Number</th>
<th>Address</th>
<th>Family Members</th>
<th>Severity</th>
<th>Description</th>
</tr>

<?php
while($row=mysqli_fetch_assoc($result)){
?>

<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['name']; ?></td>

<td><?php echo $row['relief_type']; ?></td>

<td><?php echo $row['district']; ?></td>



<td><?php echo $row['gn_division']; ?></td>

<td><?php echo $row['contact_person']; ?></td>

<td><?php echo $row['contact_number']; ?></td>

<td><?php echo $row['address']; ?></td>

<td><?php echo $row['family_members']; ?></td>

<td><?php echo $row['severity_level']; ?></td>

<td><?php echo $row['description']; ?></td>

</tr>

<?php
}
?>

</table>

</div>
