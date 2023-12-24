<?php
session_start();
include("includes/connection.php");

// Add company Logic
if (isset($_POST["add_company"])) {
    $company = $_POST["company_name"];

    $sql = "INSERT INTO company_info(company_name) values('$company')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $_SESSION['status'] = "company Add Successfuly";
        header("location: company.php");
    } else {
        $_SESSION['status'] = "company Add Failed";
        header("location: company.php");
    }
    }


// Edit company Logic
if (isset($_POST["update_company"])) {
    $id = $_POST["update_id"];
    $company_name = $_POST["company_name"];
    $update_query = "UPDATE company_info SET company_name='$company_name' WHERE id = '$id'";
    $update_query_run = mysqli_query($conn, $update_query);

    if ($update_query_run) {
        $_SESSION["status"] = "Update company";
        header("location: company.php");
    }else{
        $_SESSION["status"] = "Update Failed";
        header("location: company.php");
    }
}

// Delete company Logic
$id = $_GET["id"];
$delete_company = mysqli_query($conn, "DELETE FROM company_info WHERE id = $id");
header("location: company.php");
?>