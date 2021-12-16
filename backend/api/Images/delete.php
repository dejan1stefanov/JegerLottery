<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  require_once __DIR__ . "/../../../database/Database.php";
  require_once __DIR__ . "/../../models/Images.php";

  // Instantiate DB & connect
  $database = new Database();
  $pdo = $database->connect();

  // Instantiate blog images object
  $images = new Images($pdo);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to delete
  $images->id = $data->id;

  // Delete image
  if($images->delete()) {
    echo json_encode(
      array('message' => 'Post Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Post Not Deleted')
    );
  }
