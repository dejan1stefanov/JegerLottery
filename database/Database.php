<?php

require_once __DIR__ . "/../config/config.php";

class Database {
    // DB Params
    private $host = DB_HOST;
    private $db_name = DB_NAME;
    private $username = DB_USER;
    private $password = DB_PASS;
    private $conn;

    //DB Connect
    public function connect() {
        $this->conn = null;

        try{
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            file_put_contents(__DIR__ ."/../readme/log.txt", date("Y-m-d H:i:s") . ": {$e->getMessage()}" . PHP_EOL, FILE_APPEND);
            die("Can not connect to database");
        }

        return $this->conn;   

    }
}

?>