<?php 

  if($_SERVER['REQUEST_METHOD'] == "POST") {

  $email = $_POST['emailCon'];
  $message = $_POST['text'];

  $msg = "$email \n $message";


  //the subject
  $subject = "Customer Question";

 
  $result = mail("deni1stefanov@gmail.com", $subject, $msg);
    

  // Update post
  if($result) {
    header("Location: ../index.php");
    die();
  } else {
    header("Location: ../index.php");
    die();
  }
}

?>