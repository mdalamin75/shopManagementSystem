<header>
  <div class="d-flex flex-column flex-shrink-0 p-3 text-white sidebar">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
      <span class="fs-4">SMS</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto gap-4">
      <?php
          $role = $_SESSION["user_role"];
        if ($role == "manager") {
          include('includes/manager_menu.php');
        }elseif($role == "admin"){
          include('includes/admin_menu.php');
        }else{
          header("location: index.php");
        }
      ?>
    </ul>
    <hr>
    <span class="text-center">
      <?php
        echo 
        "
        <p class='text-capitalize fs-6'>Welcome, $_SESSION[username]</p>
        <a href='logout.php' class='logout'>Logout <i class='fa-solid fa-right-from-bracket ms-3'></i></a>
        ";
      ?>
    </span>
  </div>
  </header>