<?php

$conn = mysqli_connect("localhost", "root", "", "happy_paws");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}


/* Get pet ID from URL */

$pet_id = isset($_GET["pet_id"])
    ? intval($_GET["pet_id"])
    : 0;


/* Get pet details from database */

$result = mysqli_query(
    $conn,
    "SELECT * FROM pets WHERE pet_id = $pet_id"
);


/* Check whether pet exists */

if (mysqli_num_rows($result) == 0) {

    $pet = null;

} else {

    $pet = mysqli_fetch_assoc($result);

}

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>
<?php
if ($pet) {
    echo htmlspecialchars($pet["name"]) . " | Happy Paws";
} else {
    echo "Pet Not Found | Happy Paws";
}
?>
</title>

<style>

* {
    box-sizing: border-box;
}

body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f8f7f2;
    color: #333;
}


/* NAVIGATION */

nav {
    background: white;
    padding: 18px 7%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
}

.logo {
    font-size: 25px;
    font-weight: bold;
    color: #4b7f52;
}

.nav-links a {
    text-decoration: none;
    color: #333;
    margin-left: 25px;
    font-weight: 500;
}

.nav-links a:hover {
    color: #4b7f52;
}


/* MAIN */

.details-container {
    width: 85%;
    max-width: 1100px;
    margin: 60px auto;
}


/* PET DETAILS CARD */

.details-card {
    background: white;
    border-radius: 18px;
    overflow: hidden;
    display: grid;
    grid-template-columns: 1fr 1fr;
    box-shadow: 0 5px 20px rgba(0,0,0,0.12);
}


/* IMAGE */

.pet-image {
    width: 100%;
    height: 500px;
    object-fit: cover;
    display: block;
}


/* INFORMATION */

.pet-info {
    padding: 45px;
}

.pet-info h1 {
    font-size: 40px;
    color: #355e3b;
    margin-top: 0;
    margin-bottom: 10px;
}

.pet-info h3 {
    color: #777;
    font-size: 20px;
    margin-top: 0;
    font-weight: normal;
}

.pet-info p {
    line-height: 1.7;
    color: #555;
}


/* DETAILS */

.info-box {
    margin-top: 25px;
}

.info-row {
    padding: 12px 0;
    border-bottom: 1px solid #eee;
}

.info-row strong {
    display: inline-block;
    width: 100px;
    color: #355e3b;
}


/* BUTTONS */

.button-area {
    margin-top: 30px;
}

.adopt-btn {
    display: inline-block;
    background: #4b7f52;
    color: white;
    text-decoration: none;
    padding: 13px 25px;
    border-radius: 25px;
    font-size: 16px;
    margin-right: 10px;
}

.adopt-btn:hover {
    background: #355e3b;
}

.back-btn {
    display: inline-block;
    background: #eee;
    color: #333;
    text-decoration: none;
    padding: 13px 25px;
    border-radius: 25px;
    font-size: 16px;
}

.back-btn:hover {
    background: #ddd;
}


/* NOT FOUND */

.not-found {
    background: white;
    text-align: center;
    padding: 70px 20px;
    border-radius: 18px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

.not-found h1 {
    color: #355e3b;
}


/* FOOTER */

footer {
    background: #355e3b;
    color: white;
    text-align: center;
    padding: 22px;
}


/* MOBILE */

@media (max-width: 800px) {

    nav {
        flex-direction: column;
        gap: 12px;
    }

    .nav-links a {
        margin: 0 8px;
    }

    .details-card {
        grid-template-columns: 1fr;
    }

    .pet-image {
        height: 350px;
    }

    .pet-info {
        padding: 30px;
    }

    .pet-info h1 {
        font-size: 32px;
    }

}

</style>

</head>

<body>


<!-- NAVIGATION -->

<nav>

    <div class="logo">
        🐾 Happy Paws
    </div>

    <div class="nav-links">

        <a href="home">Home</a>

        <a href="pets.php">Available Pets</a>
        <a href="pets.php">Pets Details</a
        <a href="pets.php">Adoption</a
        <a href="pets.php">Summary</a 

        <a href="adoption.html">Payment</a>

    </div>

</nav>


<!-- DETAILS -->

<div class="details-container">

<?php if ($pet) { ?>

    <div class="details-card">


        <!-- PET IMAGE -->

        <div>

            <img
                class="pet-image"
                src="<?php echo htmlspecialchars($pet["image"]); ?>"
                alt="<?php echo htmlspecialchars($pet["name"]); ?>"
            >

        </div>


        <!-- PET INFORMATION -->

        <div class="pet-info">

            <h1>
                <?php echo htmlspecialchars($pet["name"]); ?>
            </h1>

            <h3>
                <?php echo htmlspecialchars($pet["breed"]); ?>
            </h3>


            <p>
                <?php echo htmlspecialchars($pet["description"]); ?>
            </p>


            <div class="info-box">


                <div class="info-row">

                    <strong>Breed:</strong>

                    <?php echo htmlspecialchars($pet["breed"]); ?>

                </div>


                <div class="info-row">

                    <strong>Age:</strong>

                    <?php echo htmlspecialchars($pet["age"]); ?>

                </div>


                <div class="info-row">

                    <strong>Gender:</strong>

                    <?php echo htmlspecialchars($pet["gender"]); ?>

                </div>


                <div class="info-row">

                    <strong>Category:</strong>

                    <?php echo htmlspecialchars($pet["category"]); ?>

                </div>


            </div>


            <!-- BUTTONS -->

            <div class="button-area">

                <a
                    class="adopt-btn"
                    href="adoption.html?pet=<?php echo urlencode($pet["name"]); ?>"
                >
                    Adopt <?php echo htmlspecialchars($pet["name"]); ?>
                </a>


                <a
                    class="back-btn"
                    href="pets.php"
                >
                    ← Back to Pets
                </a>

            </div>

        </div>

    </div>

<?php } else { ?>


    <!-- PET NOT FOUND -->

    <div class="not-found">

        <h1>🐾 Pet Not Found</h1>

        <p>
            Sorry, the pet you are looking for could not be found.
        </p>

        <br>

        <a
            class="adopt-btn"
            href="pets.php"
        >
            ← Back to Available Pets
        </a>

    </div>


<?php } ?>

</div>


<!-- FOOTER -->

<footer>

    <p>
        © 2026 Happy Paws Pet Adoption | Give Love, Give a Home 🐾
    </p>

</footer>


</body>

</html>

