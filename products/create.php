<?php
require_once "../db_connect.php";
require_once "../file_upload.php";

// CRUD LOGIN

session_start();

// if (isset($_SESSION["user"])) {
//     header("Location: ../home.php");
// }

if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: ../login.php");
}

$result = mysqli_query($connect, "SELECT * FROM suppliers");

$options = "";

while ($row = mysqli_fetch_assoc($result)) {
    $options .= "<option value='{$row["supplierId"]}'>{$row["sup_name"]}</option>";
}

if (isset($_POST["create"])) {
    $supplier = isset($_POST["supplier"]); // ? $_POST["supplier"] : null;
    // CRUD LOGIN


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
    $status = isset($_POST['status']) ? $_POST['status'] : '';
    $used = isset($_POST['used']) ? $_POST['used'] : '';
    $publish_date = $_POST['publish_date'];



    $sql = "INSERT INTO products (`title`, `picture`, `ISBN`, `big_description`, `short_description`, `categorie`, `author_firstname`, `author_lastname`, `publisher_name`, `publisher_address`, `price`, `publish_date`, `status`, `used`, `fk_supplierId`) VALUES ('$title','{$picture[0]}','$ISBN', '$big_description', '$short_description',  '$categorie', '$author_firstname', '$author_lastname', '$publisher_name', '$publisher_address','$price', '$publish_date', '$status', '$used',$supplier)";


    if (mysqli_query($connect, $sql)) {
        echo "<div class='alert alert-success' role='alert'>
                New record has been created, {$picture[1]}
              </div>";
        header("refresh: 3; url=index.php");
    } else {
        echo "<div class='alert alert-danger' role='alert'>
                Error found: " . mysqli_error($connect) . "
              </div>";
    }
}
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
        <div class="code-loader">
            <div>{Create a BOOK, DVD, MEDIA entry}
            </div>
        </div>
        <form method="POST" enctype="multipart/form-data" class="form">
            <div class="mb-3 mt-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" aria-describedby="title" name="title">
            </div>
            <div class="mb-3">
                <label for="ISBN" class="form-label">ISBN</label>
                <input type="number" class="form-control" id="ISBN" aria-describedby="ISBN" name="ISBN">
            </div>
            <div class="mb-3 mt-3">
                <label for="short_description" class="form-label">Short Description</label>
                <input type="text" class="form-control" id="short_description" aria-describedby="short_description" name="short_description" placeholder="max. 200 Character">
            </div>
            <div class="mb-3 mt-3">
                <label for="big_description" class="form-label">Big Description</label>
                <input type="text" class="form-control" id="big_description" aria-describedby="big_description" name="big_description" placeholder="max. 400 Character">
            </div>
            <div class="mb-3 mt-3">
                <label for="categorie" class="form-label">Categorie</label>
                <input type="text" class="form-control" id="categorie" aria-describedby="categorie" name="categorie">
            </div>
            <div class="mb-3 mt-3">
                <label for="author_firstname" class="form-label">Author Firstname</label>
                <input type="text" class="form-control" id="author_firstname" aria-describedby="author_firstname" name="author_firstname">
            </div>
            <div class="mb-3 mt-3">
                <label for="author_lastname" class="form-label">Author Lastname</label>
                <input type="text" class="form-control" id="author_lastname" aria-describedby="author_lastname" name="author_lastname">
            </div>
            <div class="mb-3 mt-3">
                <label for="publisher_name" class="form-label">Publisher Name</label>
                <input type="text" class="form-control" id="publisher_name" aria-describedby="publisher_name" name="publisher_name">
            </div>
            <div class="mb-3 mt-3">
                <label for="publisher_address" class="form-label">Publisher Address</label>
                <input type="text" class="form-control" id="publisher_address" aria-describedby="publisher_address" name="publisher_address">
            </div>
            <div class="mb-3 mt-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" aria-describedby="price" name="price">
            </div>
            <div class="mb-3">
                <label for="supplier" class="form-label">Supplier</label>

                <select name="supplier" class="form-control">
                    <option value="null" selected> ... </option>
                    <?= $options ?>
                </select>
            </div>
            <div class="mb-3 mt-3">
                <label for="publish_date" class="form-label">Publish Date</label>


                <input type="date" class="form-control" id="publish_date" aria-describedby="publish_date" name="publish_date">
            </div>


            <fieldset class="border border rounded p-3">
                <p><b>Product is here:</b></p>
                <div>
                    <input type="radio" id="here" name="status" value="0" />
                    <label for="staus">Avialable</label>
                </div>
                <div>
                    <input type="radio" id="nothere" name="status" value="1" />
                    <label for="staus">Reserved</label>
                </div>
            </fieldset>

            <fieldset class="border border rounded p-3 mt-3">
                <p><b>Product is Used:</b></p>
                <div>
                    <input type="radio" id="notUsed" name="used" value="0" />
                    <label for="used">No</label>
                </div>
                <div>
                    <input type="radio" id="used" name="used" value="1" />
                    <label for="used">Yes</label>
                </div>
            </fieldset>

            <div class="mb-3">
                <label for="picture" class="form-label">Picture</label>
                <input type="file" class="form-control" id="picture" aria-describedby="picture" name="picture">
            </div>

            <!-- <button name="create" type="submit" class="btn btn-primary">Create product</button> -->

            <button name="create" type="submit" style="background: linear-gradient(to bottom, #66a6ff  0%, #4dc7d9 100%);">
                <span>Create Product</span>
            </button>

            <button name="button" style="background: linear-gradient(to bottom, #4dc7d9 0%, #66a6ff 100%)" ;>
                <a href="index.php" style="text-decoration: none; color:white;">Back Home</a>
            </button>

            <!-- <a href="index.php" class="btn btn-warning">Back Home</a> -->
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>