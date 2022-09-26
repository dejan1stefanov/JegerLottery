<?php
session_start();
require_once __DIR__ . "/../config/config.php";

if(!isset($_SESSION['adminID'])) {
    header("Location: login.php");
    die();
} else {
    $adminID = $_SESSION['adminID'];
}

$exportError = "";
if(isset($_SESSION['exportError']) && $_SESSION['exportError'] == "Error") {
    $exportError = $_SESSION['exportError'];
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
		    <link rel="stylesheet" href="../assets/css/dashboardStyle.css">

        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="../assets/css/all.min.css">

        <!-- Animate.css -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    </head>
    <body aria-live="polite" aria-atomic="true">
  
<!-- ========================================================= Menu Bar ============================================ -->
<section id="navbar" class="container-fluid shadow p-3">
  <div class="row px-2">
    <div class="col-4">
      <a href="#"><img class="logo" src="../assets/img/designImages/jegermeisterLogo.png"></a>
    </div>
    <div class="col-4 d-flex justify-content-center align-items-center">
      <img src="../assets/img/designImages/adminLogo.png" class="adminPanel">
    </div>
    <div class="col-4 d-flex justify-content-end align-items-center iconName">
      <div class="adminNameParent">
        <div class="iconNamePar">
        <i class="fas fa-user-tie p-2"></i>
        <span class="adminName"></span>
        </div>
        <div class="adminDropdown">
          <ul>
            <li id="logout">Log Out</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ================================================ MAIN Section ============================================== -->
    <section id="mainSection" class="shadow">
        <div class="container-fluid container-md bg-light py-5">
          <div class="row">
            <div class="col">
              <!-- -------------------------------- Export Btns -------------------- -->
            <form method="POST" action="exportAward.php" class="d-flex justify-content-end mb-3">
              <input type="submit" name="export" class="btn btn-success btn-sm" value="Download Awarded File" />
            </form>
            <form method="POST" action="exportReject.php" class="d-flex justify-content-end">
              <input type="submit" name="reject" class="btn btn-danger btn-sm" value="Download Rejected File" />
            </form>
            </div>
          </div>
            <div class="row">
                <div class="col">
        <!-- ----------------------------- Pending, Awarded, Rejected nav tabs ------------------ -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="true">Pending</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="awarded-tab" data-toggle="tab" href="#awarded" role="tab" aria-controls="awarded" aria-selected="false">Awarded</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="rejected-tab" data-toggle="tab" href="#rejected" role="tab" aria-controls="rejected" aria-selected="false">Rejected</a>
                        </li>
                        
                    </ul>

        <!-- ============================= Filtered cards depending on tha nav tabs ==================================== -->
                    <div class="tab-content">
            <!-- --------------------------------------- Pending ---------------------------------------- -->
                        <div class="tab-pane active container-fluid" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                            <div class="row">
                                <!-- --------------------------------------- Filter section -------------------------- -->
                                <div class="searchDiv d-flex row w-100 p-4">
                                  <div class="col-lg-6 d-flex mb-3 align-items-center">
                                  <button class="mr-5 btn btn-info btn-sm oneRandomBtn">Get One Random <i class="fas fa-random"></i></button>
                                    <button class="mr-5 btn btn-danger btn-sm rejectAllBtn"  data-toggle="modal" data-target="#rejectAllModal">Reject all Participents <i class="fas fa-times"></i></button>
                                  </div>
                                  <div class="col-lg-6 d-flex justify-content-end align-items-center mb-3">
                                    <label for="filterGuaranted" class="mb-0 mr-1">Filter</label>
                                    <select name="filterGuaranted" id="filterGuaranted" class="form-control">
                                        <option value="all">All</option>
                                        <option value="guaranted">Guaranted</option>
                                        <option value="notSure">Not sure</option>
                                    </select>
                                  </div>
                                </div>
                            </div>
                          <!-- ------------------------- Pending Cards ---------------------- -->
                            <div id="pendingCards" class="row"></div>
                        </div>
            <!-- -------------------------------------- Awarded -------------------------------------- -->
                        <div class="tab-pane" id="awarded" role="tabpanel" aria-labelledby="awarded-tab">
                        <div id="awardCards" class="row my-5"></div>
                        </div>
            <!-- --------------------------------------- Rejected ---------------------------- -->
                        <div class="tab-pane" id="rejected" role="tabpanel" aria-labelledby="rejected-tab">
                          <div class="row">
                            <div class="col">
                              <button id="deleteAllRejected" class="btn btn-danger my-3" data-toggle="modal" data-target="#deleteAllRejectedModal">Delete All Rejected <i class="fas fa-times"></i></button>
                            </div>
                          </div>
                        <div id="rejectCards" class="row"></div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>

<!-- =============================================== Big size image ======================================== -->
    <div id="shadowBg"></div>
    <div class="container">
      <div class="row">
      <div class="imageFrame col-md-6 p-0"></div>
      </div>
    </div>
      

<!-- ==================================================== Awarded-popup ========================================= -->


<!-- Modal -->
<div class="container">
  <div class="row">
    <div class="modal fade col-md-9 overflow-hidden" id="awardModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modalDialog h-100">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body row p-0 w-100">
              <div class="col-6 awardModalImage"> 
              </div>
              <div class="col-6">
                  <h5 class="my-3">Select Award For This Participant:</h5>
                  <select class="selectReward form-control my-3">
                      <!-- <option>Choose a reward</option> -->
                  </select>
                  <div class="row my-3">
                    <div class="col-md-6 rewardImage"></div>
                    <div class="col-md-6 rewardInfo"></div>
                  </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success awardParticipant" data-dismiss="modal">Award Participant</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- =========================================== Delete Permanent Popup ================================ -->
<!-- Modal -->
<div class="modal fade" id="deletePermanentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="m-0">If you delete this permanently, you will never be able to restore it.</p>
        <p class="m-0">Are you sure you want to delete it?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" id="deleteForSure" class="btn btn-danger" data-dismiss="modal">Delete</button>
      </div>
    </div>
  </div>
</div>

<!-- ============================================= Delete All Rejected Popup ================================== -->
<!-- Modal -->
<div class="modal fade" id="deleteAllRejectedModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="m-0">If you delete all of them permanently, you will never be able to restore them.</p>
        <p class="m-0">Are you sure you want to delete all of them?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" id="deleteAllForSure" class="btn btn-danger" data-dismiss="modal">Delete All</button>
      </div>
    </div>
  </div>
</div>
<!-- ============================================= Reject All Participents Popup ================================== -->
<!-- Modal -->
<div class="modal fade" id="rejectAllModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="m-0">Are you sure you want to reject all of them?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" id="rejectAllForSure" class="btn btn-danger" data-dismiss="modal">Reject All</button>
      </div>
    </div>
  </div>
</div>

<!-- =========================== LoginOut Spinner ====================== -->
<div class="spinner-border text-primary spinner" role="status">
  <span class="sr-only">LoginOut...</span>
</div>

<!-- ================================= Admin ID send to JS =================== -->
    <span id="adminID" data-admin ="<?= $adminID ?>"></span>

<!-- ================================ Toast notification ==================== -->
<div id="toastDiv"></div>

<!-- ====================================== Footer ================================ -->
<footer class="container-fluid">
  <div class="row">
    <div class="col">
      <img src="../assets/img/designImages/jegermeisterOrange.png" class="footerImg">
    </div>
  </div>
</footer>

     <!-- ================================== PHP with JS Conection =====================    -->
     <div id="comunication" class="<?php echo "$exportError"?>"></div>
        <!-- Latest Font-Awesome CDN -->
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        
        <!-- jQuery library -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
        
        <!-- Latest Compiled Bootstrap 4.4.1 JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script type="module" src="../assets/js/dashboard.js"></script>
        <!-- <script type="module" src="../assets/js/awardPopup1.js"></script> -->
        <script>

        </script>
    </body>
</html>