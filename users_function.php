<?php
session_start();
include("includes/connection.php");

// Add users Logic
if (isset($_POST["add_user"])) {
    $user = $_POST["user_name"];
    $user_role = $_POST["user_role"];
    $user_password = $_POST["user_password"];

    $sql = "INSERT INTO users(username,user_role,password) values('$user','$user_role','$user_password')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $_SESSION['status'] = "User Add Successfuly";
        header("location: users.php");
    } else {
        $_SESSION['status'] = "User Add Failed";
        header("location: users.php");
    }
    }


// Edit users Logic
if (isset($_POST["update_user"])) {
    $id = $_POST["update_user_id"];
    $user_name = $_POST["user_name"];
    $user_role = $_POST["user_role"];
    $user_password = $_POST["user_password"];
    $update_query = "UPDATE users SET username='$user_name', user_role='$user_role', password='$user_password' WHERE id = '$id'";
    $update_query_run = mysqli_query($conn, $update_query);

    if ($update_query_run) {
        $_SESSION["status"] = "Update User";
        header("location: users.php");
    }else{
        $_SESSION["status"] = "User Update Failed";
        header("location: users.php");
    }
}

// Delete users Logic
$id = $_GET["id"];
$delete_user = mysqli_query($conn, "DELETE FROM users WHERE id = $id");
header("location: users.php");
?>