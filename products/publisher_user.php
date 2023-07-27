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
          <li class="nav-item">
            <a class="nav-link text-white btn3" href="../logout.php?logout">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!--NAVBAR END-->

  <?php
  require_once "../db_connect.php";

  if (isset($_GET['publisher_name'])) {
    $publisher_name = $_GET['publisher_name'];

    $sql = "SELECT * FROM `products` WHERE `publisher_name` = '$publisher_name'";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) > 0) {
      echo "
      <div class='container d-flex justify-content-center'>
      <div class='row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-xs-1'>";

      while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['title'];
        $productImage = $row['picture'];
        $short_description = $row['short_description'];
        $big_description = $row['big_description'];
        $categorie = $row['categorie'];
        $author_firstname = $row['author_firstname'];
        $author_lastname = $row['author_lastname'];
        $publisher_name = $row['publisher_name'];
        $publisher_address = $row['publisher_address'];
        $publish_date = $row['publish_date'];
        $statusLabel = ($row["status"] == 0) ? "Available" : "<span style='color: red;'>Reserved</span>";
        $used = ($row["used"] == 0) ? "No" : "<span style='color: red;'>Yes</span>";


        echo "
        <div class='card my-2 mx-2' style='width: 18rem;'>
        <img src='../pictures/{$row["picture"]}' class='card-img-top my-2' alt='...'>
        <div class='card-body'>
          <h5 class='card-title'>{$row["title"]}</h5>
          <p class='card-text'>{$row["short_description"]}</p>
        </div>
        <a href='details_user.php?id={$row["id"]}' class='btn btn-warning' style='width: auto;'>Show details</a>
               <a href='../home.php' class='btn btn-success my-2' style='width: auto;'>Go Back</a>
               <ul class='list-group list-group-flush'>
          <li class='list-group-item'>ISBN: {$row["ISBN"]}</li>
          <li class='list-group-item'>Status: <b>{$statusLabel}</b></li>
          <li class='list-group-item'>Used: <b>{$used}</b></li>
          <li class='list-group-item'>
        Publisher: {$row["publisher_name"]}
        </li>
        </ul>
        </div>";
      }
      echo "
      </div>
      </div>";
    } else {
      echo 'Publisher have no Entries.';
    }
  } else {
    echo 'Invalid request.';
  };

  ?>

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