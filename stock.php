<?php
session_start();
include("includes/connection.php");
include "includes/header.php";
?>
<div id="main_content">
    <div class="row">
        <div class="col-2 pe-0">
            <?php
              include "includes/menu.php";
            ?>
        </div>
        <div class="col-10 pt-5 ps-0 mt-5">
            <main>
            <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-5">
              <h3>Available Stocks</h3>
            </div>
            <!--==============================View stock start here ====================================-->
              <?php
                $i = 1;
                $select_query = "SELECT product_name, SUM(quantity) as total_quantity FROM product_info GROUP BY product_name ";
                $result = mysqli_query($conn, $select_query);
              ?>
              <table id="stock_table" class="table table-light table-striped table-bordered rounded text-center">
                <thead>
                    <tr>
                      <th>No</th>
                      <th>Product Name</th>
                      <th>Available Stocks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if ($result) {
                            while ($row = $result->fetch_assoc()) {
                                $product_name = $row['product_name'];
                                $total_quantity = $row['total_quantity'];
        
                                $update_stock_query = "UPDATE stock_info SET total_stock = $total_quantity WHERE stock_id IN (SELECT id FROM product_info WHERE product_name = '$product_name')";
                                mysqli_query($conn, $update_stock_query);
                                ?>                        <tr>
                                <td class="stock_id">
                                    <?php echo $i++ ?>
                                </td>
                                <td>
                                    <?php echo $product_name ?>
                                </td>
                                <td class="text-capitalize">
                                    <?php echo $total_quantity ?>
                                </td>
                            </tr> 
                            <?php }
                        }
                    ?>
                </tbody>
              </table>
            <!--==============================View stock End here ====================================-->
            </main>
        </div>
    </div>
</div>
<?php
include "includes/footer.php";
?>