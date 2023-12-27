<?php
session_start();
include("includes/connection.php");

// Add product Logic
if (isset($_POST["sale_product"])) {
    $product = $_POST["product"];
    $sale_quantity = $_POST["sale_quantity"];
    $sale_date = date('Y-m-d', strtotime($_POST["sale_date"]));

    $product_sql = "SELECT price FROM product_info WHERE id=$product";
    $product_sql_run = mysqli_query($conn, $product_sql);

    if ($product_sql_run) {
        $row = $product_sql_run->fetch_assoc();
        $price = $row['price'];

        // Calaulate the total price
        $total_price = $sale_quantity * $price;

        // insert the sale record into the sales table
        $sql = "INSERT INTO sale_info(product_id,sale_quantity,date,total_sale) values('$product','$sale_quantity','$sale_date', '$total_price')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_SESSION['status'] = "Sale Product Successfuly";
            header("location: sale.php");
        } else {
            $_SESSION['status'] = "Product Sale Failed";
            header("location: sale.php");
        }
        }
}else{
    echo "Error fetching product price: ";
}

// Edit sale product Logic
if (isset($_POST["update_sale"])) {
    $id = $_POST["update_id"];
    $product = $_POST["product"];
    $sale_quantity = $_POST["sale_quantity"];
    $total_sale = $_POST["total_sale"];
    $sale_date = date('Y-m-d', strtotime($_POST["sale_date"]));
    $update_query = "UPDATE sale_info SET product_id='$product', sale_quantity='$sale_quantity', total_sale='$total_sale', date='$sale_date'  WHERE sale_id = '$id'";
    $update_query_run = mysqli_query($conn, $update_query);

    if ($update_query_run) {
        $_SESSION["status"] = "Update Sale Product";
        header("location: sale.php");
    }else{
        $_SESSION["status"] = "Update Failed Sale Product";
        header("location: sale.php");
    }
}

// Delete product Logic
$id = $_GET["id"];
$delete_product = mysqli_query($conn, "DELETE FROM sale_info WHERE sale_id = $id");
header("location: sale.php");
?>