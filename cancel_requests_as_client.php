<?php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "etmp";
 
     $conn = mysqli_connect($servername, $username, $password, $dbname);

     if ($conn->connect_errno) {
         die("Connection failed: " . $conn->connect_error);
     }

     if (isset($_POST["cancel_reason"]) && isset($_POST["user_name"])) {
        $cancel_reason = strtolower($_POST["cancel_reason"]);
        $user_name = $_POST["user_name"];
        $admin_id = array();

        $sql = "SELECT * FROM user_information WHERE privilege_level = 'Admin'";
        $result = $conn->query($sql);

        while ($row = mysqli_fetch_assoc($result)) {
            array_push($admin_id, $row["id"]);
        }
        
        foreach ($admin_id as $id) {
            $sql = "INSERT INTO notifications (user_id, title, content) VALUES ($id, 'Request Cancellation', '$user_name cancel the request because of $cancel_reason')";
            $conn->query($sql);
        }
        
        if (isset($_COOKIE["request_id"])) {
            $request_id = $_COOKIE["request_id"];
            $sql = "UPDATE request_form SET request_status='Canceled' WHERE form_id = $request_id";
            $conn->query($sql);
        }
            
     }

?> 