<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $award = $data->award;
  //the subject
  $subject = "Congratulations from Jägermeister";
  //the message
  $msg = "Congratulations, we want to inform you that you are the winner of the Jagermeister $award.\n
  The $award will be send to you as soon as possible.\n
  Good luck and all the best,\n
  Wish you, the Jagermeister team.";
  //recipient email here
  $email = $data->email;
  //send email
  $result = mail($email, $subject, $msg);
    

  // Update post
  if($result) {
  
    echo json_encode(  
      ['message' => 'Email has been send to the Participant']
    );
  } else {
    echo json_encode(
      array('message' => 'The email was not send.')
    );
  }

?>