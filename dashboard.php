<?php
session_start();
include "includes/header.php";
if (!isset($_SESSION["username"])) {
  header("location: index.php");
}
include "includes/connection.php";
?>
<div id="main_content">
  <div class="row">
    <div class="col-2">
      <?php
        include "includes/menu.php";
      ?>
    </div>
    <div class="col-10 mt-5 pt-4">
      <main>
        <h3>Welcome to Shop Management System </h3>
        <hr>
        <div class="container">
          <div class="row">
            <div class="col-4">
              <div class="card mb-3 rounded shadow">
                <div class="row g-0">
                  <div class="col-md-4 rounded">
                    <div class="category_card">
                      <i class="fa-solid fa-list me-2"></i>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title pt-3 mt-1">
                        Total Category : 
                        <?php
                          $sql = "SELECT COUNT(*) AS total_records FROM category_info";
                          $result = $conn->query($sql);

                          if ($result->num_rows > 0) {
                              $row = $result->fetch_assoc();
                              $totalRecords = $row['total_records'];
                              echo $totalRecords;
                          } else {
                              echo "No records found";
                          }
                        ?>
                      </h5>
                      <br/>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-4">
              <div class="card mb-3 rounded shadow">
                <div class="row g-0">
                  <div class="col-md-4 rounded">
                    <div class="category_card">
                    <i class="fa-solid fa-building me-2"></i>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title pt-3 mt-1">
                        Total Company : 
                        <?php
                          $sql = "SELECT COUNT(*) AS total_records FROM company_info";
                          $result = $conn->query($sql);

                          if ($result->num_rows > 0) {
                              $row = $result->fetch_assoc();
                              $totalRecords = $row['total_records'];
                              echo $totalRecords;
                          } else {
                              echo "No records found";
                          }
                        ?>
                      </h5>
                      <br/>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-4">
              <div class="card mb-3 rounded shadow">
                <div class="row g-0">
                  <div class="col-md-4 rounded">
                    <div class="category_card">
                      <i class="fa-solid fa-box-open me-2"></i>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title pt-3 mt-1">
                        Total Product : 
                        <?php
                          $sql = "SELECT  COUNT(DISTINCT product_name) AS total_records FROM product_info";
                          $result = $conn->query($sql);

                          if ($result->num_rows > 0) {
                              $row = $result->fetch_assoc();
                              $totalRecords = $row['total_records'];
                              echo $totalRecords;
                          } else {
                              echo "No records found";
                          }
                        ?>
                      </h5>
                      <br/>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-4">
              <div class="card mb-3 rounded shadow">
                <div class="row g-0">
                  <div class="col-md-4 rounded">
                    <div class="category_card">
                      <i class="fa-brands fa-sellcast me-2"></i>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title pt-3 mt-1">
                        Sale Record : 
                        <?php
                          $sql = "SELECT  COUNT(*) AS total_records FROM sale_info";
                          $result = $conn->query($sql);

                          if ($result->num_rows > 0) {
                              $row = $result->fetch_assoc();
                              $totalRecords = $row['total_records'];
                              echo $totalRecords;
                          } else {
                              echo "No records found";
                          }
                        ?>
                      </h5>
                      <br/>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-4">
              <div class="card mb-3 rounded shadow">
                <div class="row g-0">
                  <div class="col-md-4 rounded">
                    <div class="category_card">
                      <i class="fa-solid fa-users me-2"></i>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title pt-3 mt-1">
                        Users : 
                        <?php
                          $sql = "SELECT  COUNT(*) AS total_records FROM users";
                          $result = $conn->query($sql);

                          if ($result->num_rows > 0) {
                              $row = $result->fetch_assoc();
                              $totalRecords = $row['total_records'];
                              echo $totalRecords;
                          } else {
                              echo "No records found";
                          }
                        ?>
                      </h5>
                      <br/>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</div>
<?php 
  include "includes/footer.php";
?>