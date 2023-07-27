<?php
require_once "../db_connect.php";
require_once "../file_upload.php";


// 
session_start();

if (isset($_SESSION["user"])) {
    header("Location: ../home.php");
}

if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: ../login.php");
}
// 

$id = $_GET["id"]; // to take the value from the parameter "id" in the url 
$sql = "SELECT * FROM products WHERE id = $id";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);

$resultSuppliers = mysqli_query($connect, "SELECT * FROM suppliers");
$options = "";

while ($supRow = mysqli_fetch_assoc($resultSuppliers)) {
    if ($row["fk_supplierId"] == $supRow["supplierId"]) {
        $options .= "<option selected value='{$supRow["supplierId"]}'>{$supRow["sup_name"]}</option>";
    } else {
        $options .= "<option value='{$supRow["supplierId"]}'>{$supRow["sup_name"]}</option>";
    }
}

if (isset($_POST["update"])) {

    $title = $_POST['title'];
    $ISBN = $_POST["ISBN"];
    $picture = fileUpload($_FILES["picture"], "product");
    $short_description = $_POST['short_description'];
    $big_description = $_POST['big_description'];
    $categorie = $_POST['categorie'];
    $author_firstname = $_POST['author_firstname'];
    $author_lastname = $_POST['author_lastname'];
    $publisher_name = $_POST['publisher_name'];
    $publisher_address = $_POST['publisher_address'];
    $price = $_POST['price'];
    $publish_date = $_POST['publish_date'];
    $supplier = $_POST["supplier"];
    $status = $_POST['status'];
    $used = $_POST['used'];

    /* checking if a picture has been selected  */
    if ($_FILES["picture"]["error"] == 0) {
        if ($row["picture"] != "product.png") {
            unlink("../pictures/$row[picture]");
        }

        $sql = "UPDATE products SET title = '$title', picture = '$picture[0]', ISBN = '$ISBN', big_description = '$big_description', short_description = '$short_description', categorie = '$categorie', author_firstname = '$author_firstname', author_lastname = '$author_lastname', publisher_name = '$publisher_name', publisher_address = '$publisher_address', price = '$price', publish_date = '$publish_date', fk_supplierId = $supplier, status = '$status',used = '$used' WHERE id = {$id}";
    } else {
        $sql = "UPDATE products SET title = '$title', ISBN = '$ISBN', big_description = '$big_description', short_description = '$short_description', categorie = '$categorie', author_firstname = '$author_firstname', author_lastname = '$author_lastname', publisher_name = '$publisher_name', publisher_address = '$publisher_address', price = '$price', publish_date = '$publish_date', fk_supplierId = $supplier, status = '$status',used = '$used' WHERE id = {$id}";
    }

    if (mysqli_query($connect, $sql)) {
        echo "<div class='alert alert-warning' role='alert'>
            Product has been updated, {$picture[1]}
          </div>";
        header("refresh: 3; url= details.php?id={$row["id"]}");
    } else {
        echo "<div class='alert alert-danger' role='alert'>
            error found, {$picture[1]}
          </div>";
    }
}
mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CR4 Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-black d-flex">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="index.php"><b>CR4 Library</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    </li>
                    <li class="nav-item">

                        <a type="button" class="additem" href="create.php">
                            <span class="additem_text">Add Item</span>
                            <span class="additem_icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" stroke-width="2" stroke-linejoin="round" stroke-linecap="round" stroke="currentColor" height="24" fill="none" class="svg">
                                    <line y2="19" y1="5" x2="12" x1="12"></line>
                                    <line y2="12" y1="12" x2="19" x1="5"></line>
                                </svg></span>
                        </a>
                    </li>
                    <li></li>
                    <li class="dashboard"><a class="btn3 nav-link text-white mx-3" href="../dashboard.php">Dashboard</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!--NAVBAR END-->


    <div class="container mt-5">
        <h2>Update a <u>Existing</u> entry</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3 mt-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" aria-describedby="title" name="title" value="<?= $row["title"] ?>">
            </div>
            <div class="mb-3">
                <label for="ISBN" class="form-label">ISBN</label>
                <input type="number" class="form-control" id="ISBN" aria-describedby="ISBN" name="ISBN" value="<?= $row["ISBN"] ?>">
            </div>
            <div class="mb-3 mt-3">
                <label for="short_description" class="form-label">Short Description</label>
                <input type="text" class="form-control" id="short_description" aria-describedby="short_description" name="short_description" value="<?= $row["short_description"] ?>">
            </div>
            <div class="mb-3 mt-3">
                <label for="big_description" class="form-label">Big Description</label>
                <input type="text" class="form-control" id="big_description" aria-describedby="big_description" name="big_description" value="<?= $row["big_description"] ?>">
            </div>
            <div class="mb-3 mt-3">
                <label for="categorie" class="form-label">Categorie</label>
                <input type="text" class="form-control" id="categorie" aria-describedby="categorie" name="categorie" value="<?= $row["categorie"] ?>">
            </div>
            <div class="mb-3 mt-3">
                <label for="author_firstname" class="form-label">Author Firstname</label>
                <input type="text" class="form-control" id="author_firstname" aria-describedby="author_firstname" name="author_firstname" value="<?= $row["author_firstname"] ?>">
            </div>
            <div class="mb-3 mt-3">
                <label for="author_lastname" class="form-label">Author Lastname</label>
                <input type="text" class="form-control" id="author_lastname" aria-describedby="author_lastname" name="author_lastname" value="<?= $row["author_lastname"] ?>">
            </div>
            <div class="mb-3 mt-3">
                <label for="publisher_name" class="form-label">Publisher Name</label>
                <input type="text" class="form-control" id="publisher_name" aria-describedby="publisher_name" name="publisher_name" value="<?= $row["publisher_name"] ?>">
            </div>
            <div class="mb-3 mt-3">
                <label for="publisher_address" class="form-label">Publisher Address</label>
                <input type="text" class="form-control" id="publisher_address" aria-describedby="publisher_address" name="publisher_address" value="<?= $row["publisher_address"] ?>">
            </div>
            <div class="mb-3 mt-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" aria-describedby="price" name="price" value="<?= $row["price"] ?>">
            </div>
            <div class="mb-3 mt-3">
                <label for="publish_date" class="form-label">Publish Date</label>
                <input type="date" class="form-control" id="publish_date" aria-describedby="publish_date" name="publish_date" value="<?= $row["publish_date"] ?>">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Supplier</label>
                <select name="supplier" class="form-control">
                    <?= $options ?>
                </select>
            </div>

            <fieldset class="border border rounded p-3">
                <p><b>Product is here:</b></p>
                <div>
                    <input type="radio" id="here" name="status" value="0" <?= ($row["status"] == 0) ? "checked" : ""; ?> />
                    <label for="staus">Avialable</label>
                </div>
                <div>
                    <input type="radio" id="nothere" name="status" value="1" <?= ($row["status"] == 1) ? "checked" : ""; ?> />
                    <label for="staus">Reserved</label>
                </div>
            </fieldset>

            <fieldset class="border border rounded p-3 mt-3">
                <p><b>Product is Used:</b></p>
                <div>
                    <input type="radio" id="notUsed" name="used" value="0" <?= ($row["used"] == 0) ? "checked" : ""; ?> />
                    <label for="staus">No</label>
                </div>
                <div>
                    <input type="radio" id="used" name="used" value="1" <?= ($row["used"] == 1) ? "checked" : ""; ?> />
                    <label for="staus">Yes</label>
                </div>
            </fieldset>
            <br>

            <div class="mb-3">
                <label for="picture" class="form-label">Product Picture</label>
                <!-- Preview Picture -->
                <img src="../pictures/<?= $row["picture"] ?>" alt="user pic" width="75" height="75" class="mx-2 mb-3 rounded"> <!---->
                <input type="file" class="form-control" id="picture" aria-describedby="picture" name="picture">
            </div>

            <!-- <button name="update" type="submit" class="btn btn-primary">Update product</button> -->

            <button name="update" type="submit" style="background: linear-gradient(to bottom, #66a6ff  0%, #4dc7d9 100%);">
                <span>Update Product</span>
            </button>

            <button name="button" style="background: linear-gradient(to bottom, #4dc7d9 0%, #66a6ff 100%)" ;>
                <a href="index.php" style="text-decoration: none; color:white;">Back Home</a>
            </button>
            <!-- <a href="index.php" class="btn btn-warning">Back to home page</a> -->
        </form>
    </div>
    <!-- FOOTER -->

    <section class="mt-4">
        <!-- Footer -->
        <footer class="text-center text-white" style="background-color: #0a4275;">
            <!-- Grid container -->
            <div class="container p-4 pb-0">
                <!-- Section: CTA -->
                <section class="">
                    <p class="d-flex justify-content-center align-items-center">
                        <span class="me-3">Register for free</span>
                        <button type="button" class="btn btn-outline-light btn-rounded">
                            Sign up!
                        </button>
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

</body>

</html>