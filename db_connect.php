<?php

$localhost = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "be19_cr4_heshamahmed_biglibrary";

// create connection
$connect = mysqli_connect($localhost, $username, $password, $dbname);

// check connection
if (!$connect) {
    die("Connection failed");
}
