<?php
session_start();
  require_once __DIR__ . "/../database/Database.php";
  $output = "";

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        
        // Instantiate DB & connect
        $database = new Database();
        $pdo = $database->connect();

        $sql = "SELECT email, image, img_status, text, updatedTime
                FROM images
                WHERE approval = 'reject'";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        if($stmt->rowCount() > 0)
        {
        $output .= '
            <table class="table" bordered="1">  
                <tr>  
                    <th>Email</th>  
                    <th>Image</th>  
                    <th>Image Status</th>  
                    <th>Text</th>
                    <th>Date and Time of Update</th>
                </tr>';

        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $output .= '
                <tr>  
                    <td>'.$row["email"].'</td>  
                    <td>'.$row["image"].'</td>  
                    <td>'.$row["img_status"].'</td>  
                    <td>'.$row["text"].'</td>  
                    <td>'.$row["updatedTime"].'</td>
                </tr>';
        }
        $output .= '</table>';
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=rejected.xls');
        echo $output;
        } else {
            $_SESSION['exportError'] = "Error";
            header("Location: dashboard.php");
            die();
        }
    }



?>