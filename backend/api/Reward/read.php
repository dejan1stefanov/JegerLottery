<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  require_once __DIR__ . "/../../../database/Database.php";
  require_once __DIR__ . "/../../models/Reward.php";

  // Instantiate DB & connect
  $database = new Database();
  $pdo = $database->connect();

  // Instantiate blog reward object
  $reward = new Reward($pdo);

  // Reward query
  $stmt = $reward->read();
 
  // Check if any reward
  if($stmt->rowCount() > 0) {
    // Reward array
    $reward_arr = [];
    // $reward_arr['data'] = array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $reward_item = [
        'id' => $row['id'],
        'name' => $row['name'],
        'img_name' => $row['img_name'],
        'description' => $row['description'],
        'availability' => $row['availability'],
      ];

      // Push to "data"
      array_push($reward_arr, $reward_item);
      // array_push($reward_arr['data'], $reward_item);
    }

    // Turn to JSON & output
    echo json_encode($reward_arr);

  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No Posts Found')
    );
  }
?>