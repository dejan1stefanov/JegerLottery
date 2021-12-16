<?php

class Images {
    // DB Stuff
    private $conn;
    private $table = 'images';

    // Properties
    public $id;
    public $email;
    public $image;
    public $img_status;
    public $text;
    public $approval;

    // Constructor with DB
    public function __construct($pdo) {
        $this->conn = $pdo;
    }

    // Insert image and file
    public function insert() {
        // Create query
        $sql = "INSERT INTO images (email, image) VALUES (:email, :image)";
  
        // Prepare statement
        $stmt = $this->conn->prepare($sql);
        $data = ['email' => $this->email, 'image' => $this->image];
  
        // Execute query
        $stmt->execute($data);
  
        return $stmt;
      }

    public function updateImg_status($img_status) {
        // Create query
        $sql = "UPDATE images
            SET 
            img_status = $img_status
            WHERE image = :image";
        // Prepare statement
        $stmt = $this->conn->prepare($sql);
        $data = ['image' => $this->image];

        // Execute query
        $stmt->execute($data);

        return $stmt;
    }
// ===================================== Reading ===================================
    
    public function read() {
        // Create query
        $sql = "SELECT images.*, admin.username, reward.id AS rewardId, reward.name, reward.img_name, reward.description, reward.availability 
        FROM images LEFT JOIN rewarded_images ON images.id = rewarded_images.images_id
        LEFT JOIN admin ON rewarded_images.admin_id = admin.id
        LEFT JOIN reward ON rewarded_images.reward_id = reward.id
        ORDER BY images.id";

        // Prepare statement
        $stmt = $this->conn->prepare($sql);

        // Execute query
        $stmt->execute();

        return $stmt;
    }
    public function readUpdatedApproval() {
        // Create query
        $sql = "SELECT images.*, admin.username, reward.id AS rewardId, reward.name, reward.img_name, reward.description, reward.availability 
        FROM images LEFT JOIN rewarded_images ON images.id = rewarded_images.images_id
        LEFT JOIN admin ON rewarded_images.admin_id = admin.id
        LEFT JOIN reward ON rewarded_images.reward_id = reward.id
        WHERE images.id = :id
        ORDER BY images.id";

        // Prepare statement
        $stmt = $this->conn->prepare($sql);
        $data = ['id' => $this->id];

        // Execute query
        $stmt->execute($data);

        return $stmt;
    }

    public function readAllRejected() {
        // Create query
        $sql = "SELECT images.*, admin.username, reward.id AS rewardId, reward.name, reward.img_name, reward.description, reward.availability 
        FROM images LEFT JOIN rewarded_images ON images.id = rewarded_images.images_id
        LEFT JOIN admin ON rewarded_images.admin_id = admin.id
        LEFT JOIN reward ON rewarded_images.reward_id = reward.id
        WHERE images.approval = 'reject'
        ORDER BY images.id";

        // Prepare statement
        $stmt = $this->conn->prepare($sql);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

   



// ========================================== Updateing ========================================
    public function updateApproval() {
        // Create query
        $sql = 'UPDATE ' . $this->table . '
        SET approval = :approval
        WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($sql);

        // Clean data
        $this->approval = htmlspecialchars(strip_tags($this->approval));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':approval', $this->approval);
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if($stmt->execute()) {
        return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
    public function rejectAllUpdate() {
        // Create query
        $sql = 'UPDATE ' . $this->table . '
        SET approval = :approval
        WHERE approval = "Pending"';

        // Prepare statement
        $stmt = $this->conn->prepare($sql);

        // Clean data
        $this->approval = htmlspecialchars(strip_tags($this->approval));

        // Bind data
        $stmt->bindParam(':approval', $this->approval);

        // Execute query
        if($stmt->execute()) {
        return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    public function updateImgStatusAndText() {
        $sql = "UPDATE images
        SET 
        img_status = :img_status,
        text = :text
        WHERE image = :image";
        // Prepare statement
        $stmt = $this->conn->prepare($sql);

        // Bind data
        $stmt->bindParam('img_status', $this->img_status);
        $stmt->bindParam('text', $this->text);
        $stmt->bindParam('image', $this->image);

        return $stmt;
       
    }

    // ============================================ Delete =============================

    public function delete() {
        // Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if($stmt->execute()) {
          return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
  }
    public function deleteLastInserted() {
        // Create query
        $sql = "DELETE 
        FROM images
        WHERE image = :image
        LIMIT 1";

        // Prepare statement
        $stmt = $this->conn->prepare($sql);

        // Bind data
        $stmt->bindParam(':image', $this->image);

        // Execute query
        if($stmt->execute()) {
          return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
  }

    public function deleteAllRejected() {
        // Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE approval = "reject"';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

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