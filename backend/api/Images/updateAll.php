<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
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

  // Set ID to update
  $images->approval = $data->approval;
    

  // Update post
  if($images->rejectAllUpdate()) {
  // ------------------------------ Send back the updated row --------------------
    $stmt = $images->readAllRejected();

  
    $images_arr = [];
    // $images_arr['data'] = array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
    // if the image item is awarded
      if($row['approval'] == "award") {
        $approval = [
          "award" => [
          "rewardID" => $row['rewardId'],
          "name" => $row['name'],
          "img_name" => $row['img_name'],
          "description" => $row['description'],
          "availability" => $row['availability'],
          "admin" => $row['username']
          ]
      ];
      } else {
        $approval = $row['approval'];
      }
      // last array type of returning data
      $image_item = [
        'id' => $row['id'],
        'email' => $row['email'],
        'image' => $row['image'],
        'img_status' => $row['img_status'],
        'text' => $row['text'],
        'updatedTime' => $row['updatedTime'],
        'approval' => $approval
      ];

      // Push to "data"
      array_push($images_arr, $image_item);
      // array_push($images_arr['data'], $images_item);
    }
    echo json_encode(  
      $images_arr

    );
  } else {
    echo json_encode(
      array('message' => 'Post Not Updated')
    );
  }

?>