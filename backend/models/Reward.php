<?php

class Reward {
    // DB Stuff
    private $conn;
    private $table = 'reward';

    // Properties
    public $id;
    public $name;
    public $description;
    public $availability;

    // Constructor with DB
    public function __construct($pdo) {
        $this->conn = $pdo;
    }

    // ===================================== Reading ===================================
    public function read() {
        // Create query
        $sql = "SELECT *
            FROM reward
            WHERE 1";

        // Prepare statement
        $stmt = $this->conn->prepare($sql);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // ====================================== Update =====================================
    public function availabilityUpdate() {
        // Create query
        $sql = 'UPDATE ' . $this->table . '
        SET availability = availability - 1
        WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($sql);

        // Clean data
        // $this->availability = htmlspecialchars(strip_tags($this->availability));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        // $stmt->bindParam(':approval', $this->approval);
        $stmt->bindParam(':id', $this->id);

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