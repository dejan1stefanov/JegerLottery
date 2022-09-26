<?php
session_start();

if(isset($_SESSION['adminID']) && strlen($_SESSION['adminID']) > 0) {
    header("Location: dashboard.php");
    die();
}

$error = "";
if(isset($_SESSION['error']) && $_SESSION['error'] > 0) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
} 

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Jagermeister AdminPanel</title>
        <meta charset="utf-8" />
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0" />

        <!-- Browser logo -->
        <link rel="icon" href="../assets/img/designImages/adminLogo.png">
        <!-- Latest compiled and minified Bootstrap 4.4.1 CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <!-- CSS styles-->
		<link rel="stylesheet" href="../assets/css/loginStyle.css">
    </head>
    <body>
        <section class="bg-light main">
        <div class="container">
            <div class="row p-5">
                <div class="col-6 d-flex justify-content-center">
                    <img src="../assets/img/designImages/jegermeisterLogo.png" class="w-25">
                </div>
                <div class="col-6 d-flex justify-content-center align-items-center">
                    <img src="../assets/img/designImages/adminLogo.png" class="w-50 h-50">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col col-md-5 formParent shadow-lg p-3 mb-5 bg-white rounded">
                    <p class="alert-danger"><?= $error ?></p>
                    <form method="POST" action="./loginBack.php" id="formUpdate">
                        <div class="inputDiv">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= isset($_SESSION['email']) ? $_SESSION['email'] : ''?>">
                        </div>
                            <label for="email">Password:</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary mt-5 mb-3 loginBtn">Log In</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        </section>
    
        
        <!-- Latest Font-Awesome CDN -->
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        
        <!-- jQuery library -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
        
        <!-- Latest Compiled Bootstrap 4.4.1 JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script type="module" src="../assets/js/login.js"></script>
    </body>
</html>