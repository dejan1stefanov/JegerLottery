<?php
session_start();
require_once __DIR__ . "/backend/models/Images.php";
require_once __DIR__ . "/config/config.php";

$successfulDatabaseInsert = "";
$successfulAPIRequest = "";
$emailValidation = "";
$fileValidation = "";

// ----------------------- Check if the info is inserted in Database after Submit ---------------------
if(isset($_SESSION['success']) && $_SESSION['success'] == "Done") {
  $successfulDatabaseInsert = $_SESSION['success'];
  unset($_SESSION['success']);
} else if (isset($_SESSION['error']) && $_SESSION['error'] == "Error") {
  $successfulDatabaseInsert = $_SESSION['error'];
  unset($_SESSION['error']);
}
if(isset($_SESSION['APIRequest']) && strlen($_SESSION['APIRequest']) > 0) {
  $successfulAPIRequest = $_SESSION['APIRequest'];
  unset($_SESSION['APIRequest']);
}
// --------------------- Email Backend validation ---------------------
if(isset($_SESSION['errorFile'])) {
  $emailValidation = $_SESSION['errorFile'];
  unset($_SESSION['errorFile']);
}
// ------------------------- File Backend validation -------------------
if(isset($_SESSION['errorFile'])) {
  $emailValidation = $_SESSION['errorFile'];
  unset($_SESSION['errorFile']);
}
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Jagermeister Lottery</title>
    <meta charset="utf-8" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <!-- Browser logo -->
    <link rel="icon" href="./assets/img/designImages/jegermeisterOrange.png">
    <!-- Latest compiled and minified Bootstrap 4.4.1 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- CSS styles-->
		<link rel="stylesheet" href="./assets/css/style.css">
    <!-- Font Awesome Icons -->
		<link rel="stylesheet" href="./assets/css/all.min.css">
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
    

  </head>
  <body>
    
    <!-- ===================================================== Code ============================================= -->
    <!-- ---------------------------------- HERO -------------------------- -->
    <section id="hero">
      
      <div class="titleDiv mx-5">
        <h2 class="heroTextColor">FEEL THE</h2>
        <h2 class="heroTextColor">ICE COLD HEAT</h2>
        <h4 class="heroTextColor subtitle mb-3">Send us your fiscal bill with Jägermeister on it and win a giveaway</h4>

        <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#exampleModal">
                Send The Fiscal Bill Here
              </button>
      </div>
    </section>
  <!-- ----------------------------------------------- MAIN ---------------------------------- -->
    <section id="main" class="bg-light py-5">
      <h3 class="mb-0 subtitleMain">Giveaways</h3>
      <div class="lent mb-5"></div>
      <div class="container-fluid container-md mt-5">
        <div class="row justify-content-center">
          <div class="col d-flex flex-column align-items-center">

            <div class="carousel shadow">
              <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                  <!-- <div class="swiper-slide">Slide 1</div> -->
                </div>
                <div class="swiper-pagination"></div>
              </div>
            </div>

            <p class="text-center mb-5 mt-3">Send us your fiscal bill with Jägermeister on it and win a giveaway</p>
            <div class="enterReceiptBtn">
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">
              Send The Fiscal Bill Here
              </button>
            </div>

          </div>
        </div>
      </div>
    </section>
    <!-- ---------------------------------------------------------- FOOTER ------------------------------------- -->
    <footer class="shadow-lg p-3 rounded">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-lg-4 footerParent">
            <a class="contactBtn" data-toggle="modal" data-target="#contactModal">CONTACT</a>
            <a href="#" target="_blank">HISTORY</a>
            <a href="#" target="_blank">FACTORY TOUR</a>
            <a href="#" target="_blank">JÄGERMEISTER TALES</a>
            <a href="#" target="_blank">STAG OR NOT STAG</a>
            <a href="./admin/login.php" target="_blank">ADMIN</a>
          </div>
          <div class="col-4 middleFooterCol d-flex justify-content-center">
            <img src="./assets/img/designImages/jegermeisterOrange.png" class="w-50"></div>
          <div class="col-sm-6 col-lg-4 d-flex flex-column justify-content-between align-items-end">
            <div>
          <a href="https://www.facebook.com/JagermeisterMKD/?brand_redir=458387070856856" target="_blank" class="mr-3 mb-3">
            <i class="fab fa-facebook"></i></a>
          <a href="https://www.instagram.com/jagermeister/" target="_blank">
            <i class="fab fa-instagram"></i></a>
            </div>
          <a href="#" target="_blank" class="weblink">JAGERMEISTER.COM</a>
          </div>
        </div>
      </div>
    </footer>
    <!-- ===================================================== Progress bar Modal ====================================== -->
    <div class="modal" id="test" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Image Verification</h5>
            <button type="button" class="close closeBtn" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body imgVerBody">
            <p class="imgVerBodyText">Uploading image...</p>
            <div class="col-xs-12 col-sm-12 progress-container">
              <div class="progress progress-striped active">
                  <div class="progress-bar progress-bar-success" style="width:0%"></div>
              </div>
            </div>
          </div>

          <div class="modal-footer closeButton">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
        </div>
      </div>
    </div>
    
<!-- ======================================= Upload Receipt Popup ============================================ -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Participant Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form id="formUpdate" action="./backend/uploadedImageBackend.php" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="inputDiv">
          <label for="email">Email address:</label>
          <input type="email" id="email" name="email" class="form-control">
        </div>
        <span class="text-black-50 fontSize12">We never share your email with anyone else</span>
      </div>
        <!-- <p>Upload The Image of Your Receipt:</p> -->
        <div class="uploadArea my-5 p-2 over overflow-hidden">
            <input type="file" id="file" name="file" accept=".jpg, .jpeg, .png, .gif">
            
            <p>Drag your files here or click in this area to UPLOAD your image. <i class="fas fa-upload"></i></p>
            <p class="errorSuccess"></p>
            
        </div>
        <div class="noFileError"></div>

      <div class="modal-footer uploadFooter">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn bg-orange text-light sendInfoBtn">Send Information</button>
      </div>
      </form>

    </div>
  </div>
</div>

<!-- ====================================== Contact Popup ============================================ -->
<!-- Modal -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Contact</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" class="inputDiv" action="./backend/contactStore.php">
            <div class="modal-body">
              <label for="emailCon">Email address:</label>
              <input type="email" id="emailCon" name="emailCon" class="form-control mb-4">
              <textarea type="text" name="text" id="textCon" placeholder="Your text..." class="form-control" rows="5" cols="50"></textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-warning bg-orange text-light contactUsBtn">Send</button>
            </div>
      </form>
    </div>
  </div>
</div>

<!-- ------- HTML element that I use to comunicate between JS and PHP ------------ -->
<div id="databaseSuccess" class="<?php echo "$successfulDatabaseInsert $successfulAPIRequest $emailValidation $fileValidation"?>"></div>


    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <!-- jQuery library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    
    <!-- Latest Compiled Bootstrap 4.4.1 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="module" src="./assets/js/imgUpdated.js"></script>
    <script type="module" src="./assets/js/main.js"></script>
    
  </body>
</html>