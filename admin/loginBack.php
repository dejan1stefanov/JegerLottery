<?php
session_start();

require_once __DIR__ . "/../database/Database.php";

if($_SERVER['REQUEST_METHOD'] == "POST") {

    // Instantiate DB & connect
    $database = new Database();
    $pdo = $database->connect();

    // get values from login.php
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // check if there is such admin in database
    $sql = "SELECT *
        FROM admin
        WHERE email = :email AND password = :password";

    $data = ['email' => $email, 'password' => $password];
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
  
    if($stmt->rowCount() > 0) {
        $row = $stmt->fetch();
        $_SESSION['adminID'] = $row['id'];
        header("Location: dashboard.php?id={$row['id']}");
        die();
    } else {
        $_SESSION['error'] = "Тhere is no such admin in the system";
        $_SESSION['email'] = $email;
        header("Location: ./login.php");
        die();
    }


} else {
    header("Location: ./login.php");
    die();
}