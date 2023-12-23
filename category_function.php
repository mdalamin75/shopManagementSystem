<?php
session_start();
include("includes/connection.php");

// Add Category Logic
if (isset($_POST["add_category"])) {
    $category = $_POST["category_name"];

    $sql = "INSERT INTO category_info(category_name) values('$category')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $_SESSION['status'] = "Category Add Successfuly";
        header("location: category.php");
    } else {
        $_SESSION['status'] = "Category Add Failed";
        header("location: category.php");
    }
    }


// Edit Category Logic
if (isset($_POST["update_category"])) {
    $id = $_POST["update_id"];
    $category_name = $_POST["category_name"];
    $update_query = "UPDATE category_info SET category_name='$category_name' WHERE id = '$id'";
    $update_query_run = mysqli_query($conn, $update_query);

    if ($update_query_run) {
        $_SESSION["status"] = "Update Category";
        header("location: category.php");
    }else{
        $_SESSION["status"] = "Update Failed";
        header("location: category.php");
    }
}

// Delete Category Logic
$id = $_GET["id"];
$delete_category = mysqli_query($conn, "DELETE FROM category_info WHERE id = $id");
header("location: category.php");
?>