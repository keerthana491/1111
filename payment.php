
<?php

$pet = $_POST["pet"];
$method = $_POST["method"];

if ($method == "Cash on Visit") {
    $title = "✓ Adoption Confirmed!";
    $message = "Your adoption request has been confirmed.";
    $amount = "Amount Due on Visit: ₹2,600";
    $status = "Payment Pending – Pay at Centre";
    $note = "Please pay ₹2,600 when you visit the Happy Paws centre. 🐾";
} else {
    $title = "✓ Payment Successful!";
    $message = "Your payment has been confirmed.";
    $amount = "Total Paid: ₹2,600";
    $status = "Payment Confirmed ✓";
    $note = "Thank you for completing your payment and giving a pet a loving home! ❤️";
}

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Happy Paws | Payment Status</title>

<style>

body {
    margin: 0;
    font-family: Arial;
    background: #f8f7f2;
    text-align: center;
    color: #333;
}

.box {
    background: white;
    width: 90%;
    max-width: 600px;
    margin: 50px auto;
    padding: 35px;
    border-radius: 15px;
    box-shadow: 0 3px 15px #ddd;
}

h1 {
    color: #27675d;
}

.success {
    color: green;
    font-weight: bold;
}

.passport {
    background: #e7f2ee;
    padding: 20px;
    margin-top: 25px;
    border-radius: 10px;
    text-align: left;
}

.passport h2 {
    text-align: center;
    color: #27675d;
}

.total {
    color: #df8050;
    font-size: 20px;
    font-weight: bold;
}

button {
    margin-top: 20px;
    padding: 12px 25px;
    border: none;
    border-radius: 7px;
    background: #27675d;
    color: white;
    cursor: pointer;
}

</style>

</head>

<body>

<div class="box">

<h1><?php echo $title; ?></h1>

<p class="success">
<?php echo $message; ?>
</p>

<div class="passport">

<h2>🐾 Digital Adoption Passport</h2>

<p>
<b>Pet:</b>
<?php echo htmlspecialchars($pet); ?>
</p>

<p>
<b>Payment Method:</b>
<?php echo htmlspecialchars($method); ?>
</p>

<p>
<b>Adoption Fee:</b> ₹2,500
</p>

<p>
<b>Care & Processing:</b> ₹100
</p>

<p class="total">
<?php echo $amount; ?>
</p>

<p>
<b>Status:</b>
<?php echo $status; ?>
</p>

</div>

<p>
<?php echo $note; ?>
</p>

<a href="index.html">
<button>Back to Home</button>
</a>

</div>

</body>

</html>