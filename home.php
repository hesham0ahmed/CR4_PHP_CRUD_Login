<?php

session_start();

if (isset($_SESSION["adm"])) {
    header("Location: dashboard.php");
}  // IF IAM A ADMIN -> REDIRECT TO dashboard.php

if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: login.php");
} // IF IAM A USER or ADMIN -> REDIRECT TO login.php

require_once "db_connect.php";

$sql = "SELECT * FROM users WHERE id = {$_SESSION["user"]}";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);
$sqlProducts = "SELECT * FROM products";
$resultProducts = mysqli_query($connect, $sqlProducts);

$layout = "";

// TO CHECK IF I GOT PRODUCTS TO SHOWN OR IN MY DB (num_rows) to see in var_dump($result) output
if (mysqli_num_rows($result) > 0) {
    while ($rowProduct = mysqli_fetch_assoc($resultProducts)) {
        $statusLabel = ($rowProduct["status"] == 0) ? "Available" : "<span style='color: red;'>Reserved</span>";
        $used = ($rowProduct["used"] == 0) ? "No" : "<span style='color: red;'>Yes</span>";
        $layout .= "  
        <div class='container'>
             <div>
   
    <div class='card my-2 mx-2' style='width: auto;'>
    <img src='pictures/{$rowProduct["picture"]}' class='card-img-top my-2' alt='...'>
    
    <div class='card-body'>
      <h5 class='card-title'>{$rowProduct["title"]}</h5>
      <p class='card-text'>{$rowProduct["short_description"]}</p>
    </div>
    <div class='but'>
        <a href='products/details_user.php?id={$rowProduct["id"]}' class='button2'>Show details</a>
    </div>
    <ul class='list-group list-group-flush'>
      <li class='list-group-item'>ISBN: {$rowProduct["ISBN"]}</li>
      <li class='list-group-item'>Status: <b>{$statusLabel}</b></li>
      <li class='list-group-item'>Used: <b>{$used}</b></li>
      <li class='list-group-item'>
    Publisher: <a href='products/publisher_user.php?publisher_name={$rowProduct["publisher_name"]}'>{$rowProduct["publisher_name"]}</a>
</li>
    </ul>
    </div>
  </div>
  </div>"; // .= is the same like +=
    }
} else {
    $layout .= "<h4>No Result or No Products</h4>"; // NO PRODUCTS THEN THIS IS THE OUTPUT
}
// CONVERT FORM SQL TO SHOW IN HTTP / PHP
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?= $row["first_name"] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-black ">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="dashboard.php"><b>CR4 Dashboard</b></a>
            <img src="pictures/<?= $row["picture"] ?>" alt="user pic" width="40" height="40" class="mx-2">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    </li>
                    <li class="nav-item mx-2">

                        <a type="button" class="additem" href="products/create.php">
                            <span class="additem_text">Add Item</span>
                            <span class="additem_icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" stroke-width="2" stroke-linejoin="round" stroke-linecap="round" stroke="currentColor" height="24" fill="none" class="svg">
                                    <line y2="19" y1="5" x2="12" x1="12"></line>
                                    <line y2="12" y1="12" x2="19" x1="5"></line>
                                </svg></span>
                        </a>
                    </li>
                    <li></li>

                    <!-- <li class="nav-item">
                        <a class="nav-link text-white btn4 mx-2" aria-current="page" href="products/index.php">Products</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link text-white btn3 mx-2" href="update.php?id=<?= $row["id"] ?>">Edit Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white btn3 mx-2" href="logout.php?logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--NAVBAR END-->
    <h6 class="mx-3 my-3">Welcome " <?= $row["first_name"] . " " . $row["last_name"] ?> "</h6>

    <div class="container">
        <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-xs-1">

            <?= $layout ?>
        </div>
    </div>

    <!-- FOOTER -->

    <section class="mt-4">
        <!-- Footer -->
        <footer class="text-center text-white" style="background-color: #0a4275;">
            <!-- Grid container -->
            <div class="container p-1 pb-0">
                <!-- Section: CTA -->
                <section class="">
                    <p class="d-flex justify-content-center align-items-center">

                    <ul class="nav justify-content-center d-flex">
                        <li class="ms-3"><i class="bi bi-twitter"></i></li>
                        <li class="ms-3"><i class="bi bi-facebook"></i></li>
                        <li class="ms-3"><i class="bi bi-instagram"></i></li>
                        <li class="ms-3"><i class="bi bi-youtube"></i></li>
                    </ul>
                    </p>
                </section>
                <!-- Section: CTA -->
            </div>
            <!-- Grid container -->

            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                © 2023 Copyright:
                <a class="text-white" href="index.php">CodeFactory</a>
            </div>
            <!-- Copyright -->
        </footer>
        <!-- Footer -->
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>