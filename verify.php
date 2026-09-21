<?php

$conn = mysqli_connect("localhost", "root", "", "happy_paws");

if (!$conn) {
    die("Database connection failed");
}

$id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

$result = mysqli_query(
    $conn,
    "SELECT * FROM adoption WHERE id=$id"
);

$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>

<head>

<title>Happy Paws | Verification</title>

<style>

body {
    font-family: Arial;
    background: #f8f7f2;
    text-align: center;
    padding: 50px;
}

.box {
    background: white;
    max-width: 500px;
    margin: auto;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 3px 15px #ddd;
}

h1 {
    color: #27675d;
}

.detail {
    background: #e7f2ee;
    padding: 12px;
    margin: 10px;
    border-radius: 7px;
}

.pet {
    color: #df8050;
    font-weight: bold;
}

</style>

</head>

<body>

<div class="box">

<?php if ($row) { ?>

<h1>✓ Application Verified</h1>

<p>Happy Paws adoption application is valid.</p>

<div class="detail">
<b>Application ID:</b>
<?php echo $row["id"]; ?>
</div>

<div class="detail">
<b>Applicant:</b>
<?php echo htmlspecialchars($row["name"]); ?>
</div>

<div class="detail">
<b>Pet:</b>
<span class="pet">
<?php echo htmlspecialchars($row["pet"]); ?>
</span>
</div>

<div class="detail">
<b>Adoption Date:</b>
<?php echo $row["adoption_date"]; ?>
</div>

<?php } else { ?>

<h1>✕ Invalid Application</h1>

<p>No application was found.</p>

<?php } ?>

</div>

</body>

</html>

<?php
mysqli_close($conn);
?>