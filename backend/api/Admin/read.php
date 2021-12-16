<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  require_once __DIR__ . "/../../../database/Database.php";
  require_once __DIR__ . "/../../models/Admin.php";

  // Instantiate DB & connect
  $database = new Database();
  $pdo = $database->connect();

  // Instantiate blog images object
  $admin = new Admin($pdo);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $admin->id = $data->id;

  // Blog post query
  $stmt = $admin->read();
 
  // Check if any images
  if($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // Turn to JSON & output
    echo json_encode($row['username']);

  } else {
    // No Images
    echo json_encode(
      array('message' => 'No Posts Found')
    );
  }
?>