<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  require_once __DIR__ . "/../../../database/Database.php";
  require_once __DIR__ . "/../../models/Images.php";

  // Instantiate DB & connect
  $database = new Database();
  $pdo = $database->connect();

  // Instantiate blog images object
  $images = new Images($pdo);

  // Blog post query
  $stmt = $images->read();
 
  // Check if any images
  if($stmt->rowCount() > 0) {
    // Images array
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

    // Turn to JSON & output
    echo json_encode($images_arr);

  } else {
    // No Images
    echo json_encode(
      array('message' => 'No Posts Found')
    );
  }
?>