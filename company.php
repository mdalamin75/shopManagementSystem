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
            <!--==============================Add company start here ====================================-->
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
              Add company
            </button>

            <!-- Modal Start-->
            <div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New company</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="company_function.php" method="post">
                      <div class="d-flex flex-column justify-content-center">
                        <label for="company_name">Company Name</label>
                        <input type="text" name="company_name" placeholder="Enter company Name">
                        <input type="submit" name="add_company" value="Add company" class="myBtn">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!--==============================Add company End here ====================================-->
            <!--==============================View company start here ====================================-->
              <?php
                // View company data
                $query = "SELECT * FROM company_info";
                $data = mysqli_query($conn, $query);
                if (mysqli_num_rows($data) > 0) {
                  }
              ?>
              <table id="company_table" class="table table-light table-striped table-bordered rounded text-center">
                <thead>
                    <tr>
                      <th>company ID</th>
                      <th>company Name</th>
                      <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($data)) { ?>
                        <tr>
                            <td class="company_id">
                                <?php echo $row['id'] ?>
                            </td>
                            <td class="text-capitalize">
                                <?php echo $row['company_name'] ?>
                            </td>
                            <?php echo "<td>
                                            <a href=\"#\" class=\"actionBtn edit_company\" data-bs-toggle=\"modal\">Edit</a> | 
			                                <a href=\"company_function.php?id=$row[id]\" class=\"actionBtn\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a>
                                        </td>"
                                ?>
                        </tr>
                    <?php } ?>
                </tbody>
              </table>
            <!--==============================View company End here ====================================-->
            <!--==============================Edit company start here ====================================-->
            <!-- Edit Model -->
            <div class="modal fade" id="editcompany" tabindex="-1"  aria-labelledby="editModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit company</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="company_function.php" method="post">
                      <div class="d-flex flex-column justify-content-center">
                        <input type="hidden" name="update_id" id="update_id">
                        <label for="company_name">company Name</label>
                        <input type="text" name="company_name" id="company_name" class="text-start">
                        <input type="submit" name="update_company" value="Update" class="myBtn">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- Modal End-->
            <!--==============================Edit company End here ====================================-->
            </main>
        </div>
    </div>
</div>
<?php
include "includes/footer.php";
?>