<?php

$conn = mysqli_connect("localhost", "root", "", "happy_paws");

if (!$conn) {
    die("Database connection failed");
}

/* Current application */

$id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

$current = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM adoption WHERE id=$id")
);

/* Statistics */

$total = mysqli_num_rows(
    mysqli_query($conn, "SELECT id FROM adoption")
);

$dogs = mysqli_num_rows(
    mysqli_query($conn, "SELECT id FROM adoption 
                         WHERE pet IN ('Bruno','Max','Rocky','Simba','Milo','Daisy','Oscar','Ruby')")
);

$cats = mysqli_num_rows(
    mysqli_query($conn, "SELECT id FROM adoption 
                         WHERE pet IN ('Luna','Bella','Coco','Mimi','Leo','Misty')")
);

$other = $total - $dogs - $cats;

/* All applications */

$result = mysqli_query($conn, "SELECT * FROM adoption ORDER BY id DESC");

?>

<!DOCTYPE html>
<html>

<head>

<title>Happy Paws | Summary</title>

<style>

body {
    margin: 0;
    font-family: Arial;
    background: #f8f7f2;
    color: #333;
}

nav {
    background: white;
    padding: 18px 8%;
    display: flex;
    justify-content: space-between;
    box-shadow: 0 2px 10px #ddd;
}

.logo {
    font-size: 24px;
    font-weight: bold;
    color: #27675d;
}

.logo span {
    color: #df8050;
}

nav a {
    margin-left: 20px;
    text-decoration: none;
    color: #444;
}

.container {
    width: 90%;
    max-width: 1000px;
    margin: 40px auto;
}

h1 {
    color: #27675d;
    text-align: center;
}

.stats {
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
    margin: 25px 0;
}

.stat {
    background: white;
    padding: 20px 30px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 3px 12px #ddd;
}

.stat b {
    display: block;
    font-size: 25px;
    color: #27675d;
}

.card {
    background: white;
    padding: 25px;
    border-radius: 12px;
    margin-top: 25px;
    box-shadow: 0 3px 15px #ddd;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

th, td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
    text-align: left;
}

th {
    background: #e7f2ee;
    color: #27675d;
}

.qr {
    text-align: center;
}

.qr img {
    width: 160px;
}

button, .payment {
    background: #27675d;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 6px;
    text-decoration: none;
    display: inline-block;
    margin-top: 15px;
}

</style>

</head>

<body>

<nav>

<div class="logo">
Happy <span>Paws</span>
</div>

<div>
<a href="index.html">Home</a>
<a href="pets.html">Pets</a>
<a href="adoption.html">Adopt</a>
</div>

</nav>

<div class="container">

<h1>Adoption Summary</h1>


<!-- Statistics -->

<div class="stats">

<div class="stat">
<b><?php echo $total; ?></b>
Applications
</div>

<div class="stat">
<b><?php echo $dogs; ?></b>
Dogs
</div>

<div class="stat">
<b><?php echo $cats; ?></b>
Cats
</div>

<div class="stat">
<b><?php echo $other; ?></b>
Other
</div>

</div>


<?php if ($current) { ?>

<!-- Current Application -->

<div class="card">

<h2>Latest Application</h2>

<p>
<b>Application ID:</b>
<?php echo $current["id"]; ?>
</p>

<p>
<b>Name:</b>
<?php echo htmlspecialchars($current["name"]); ?>
</p>

<p>
<b>Age:</b>
<?php echo $current["age"]; ?>
</p>

<p>
<b>Phone:</b>
<?php echo $current["phone"]; ?>
</p>

<p>
<b>Email:</b>
<?php echo htmlspecialchars($current["email"]); ?>
</p>

<p>
<b>Pet:</b>
<?php echo htmlspecialchars($current["pet"]); ?>
</p>

<p>
<b>Reason:</b>
<?php echo htmlspecialchars($current["reason"]); ?>
</p>


<!-- QR -->

<div class="qr">

<h3>Application Verification QR</h3>

<?php
$link = "http://10.238.72.231/pet_adoption/verify.php?id=".$current["id"];


$qr = "https://api.qrserver.com/v1/create-qr-code/?size=160x160&data="
      . urlencode($link);

?>

<img src="<?php echo $qr; ?>">

<br>

<a class="payment"
href="payment.html?pet=<?php echo urlencode($current["pet"]); ?>">

Proceed to Payment

</a>

</div>

</div>

<?php } ?>


<!-- All Applications -->

<div class="card">

<h2>All Adoption Applications</h2>

<table>

<tr>

<th>ID</th>
<th>Name</th>
<th>Pet</th>
<th>Phone</th>
<th>Date</th>

</tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>

<tr>

<td><?php echo $row["id"]; ?></td>

<td><?php echo htmlspecialchars($row["name"]); ?></td>

<td><?php echo htmlspecialchars($row["pet"]); ?></td>

<td><?php echo $row["phone"]; ?></td>

<td><?php echo $row["adoption_date"]; ?></td>

</tr>

<?php } ?>

</table>

</div>

</div>

</body>

</html>

<?php

mysqli_close($conn);

?>




