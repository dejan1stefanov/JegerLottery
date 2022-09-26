<?php

class Admin {
    // DB Stuff
    private $conn;
    private $table = 'admin';

    // Properties
    public $id;

    // Constructor with DB
    public function __construct($pdo) {
        $this->conn = $pdo;
    }

   // ===================================== Reading ===================================
    
   public function read() {
    // Create query
    $sql = "SELECT username
    FROM admin
    WHERE id = :id";

    // Prepare statement
    $stmt = $this->conn->prepare($sql);
    $data = ["id" => $this->id];

    // Execute query
    $stmt->execute($data);

    return $stmt;
}

}

?>