<?php
session_start();
include("includes/connection.php");

// Add product Logic
if (isset($_POST["add_product"])) {
    $category = $_POST["category"];
    $product = $_POST["product_name"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $company = $_POST["company"];
    $sql = "INSERT INTO product_info(category,product_name,price,quantity,company) values('$category','$product','$price','$quantity','$company')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $_SESSION['status'] = "Product Add Successfuly";
        header("location: product.php");
    } else {
        $_SESSION['status'] = "Product Add Failed";
        header("location: product.php");
    }
    }


// Edit product Logic
if (isset($_POST["update_product"])) {
    $id = $_POST["update_id"];
    $category = $_POST["category"];
    $product_name = $_POST["product_name"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $company = $_POST["company"];
    $update_query = "UPDATE product_info SET category='$category', product_name='$product_name', price='$price', quantity='$quantity', company='$company'  WHERE id = '$id'";
    $update_query_run = mysqli_query($conn, $update_query);

    if ($update_query_run) {
        $_SESSION["status"] = "Update product";
        header("location: product.php");
    }else{
        $_SESSION["status"] = "Update Failed";
        header("location: product.php");
    }
}

// Delete product Logic
$id = $_GET["id"];
$delete_product = mysqli_query($conn, "DELETE FROM product_info WHERE id = $id");
header("location: product.php");
?>