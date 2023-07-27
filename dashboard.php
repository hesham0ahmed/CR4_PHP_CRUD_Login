<?php

session_start();

if (isset($_SESSION["user"])) {
    header("Location: home.php");
} // IF IAM A USER -> REDIRECT TO home.php

if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: login.php");
} // IF IAM A USER or ADMIN -> REDIRECT TO login.php

require_once "db_connect.php";

/* ======== BEGIN OF USER DATA ======== */

$sql = "SELECT * FROM users WHERE id = {$_SESSION["adm"]}"; // SELECT ALL DATA AND QUERY FETCH 
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);
$sqlUsers = "SELECT * FROM users WHERE status != 'adm'";
$resultUsers = mysqli_query($connect, $sqlUsers);
$layout = "";

if (mysqli_num_rows($resultUsers) > 0) {
    while ($userRow = mysqli_fetch_assoc($resultUsers)) {
        $layout .=
            "<tr> 
        <td>{$userRow['id']}</td>
        <td><img class='img-thumbnail' width='60' height='60' src='pictures/{$userRow["picture"]}'></td>
       <td class='fName'>{$userRow['first_name']}</td>
       <td class='lName'>{$userRow['last_name']}</td>
       <td class='emailtha'>{$userRow['email']}</td>
        <td class='usst'>{$userRow['status']}</td>
        <td> <a href='update.php?id={$userRow["id"]}' class='btn btn-outline-warning btn-rounded text-black'>Update User</a></td>
        <td><a href='deleteUser.php?id={$userRow["id"]}' class='btn btn-danger btn-rounded'>Delete User</a></td>
   </tr> ";
    }
} else {
    $layout .= "No results found!";
}
/* ======== END OF USER DATA ======== */

/* ======== BEGIN OF PRODUCTS DATA ======== */

$sqlProducts = "SELECT * FROM `products`";
$resultProducts = mysqli_query($connect, $sqlProducts);
$sqlUser = "SELECT * FROM users WHERE id = {$_SESSION["adm"]}";
$resultUser = mysqli_query($connect, $sqlUser);
$userRows = null;
if ($resultUser) {
    $userRows = mysqli_fetch_assoc($resultUser);
} else {
    // Handle the case when the query fails (optional)
    // For example, you can log an error or display a message to the user.
}

$layoutProducts = "";

if (mysqli_num_rows($resultProducts) > 0) {
    while ($rows = mysqli_fetch_assoc($resultProducts)) {
        $statusLabel = ($rows["status"] == 0) ? "Available" : "<span style='color: red;'>Reserved</span>";
        $used = ($rows["used"] == 0) ? "No" : "<span style='color: red;'>Yes</span>";
        $layoutProducts .=
            "<tr> 
        <td>{$rows['id']}</td>
        <td><img class='img-thumbnail' width='60' height='60' src='pictures/{$rows["picture"]}'></td>
       <td class='titleRow'>{$rows['title']}</td>
       <td class='isbn'>{$rows['ISBN']}</td>
       <td class='categ'>{$rows['categorie']}</td>
        <td class='availa'>{$statusLabel}</td>
        <td class='usedP'>{$used}</td>
        <td> <a href='products/update.php?id={$rows["id"]}' class='btn btn-outline-warning btn-rounded text-black'>Update Product</a></td>
        <td><a href='products/delete.php?id={$rows["id"]}' class='btn btn-danger btn-rounded'>Delete Product</a></td>
   </tr> ";
    }
} else {
    $layoutProducts .= "No results found!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?= $row["first_name"] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
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
                    <li></li>
                    <li class="nav-item">
                        <a class="nav-link text-white btn4 mx-2" aria-current="page" href="products/index.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white btn3 mx-2" href="update.php?id=<?= $row["id"] ?>">Edit Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white btn3 mx-2" href="registerAdmin.php">Create User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white btn3 mx-2" href="logout.php?logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--NAVBAR END-->
    <div class="my-3 alert">
        <h4 class="text-center">Youre an Administrator, <?= $row["first_name"] . " " . $row["last_name"] ?></h4>
        <p class="text-center">** you have the rights to CRUD -> Users / Products ! **</p>
    </div>
    <!-- TABLE USERS -->
    <div class=" bg-danger bg-opacity-10">
        <hr>
        <h2 class="text-center">TABLE USER</h2>
        <hr>
    </div>
    <div class="table1 border-top border-bottom border-5 rounded-top rounded-bottom border-warning">
        <table class="table table-striped text-center table-responsive-md">
            <thead>
                <tr>
                    <th scope="col">ID #</th>
                    <th scope="col" class="img-thumbnail">Picture</th>
                    <th scope="col" class="fName">Firstname</th>
                    <th scope="col" class="lName">Lastname</th>
                    <th scope="col" class="emailth">Email</th>
                    <th scope="col" class="usst">User Status</th>
                    <th scope="col">Update</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?= $layout; ?>
            </tbody>
        </table>
    </div>

    <!-- TABLE END -->

    <!-- TABLE PRODUCTS-->
    <br>
    <div class=" bg-primary bg-opacity-10">
        <hr>
        <h2 class="text-center">TABLE PRODUCTS</h2>
        <hr>
    </div>

    <div class="table1 border-top border-bottom border-5 rounded-top rounded-bottom border-primary">
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th scope="col">ID #</th>
                    <th scope="col" class="pictImg">Picture</th>
                    <th scope="col" class="titleRow">Title</th>
                    <th scope="col" class="isbn">ISBN</th>
                    <th scope="col" class="categ">Categorie</th>
                    <th scope="col" class="availa">Available</th>
                    <th scope="col" class="usedP">Used</th>
                    <th scope="col">Update</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?= $layoutProducts; ?>
            </tbody>
        </table>
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