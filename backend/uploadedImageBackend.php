<?php
session_start();
require_once __DIR__ . "/../database/Database.php";
require_once __DIR__ . "/models/Images.php";
require_once __DIR__ . "/../config/config.php";
// Instantiate DB & connect
$database = new Database();
$pdo = $database->connect();


if($_SERVER['REQUEST_METHOD'] == "POST") {

    // -------------------- Accept input Info and save the file in a image folder  -----------------------
    $email = $_POST['email'];
    $file = $_FILES['file'];
    

    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    
    $fileName = strtolower($_FILES['file']['name']);
    $fileTmpName = $_FILES['file']['tmp_name'];
    // ------------------------- File Validation -------------------------
    if($file['size'] >= 2048000) {
      $_SESSION['errorFile'] = 'FileSize';
      header("Location: ../index.php");
      die();
    } else if($file['error'] > 0) {
      $_SESSION['errorFile'] = 'FileError';
      header("Location: ../index.php");
      die();
    } else if ($extension != 'png' && $extension != 'jpg' && $extension != 'jpeg' && $extension != 'gif') {
      $_SESSION['errorFile'] = 'FormatError';
      header("Location: ../index.php");
      die();
  }

    // --------------------- Email Validation ----------------------
    if (empty($email)) {
      $_SESSION['emailError'] = "EmailRequired";
      header("Location: ../index.php");
      die();
    } else {
      $email = test_input($_POST["email"]);
      // check if e-mail address is well-formed
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['emailError'] = "InvalidFormat";
        header("Location: ../index.php");
        die();
      }
    }


    $explodeFileName = explode('.', $fileName);
    $fileFormat = strtolower(end($explodeFileName));
    // Give the file name unique name
    $fileNameNew = uniqid('', true) . "." . $fileFormat;
    $fileDestination = 'images/' . $fileNameNew;
    // Save the file in images folder 
    move_uploaded_file($fileTmpName, $fileDestination);
    
    // ------------------------- Insert info and image name in Database --------------------
    
    // Insert file in to database
    $images = new Images($pdo);
    $images->email = $email;
    $images->image = $fileNameNew;
    $stmt = $images->insert();

    if($stmt->rowCount() == 1) {
        $_SESSION['success'] = "Done";
    } else {
        $_SESSION['error'] = "Error";
        header("Location: ../index.php");
        die();

    }

    // // ======================================================= API GET Request ==================================
    $ch = curl_init();
    $url = "https://jager.brainster.xyz/api?img=" . IMG_URL . "/$fileNameNew";
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    $response = curl_exec($ch);

    if($e = curl_error($ch)) {
    // delete from database
      $images->deleteLastInserted();
      unlink('./backend/images/' . $fileNameNew);
      $_SESSION['APIRequest'] = "APIstatus_invalid";
      header("Location: ../index.php");
      die();
    }
    else {
      $responseAPI = json_decode($response, true);
      $img_status = $responseAPI['img_status'];
      // avoid PHP error if the status is 0
      if($img_status !== 0) {
        $textAPI = $responseAPI['text'];
      }

      if($img_status == 1 || $img_status == 2) {
      
        $sql = "UPDATE images
        SET 
        img_status = $img_status,
        text = '$textAPI'
        WHERE image = :image";
        // Prepare statement
        $stmt = $pdo->prepare($sql);
        $data = ['image' => $fileNameNew];
        // Execute query
        if($stmt->execute($data)) {
          $successfulAPIRequest = "APIsuccess";
          $_SESSION['APIRequest'] = $successfulAPIRequest;
          header("Location: ../index.php");
          die();
        } else {
          $successfulAPIRequest = "APIerror";
          $_SESSION['APIRequest'] = $successfulAPIRequest;
          header("Location: ../index.php");
          die();
        }
      } else {
        //delete from database
        $images->deleteLastInserted();
        unlink('./backend/images/' . $fileNameNew);
        $successfulAPIRequest = "APIstatus_invalid";
        $_SESSION['APIRequest'] = $successfulAPIRequest;
        header("Location: ../index.php");
        die();
      }

    }

} else {
    $_SESSION['error'] = "An error occured";
    header("Location: ../index.php");
    die();
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>