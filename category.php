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
            <!--==============================Add Category start here ====================================-->
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
            <button type="button" class="btn myBtn mb-5" data-bs-toggle="modal" data-bs-target="#exampleModal">
              <i class="fa-solid fa-plus"></i>
              Add Category
            </button>

            <!-- Modal Start-->
            <div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="category_function.php" method="post">
                      <div class="d-flex flex-column justify-content-center">
                        <label for="category_name">Category Name</label>
                        <input type="text" name="category_name" placeholder="Enter Category Name">
                        <input type="submit" name="add_category" value="Add Category" class="myBtn">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!--==============================Add Category End here ====================================-->
            <!--==============================View Category start here ====================================-->
              <?php
                // View Category data
                $query = "SELECT * FROM category_info";
                $data = mysqli_query($conn, $query);
                if (mysqli_num_rows($data) > 0) {
                  } else {
                  echo "No record found";
                }
              ?>
              <table id="example" class="table table-light table-striped table-bordered rounded text-center">
                <thead>
                    <tr>
                      <th>Category ID</th>
                      <th>Category Name</th>
                      <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($data)) { ?>
                        <tr>
                            <td class="category_id">
                                <?php echo $row['id'] ?>
                            </td>
                            <td class="text-capitalize">
                                <?php echo $row['category_name'] ?>
                            </td>
                            <?php echo "<td>
                                            <a href=\"#\" class=\"actionBtn edit_category\" data-bs-toggle=\"modal\"  >Edit</a> | 
			                                <a href=\"category_function.php?id=$row[id]\" class=\"actionBtn\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a>
                                        </td>"
                                ?>
                        </tr>
                    <?php } ?>
                </tbody>
              </table>
            <!--==============================View Category End here ====================================-->
            <!--==============================Edit Category start here ====================================-->
            <!-- Edit Model -->
            <div class="modal fade" id="editCategory" tabindex="-1"  aria-labelledby="editModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="category_function.php" method="post">
                      <div class="d-flex flex-column justify-content-center">
                        <input type="hidden" name="update_id" id="update_id">
                        <label for="category_name">Category Name</label>
                        <input type="text" name="category_name" id="category_name" class="text-start">
                        <input type="submit" name="update_category" value="Update" class="myBtn">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- Modal End-->
            <!--==============================Edit Category End here ====================================-->
            </main>
        </div>
    </div>
</div>
<?php
include "includes/footer.php";
?>