<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  require_once __DIR__ . "/../../../database/Database.php";
  require_once __DIR__ . "/../../models/Images.php";
  require_once __DIR__ . "/../../models/RewardedImages.php";
  require_once __DIR__ . "/../../models/Reward.php";

  // Instantiate DB & connect
  $database = new Database();
  $pdo = $database->connect();

  // Instantiate blog images object
  $images = new Images($pdo);
  $rewardedImages = new RewardedImages($pdo);
  $reward = new Reward($pdo);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $images->id = $data->id;
  $images->approval = $data->approval;
  $rewardedImages->images_id = $data->images_id;
  $rewardedImages->admin_id = $data->admin_id;
  $rewardedImages->reward_id = $data->reward_id;
  $reward->id = $data->reward_id;
    

  // Update post
  if($images->updateApproval()) {
  // ------------------------------ Send back the updated row --------------------
    if($rewardedImages->insert()) {
      if($reward->availabilityUpdate()) {
          $stmt = $images->readUpdatedApproval();

        
          $images_arr = [];
          // $images_arr['data'] = array();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
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

          echo json_encode(  
            $images_arr
        );
      } else {
        //update previous again
        $images->approval = 'Pending';
        $images->updateApproval();
        $rewardedImages->deleteLastOne();

        echo json_encode(
          array('message' => 'An error occured.Could not decrease the quantity of the reward item. Please try again.')
      );
      }
    } else {
      //update previous again
      $images->approval = 'Pending';
      $images->updateApproval();

      echo json_encode(
        array('message' => 'An error occured. Could not insert the rewarded participant in database. Please try again.')
      );

    }
  } else {
    echo json_encode(
      array('message' => 'An error occured. Please try again.')
    );
  }

?>