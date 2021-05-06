<?php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "etmp";
 
     $conn = mysqli_connect($servername, $username, $password, $dbname);

     if ($conn->connect_errno) {
         die("Connection failed: " . $conn->connect_error);
     }

     if (isset($_POST["chosen_training_type"]) && isset($_POST["user_name"])) {
        $chosen_training_type = strtolower($_POST["chosen_training_type"]);
        $user_name = $_POST["user_name"];
        $admin_id = array();

        $sql = "SELECT * FROM user_information WHERE privilege_level = 'Admin'";
        $result = $conn->query($sql);

        while ($row = mysqli_fetch_assoc($result)) {
            array_push($admin_id, $row["id"]);
        }
        
        foreach ($admin_id as $id) {
            $sql = "INSERT INTO notifications (user_id, title, content) VALUES ($id, 'Training Alternatives Request', '$user_name want to request for training workshops with $chosen_training_type type')";
            $conn->query($sql);
        }
     }

?> 