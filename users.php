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
            <!--==============================Add user start here ====================================-->
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
              <h3>Users List</h3>
              <!-- Button trigger modal -->
              <button type="button" class="btn myBtn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa-solid fa-plus"></i>
                Add user
              </button>
            </div>

            <!-- Modal Start-->
            <div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="users_function.php" method="post">
                      <div class="d-flex flex-column justify-content-center">
                      <div class="d-flex justify-content-between align-items-center">
                        <label for="user_name" class="mb-4">User Name</label>
                        <input type="text" name="user_name" placeholder="Enter User Name">
                      </div>
                      <div class="d-flex justify-content-between align-items-center">
                        <label for="user_role" class="mb-4">User Role</label>
                        <input type="text" name="user_role" placeholder="Enter User Role">
                      </div>
                      <div class="d-flex justify-content-between align-items-center">
                        <label for="user_password" class="mb-4">User Password</label>
                        <input type="password" name="user_password" placeholder="Enter User Password">
                      </div>
                        <input type="submit" name="add_user" value="Add user" class="myBtn">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!--==============================Add user End here ====================================-->
            <!--==============================View user start here ====================================-->
              <?php
                // View user data
                $query = "SELECT * FROM users";
                $data = mysqli_query($conn, $query);
                if (mysqli_num_rows($data) > 0) {
                  }
              ?>
              <table id="users_table" class="table table-light table-striped table-bordered rounded text-center">
                <thead>
                    <tr>
                      <th>NO</th>
                      <th>User Name</th>
                      <th>User Role</th>
                      <th>User Password</th>
                      <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($data)) { ?>
                        <tr>
                            <td >
                                <?php echo $i++ ?>
                            </td>
                            <td>
                                <?php echo $row['username'] ?>
                            </td>
                            <td class="text-capitalize">
                                <?php echo $row['user_role'] ?>
                            </td>
                            <td>
                                <?php echo $row['password'] ?>
                            </td>
                            <?php echo "<td>
                                            <a href=\"#\" class=\"actionBtn edit_users\" data-bs-toggle=\"modal\"  >Edit</a> | 
			                                <a href=\"users_function.php?id=$row[id]\" class=\"actionBtn\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a>
                                        </td>"
                                ?>
                        </tr>
                    <?php } ?>
                </tbody>
              </table>
            <!--==============================View user End here ====================================-->
            <!--==============================Edit user start here ====================================-->
            <!-- Edit Model -->
            <div class="modal fade" id="editUsers" tabindex="-1"  aria-labelledby="editModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="users_function.php" method="post">
                    <input type="hidden" name="update_user_id" id="update_user_id">
                      <div class="d-flex flex-column justify-content-center">
                        <div class="d-flex justify-content-between align-items-center">
                          <label for="user_name" class="mb-4">User Name</label>
                          <input type="text" name="user_name" id="user_name">
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                          <label for="user_role" class="mb-4">User Role</label>
                          <input type="text" name="user_role" id="user_role">
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                          <label for="user_password" class="mb-4">User Password</label>
                          <input type="password" name="user_password" id="user_password">
                      </div>
                        <input type="submit" name="update_user" value="Update" class="myBtn">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- Modal End-->
            <!--==============================Edit user End here ====================================-->
            </main>
        </div>
    </div>
</div>
<?php
include "includes/footer.php";
?>