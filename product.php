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
            <!--==============================Add Product start here ====================================-->
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
            <div class="d-flex justify-content-between align-items-center mb-5">
              <h3>Products</h3>
              <!-- Button trigger modal -->
              <button type="button" class="btn myBtn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa-solid fa-plus"></i>
                Add Product
              </button>
            </div>

            <!-- Modal Start-->
            <div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="product_function.php" method="post">
                      <div class="d-flex flex-column justify-content-center gap-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="category">Category</label>
                            <select name="category">
                                <option value="">Select Category</option>
                                <?php
                                $query = "SELECT id, category_name FROM category_info";
                                $result = $conn->query($query);
                                if ($result->num_rows > 0) {
                                    while ($optionData = $result->fetch_assoc()) {
                                        $option = $optionData['category_name'];
                                        $id = $optionData['id'];
                                        ?>
                                        <option value="<?php echo $option; ?>">
                                            <?php echo $option; ?>
                                        </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="product_name">Product Name</label>
                            <input type="text" name="product_name" placeholder="Enter Product Name">
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="price">Price</label>
                            <input type="number" name="price" placeholder="Enter Price">
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" placeholder="Enter Quantity">
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="company">Company</label>
                            <select name="company">
                                <option value="">Select Company</option>
                                <?php
                                $query = "SELECT id, company_name FROM company_info";
                                $result = $conn->query($query);
                                if ($result->num_rows > 0) {
                                    while ($optionData = $result->fetch_assoc()) {
                                        $option = $optionData['company_name'];
                                        $id = $optionData['id'];
                                        ?>
                                        <option value="<?php echo $option; ?>">
                                            <?php echo $option; ?>
                                        </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="date">Date</label>
                            <input type="date" name="date">
                        </div>
                        <input type="submit" name="add_product" value="Add product" class="myBtn">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!--==============================Add product End here ====================================-->
            <!--==============================View product start here ====================================-->
              <?php
                // View product data

                $query = "SELECT * FROM product_info";
                $data = mysqli_query($conn, $query);
                if (mysqli_num_rows($data) > 0) {
                  }
              ?>
              <table id="product_table" class="table table-light table-striped table-bordered rounded text-center">
                <thead>
                    <tr>
                      <th>NO</th>
                      <th>Category</th>
                      <th>Product Name</th>
                      <th>Price</th>
                      <th>Quantity</th>
                      <th>Company</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($data)) { ?>
                        <tr>
                            <td class="product_id">
                                <?php echo $i++ ?>
                            </td>
                            <td class="text-capitalize">
                                <?php echo $row['category'] ?>
                            </td>
                            <td class="text-capitalize">
                                <?php echo $row['product_name'] ?>
                            </td>
                            <td>
                                <?php echo $row['price'] ?>
                            </td>
                            <td>
                                <?php echo $row['quantity'] ?>
                            </td>
                            <td class="text-capitalize">
                                <?php echo $row['company'] ?>
                            </td>
                            <td>
                                <?php echo $row['date'] ?>
                            </td>
                            <?php echo "<td>
                                            <a href=\"#\" class=\"actionBtn edit_product\" data-bs-toggle=\"modal\"  >Edit</a> | 
			                                <a href=\"product_function.php?id=$row[id]\" class=\"actionBtn\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a>
                                        </td>"
                                ?>
                        </tr>
                    <?php } ?>
                </tbody>
              </table>
            <!--==============================View product End here ====================================-->
            <!--==============================Edit product start here ====================================-->
            <!-- Edit Model -->
            <div class="modal fade" id="editproduct" tabindex="-1"  aria-labelledby="editModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="product_function.php" method="post">
                      <div class="d-flex flex-column justify-content-center gap-3">
                        <input type="hidden" name="update_id" id="update_id">
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="category">Category</label>
                            <select name="category" id="category">
                                <option value="">Select Category</option>
                                <?php
                                $query = "SELECT id, category_name FROM category_info";
                                $result = $conn->query($query);
                                if ($result->num_rows > 0) {
                                    while ($optionData = $result->fetch_assoc()) {
                                        $option = $optionData['category_name'];
                                        $id = $optionData['id'];
                                        ?>
                                        <option value="<?php echo $option ?>">
                                            <?php echo $option; ?>
                                        </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="product_name">Product Name</label>
                            <input type="text" name="product_name" id="product_name">
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="price">Price</label>
                            <input type="text" name="price" id="price">
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="quantity">Quantity</label>
                            <input type="text" name="quantity" id="quantity">
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="company">Company</label>
                            <select name="company" id="company">
                                <option value="">Select Company</option>
                                <?php
                                $query = "SELECT id, company_name FROM company_info";
                                $result = $conn->query($query);
                                if ($result->num_rows > 0) {
                                    while ($optionData = $result->fetch_assoc()) {
                                        $option = $optionData['company_name'];
                                        $id = $optionData['id'];
                                        ?>
                                        <option value="<?php echo $option; ?>">
                                            <?php echo $option; ?>
                                        </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="date">date</label>
                            <input type="date" name="date" id="date">
                        </div>
                        <input type="submit" name="update_product" value="Update" class="myBtn">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- Modal End-->
            <!--==============================Edit product End here ====================================-->
            </main>
        </div>
    </div>
</div>
<?php
include "includes/footer.php";
?>