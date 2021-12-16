<?php
session_start();
  require_once __DIR__ . "/../database/Database.php";
  $output = "";

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        
        // Instantiate DB & connect
        $database = new Database();
        $pdo = $database->connect();

        $sql = "SELECT images.email, images.image, images.img_status, images.updatedTime, admin.username AS admin, reward.name AS rewardName
                FROM images LEFT JOIN rewarded_images ON images.id = rewarded_images.images_id 
                            LEFT JOIN admin ON rewarded_images.admin_id = admin.id 
                            LEFT JOIN reward ON rewarded_images.reward_id = reward.id 
                WHERE images.approval = 'award' 
                ORDER BY images.id;";

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
                    <th>Date and Time of Update</th>
                    <th>Admin</th>
                    <th>Reward</th>
                </tr>';

        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $output .= '
                <tr>  
                    <td>'.$row["email"].'</td>  
                    <td>'.$row["image"].'</td>  
                    <td>'.$row["img_status"].'</td>   
                    <td>'.$row["updatedTime"].'</td>
                    <td>'.$row["admin"].'</td>
                    <td>'.$row["rewardName"].'</td>
                </tr>';
        }
        $output .= '</table>';
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=awarded.xls');
        echo $output;
        } else {
            $_SESSION['exportError'] = "Error";
            header("Location: dashboard.php");
            die();
        }
    }



?>