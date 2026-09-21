
<?php

$conn = mysqli_connect("localhost", "root", "", "happy_paws");

if (!$conn) {
    die("Database connection failed");
}


/* GET FORM DATA */

$name = $_POST["name"];
$age = $_POST["age"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$address = $_POST["address"];
$pet = $_POST["pet"];
$reason = $_POST["reason"];


/* INSERT DATA */

$sql = "INSERT INTO adoption
(name, age, phone, email, address, pet, reason)
VALUES
('$name', '$age', '$phone', '$email', '$address', '$pet', '$reason')";


if (mysqli_query($conn, $sql)) {

    /* GET THE NEW APPLICATION ID */

    $application_id = mysqli_insert_id($conn);

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Happy Paws | Application Submitted</title>

<style>

body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f8f7f2;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.success-box {
    background: white;
    width: 90%;
    max-width: 600px;
    padding: 45px;
    text-align: center;
    border-radius: 18px;
    box-shadow: 0 5px 25px #ddd;
}

.success-box h1 {
    color: #27675d;
    margin-bottom: 15px;
}

.success-box p {
    color: #666;
    line-height: 1.7;
}

.pet-name {
    color: #df8050;
    font-weight: bold;
}

.application-id {
    background: #e7f2ee;
    padding: 12px;
    border-radius: 8px;
    color: #27675d;
    font-weight: bold;
    margin: 20px 0;
}

button {
    margin-top: 20px;
    padding: 13px 25px;
    border: none;
    background: #27675d;
    color: white;
    border-radius: 7px;
    font-size: 15px;
    cursor: pointer;
}

button:hover {
    background: #174d45;
}

</style>

</head>


<body>

<div class="success-box">

<h1>Application Submitted Successfully!</h1>

<p>
Thank you for applying to adopt
<span class="pet-name">
<?php echo htmlspecialchars($pet); ?>
</span>.
</p>

<p>
Your adoption application has been saved successfully.
</p>

<div class="application-id">

Application ID: #<?php echo $application_id; ?>

</div>

<p>
Our team will review your application and contact you soon.
</p>


<a href="summary.php?id=<?php echo $application_id; ?>">

<button>
View Adoption Summary
</button>

</a>

</div>

</body>

</html>

<?php

}

else {

    echo "Error: " . mysqli_error($conn);

}


mysqli_close($conn);

?>