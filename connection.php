<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_shop";



    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Database connection failed". mysqli_connect_error());
    }

?>