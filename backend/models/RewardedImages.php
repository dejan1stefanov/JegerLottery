<?php

class RewardedImages {
    // DB Stuff
    private $conn;
    private $table = 'rewarded_images';

    // Properties
    public $id;
    public $images_id;
    public $admin_id;
    public $reward_id;

    // Constructor with DB
    public function __construct($pdo) {
        $this->conn = $pdo;
    }

    //insert rewarded participant
    public function insert() {
        // Create query
        $sql = "INSERT INTO rewarded_images (images_id, admin_id, reward_id) VALUES (:images_id, :admin_id, :reward_id)";
  
        // Prepare statement
        $stmt = $this->conn->prepare($sql);
        $data = ['images_id' => $this->images_id, 'admin_id' => $this->admin_id, 'reward_id' => $this->reward_id];
  
        // Execute query
        $stmt->execute($data);
  
        return $stmt;
      }

    // =================================== DELETE ============================
    public function deleteLastOne() {
        // Create query
        $sql = 'DELETE 
        FROM rewarded_images 
        WHERE 1
        ORDER BY id DESC LIMIT 1';

        // Prepare statement
        $stmt = $this->conn->prepare($sql);

        // Execute query
        if($stmt->execute()) {
          return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
  }

}

?>