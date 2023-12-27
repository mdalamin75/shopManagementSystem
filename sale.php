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
            <!--==============================Add sale start here ====================================-->
            <?php 
              if (isset($_SESSION["status"]) && $_SESSION["status"] != "") {
                
                ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Hurray!</strong> <?php echo $_SESSION["status"]; ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
                unset($_SESSION["status"]);
              }
            ?>
            <!-- Button trigger modal -->
            <div class="d-flex justify-content-between align-items-center mb-5">
              <h3>Sale Products List</h3>
              <button type="button" class="btn myBtn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa-solid fa-minus"></i>
                Sale Product
              </button>
            </div>

            <!-- Modal Start-->
            <div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sale Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="sale_function.php" method="post">
                      <div class="d-flex flex-column justify-content-center gap-3">
                      <div class="d-flex justify-content-between align-items-center mb-4">
                            <label for="product">Product</label>
                            <select name="product">
                                <option value="">Select Product</option>
                                <?php
                                $query = "SELECT id, product_name FROM product_info";
                                $result = $conn->query($query);
                                if ($result->num_rows > 0) {
                                    while ($optionData = $result->fetch_assoc()) {
                                        $option = $optionData['product_name'];
                                        $id = $optionData['id'];
                                        ?>
                                        <option value="<?php echo $id; ?>">
                                            <?php echo $option; ?>
                                        </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="sale_quantity">Quantity</label>
                            <input type="number" name="sale_quantity">
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="sale_date">Sale Date</label>
                            <input type="date" name="sale_date">
                        </div>
                        <input type="submit" name="sale_product" value="Sale Product" class="myBtn">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!--==============================Add sale End here ====================================-->
            <!--==============================View sale start here ====================================-->
              <?php
                // View sale data
                $query = "SELECT * FROM sale_info";
                $data = mysqli_query($conn, $query);
                if (mysqli_num_rows($data) > 0) {
                  }
                // fatch data from product_info table base on id = product_name
                $product_list = array();
                $product_query = "SELECT * FROM product_info";
                $product_query_run = $conn->query($product_query);
                while ($products = $product_query_run->fetch_assoc()) {
                  $product_id = $products['id'];
                  $product_name = $products['product_name'];
                  $product_list[$product_id] =  $product_name;
                }
              ?>
              <table id="sale_table" class="table table-light table-striped table-bordered rounded text-center">
                <thead>
                    <tr>
                      <th>No</th>
                      <th>Date</th>
                      <th>Product Name</th>
                      <th>Quantity</th>
                      <th>Total Sale</th>
                      <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($data)) { 
                      $sale_product = $row['product_id'];
                      ?>
                        <tr>
                            <td class="sale_id">
                                <?php echo $i++ ?>
                            </td>
                            <td>
                                <?php echo $row['date'] ?>
                            </td>
                            <td class="text-capitalize">
                                <?php echo $product_list[$sale_product] ?>
                            </td>
                            <td>
                                <?php echo $row['sale_quantity'] ?>
                            </td>
                            <td>
                                <?php echo $row['total_sale'] ?>
                            </td>
                            <?php echo "<td>
                                            <a href=\"#\" class=\"actionBtn edit_sale\" data-bs-toggle=\"modal\"  >Edit</a> | 
			                                <a href=\"sale_function.php?id=$row[sale_id]\" class=\"actionBtn\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a>
                                        </td>"
                                ?>
                        </tr>
                    <?php } ?>
                </tbody>
              </table>
            <!--==============================View sale End here ====================================-->
            <!--==============================Edit sale start here ====================================-->
            <!-- Edit Model -->
            <div class="modal fade" id="editsale" tabindex="-1"  aria-labelledby="editModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit sale</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="sale_function.php" method="post">
                      <div class="d-flex flex-column justify-content-center">
                        <input type="hidden" name="update_id" id="update_id">
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="sale_date">Sale Date</label>
                            <input type="date" name="sale_date" id="sale_date">
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <label for="product">Product</label>
                            <select name="product" id="product">
                                <option value="">Select Product</option>
                                <?php
                                $query = "SELECT id, product_name FROM product_info";
                                $result = $conn->query($query);
                                if ($result->num_rows > 0) {
                                    while ($optionData = $result->fetch_assoc()) {
                                        $option = $optionData['product_name'];
                                        $id = $optionData['id'];
                                        ?>
                                        <option value="<?php echo $id; ?>">
                                            <?php echo $option; ?>
                                        </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <!-- <input type="text" name="product" id="product"> -->
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="sale_quantity">Quantity</label>
                            <input type="text" name="sale_quantity" id="sale_quantity">
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="total_sale">Total Sale</label>
                            <input type="text" name="total_sale" id="total_sale">
                        </div>
                        <input type="submit" name="update_sale" value="Update" class="myBtn">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- Modal End-->
            <!--==============================Edit sale End here ====================================-->
            </main>
        </div>
    </div>
</div>
<?php
include "includes/footer.php";
?>