<?php
$conn = mysqli_connect("localhost", "root", "", "happy_paws");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$result = mysqli_query($conn, "SELECT * FROM pets");
?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Happy Paws | Available Pets</title>

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

/* HEADER */

.header {
    text-align: center;
    padding: 55px 20px 30px;
}

.header h1 {
    font-size: 40px;
    margin-bottom: 10px;
    color: #355e3b;
}

.header p {
    font-size: 17px;
    color: #666;
}

/* CATEGORY BUTTONS */

.category-buttons {
    text-align: center;
    margin: 20px 0;
}

.category-buttons button {
    border: none;
    background: #4b7f52;
    color: white;
    padding: 13px 25px;
    margin: 7px;
    border-radius: 25px;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
}

.category-buttons button:hover {
    background: #355e3b;
    transform: translateY(-2px);
}

/* SEARCH */

.search-box {
    text-align: center;
    margin: 20px auto 35px;
}

.search-box input {
    width: 350px;
    max-width: 90%;
    padding: 14px 20px;
    border: 1px solid #ccc;
    border-radius: 25px;
    font-size: 16px;
    outline: none;
}

.search-box input:focus {
    border-color: #4b7f52;
    box-shadow: 0 0 5px rgba(75,127,82,0.3);
}

/* MESSAGE */

#message {
    text-align: center;
    color: #777;
    font-size: 17px;
    margin: 30px;
}

/* PET GRID */

.pet-container {
    width: 86%;
    margin: auto;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 25px;
    padding-bottom: 60px;
}

/* PET CARD */

.pet-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.10);
    transition: 0.3s;
}

.pet-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

.pet-card img {
    width: 100%;
    height: 230px;
    object-fit: cover;
    display: block;
}

.pet-info {
    padding: 18px;
}

.pet-info h2 {
    margin: 0 0 8px;
    color: #355e3b;
    font-size: 22px;
}

.pet-info p {
    margin: 6px 0;
    color: #666;
}

.view-btn {
    display: inline-block;
    margin-top: 12px;
    padding: 10px 18px;
    background: #4b7f52;
    color: white;
    text-decoration: none;
    border-radius: 20px;
    font-size: 14px;
}

.view-btn:hover {
    background: #355e3b;
}

/* FOOTER */

footer {
    background: #355e3b;
    color: white;
    text-align: center;
    padding: 22px;
    margin-top: 30px;
}

/* TABLET */

@media (max-width: 1000px) {

    .pet-container {
        grid-template-columns: repeat(2, 1fr);
    }

}

/* MOBILE */

@media (max-width: 600px) {

    nav {
        flex-direction: column;
        gap: 12px;
    }

    .nav-links a {
        margin: 0 8px;
    }

    .header h1 {
        font-size: 30px;
    }

    .pet-container {
        grid-template-columns: 1fr;
        width: 90%;
    }

    .search-box input {
        width: 90%;
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

        <a href="index.html">Home</a>

        <a href="pets.php">Available Pets</a>

        <a href="adoption.html">Adoption</a>

    </div>

</nav>


<!-- HEADER -->

<div class="header">

    <h1>Find Your New Best Friend 🐾</h1>

    <p>
        Choose a category to explore our lovely pets available for adoption.
    </p>

</div>


<!-- CATEGORY BUTTONS -->

<div class="category-buttons">

    <button onclick="showPets('Dog')">
        🐶 Dogs
    </button>

    <button onclick="showPets('Cat')">
        🐱 Cats
    </button>

    <button onclick="showPets('Other Pet')">
        🐰 Other Pets
    </button>

</div>


<!-- SEARCH -->

<div class="search-box">

    <input
        type="text"
        id="petSearch"
        placeholder="🔍 Search pet by name..."
        onkeyup="searchPet()"
    >

</div>


<!-- MESSAGE -->

<div id="message">
    Select a category above to view available pets.
</div>


<!-- PET CONTAINER -->

<div class="pet-container">

<?php

while ($pet = mysqli_fetch_assoc($result)) {

?>

    <div
        class="pet-card"
        data-category="<?php echo htmlspecialchars($pet["category"]); ?>"
        data-name="<?php echo htmlspecialchars($pet["name"]); ?>"
        style="display: none;"
    >

        <img
            src="<?php echo htmlspecialchars($pet["image"]); ?>"
            alt="<?php echo htmlspecialchars($pet["name"]); ?>"
        >

        <div class="pet-info">

            <h2>
                <?php echo htmlspecialchars($pet["name"]); ?>
            </h2>

            <p>
                <strong>Breed:</strong>
                <?php echo htmlspecialchars($pet["breed"]); ?>
            </p>

            <p>
                <strong>Age:</strong>
                <?php echo htmlspecialchars($pet["age"]); ?>
            </p>

            <p>
                <strong>Gender:</strong>
                <?php echo htmlspecialchars($pet["gender"]); ?>
            </p>

            <a
                class="view-btn"
                href="details.php?pet_id=<?php echo $pet["pet_id"]; ?>"
            >
                View Details
            </a>

        </div>

    </div>

<?php

}

?>

</div>


<!-- FOOTER -->

<footer>

    <p>
        © 2026 Happy Paws Pet Adoption | Give Love, Give a Home 🐾
    </p>

</footer>


<script>
var selectedCategory = "";
/* SHOW CATEGORY */
function showPets(category) {
    selectedCategory = category;
    var pets = document.getElementsByClassName("pet-card");
    var searchBox = document.getElementById("petSearch");
    var message = document.getElementById("message");
    /* Clear search */
    searchBox.value = "";
    var found = 0;
    for (var i = 0; i < pets.length; i++) {
        var petCategory =
            pets[i].getAttribute("data-category");
        if (petCategory == category) {
            pets[i].style.display = "block";
            found++;
        } else {
            pets[i].style.display = "none";
        }
    }
    if (found > 0) {
        message.style.display = "none";
    } else {
        message.innerHTML =
            "No pets are currently available in this category.";
        message.style.display = "block";
    }
}
/* SEARCH PET */
function searchPet() {
    var search =
        document.getElementById("petSearch").value
        .toLowerCase()
        .trim();
    var pets =
        document.getElementsByClassName("pet-card");
    var message =
        document.getElementById("message");
    /* If search box is empty */
    if (search == "") {
        /* If category is selected, show that category */
        if (selectedCategory != "") {
            showPets(selectedCategory);
        } else {
            /* No category and no search */
            for (var i = 0; i < pets.length; i++) {
                pets[i].style.display = "none";
            }
            message.innerHTML =
                "Select a category or search for a pet.";
            message.style.display = "block";
        }
        return;
    }
    var found = 0;
    /* Search all pets if no category selected */
    for (var i = 0; i < pets.length; i++) {
        var petName =
            pets[i].getAttribute("data-name").toLowerCase();
        var petCategory =
            pets[i].getAttribute("data-category");
        /*
        If category is selected:
        search only inside that category.
        If category is NOT selected:
        search all pets.
        */
        if (
            petName.includes(search) &&
            (
                selectedCategory == "" ||
                petCategory == selectedCategory
            )
        ) {
            pets[i].style.display = "block";
            found++;
        } else {
            pets[i].style.display = "none";
        }
    }
    /* Search result message */
    if (found > 0) {
        message.style.display = "none";
    } else {
        message.innerHTML =
            "No pet found with that name.";
        message.style.display = "block";
    }
}
</script>

</body>

</html>

   