<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Main CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>
        <div class="login">
            <div class="container">
                <form action="login.php" class="login_form p-5 shadow-lg rounded-3">
                    <div class="d-flex px-5 pb-5 justify-content-between flex-sm-column flex-md-row">
                        <div class="d-flex flex-column justify-content-center order-sm-2 order-md-1">
                            <h1 class="login_head pb-3">Login Form</h1>
                            <label for="username">User Name</label>
                            <input type="text" name="username" id="username" placeholder="Enter your username">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" placeholder="Enter your password">
                            <input type="submit" name="login" value="Login">
                        </div>
                        <div class="ps-0 mb-3 mb-md-0 ps-md-5 order-sm-1 order-md-2">
                            <img src="img/login.svg" alt="login" class="img-fluid login_img">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>