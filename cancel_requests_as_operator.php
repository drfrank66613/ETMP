<?php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "etmp";
 
     $conn = mysqli_connect($servername, $username, $password, $dbname);

     if ($conn->connect_errno) {
         die("Connection failed: " . $conn->connect_error);
     }

     if (isset($_POST["training_type"]) && isset($_POST["user"]) && isset($_POST["cancel_reason"])) {
        $user_value = $_POST["user"];
        $training_type = $_POST["training_type"];
        $cancel_reason = strtolower($_POST["cancel_reason"]);

        $sql = "INSERT INTO notifications (user_id, title, content) VALUES ($user_value, 'Request Cancellation', 'Hi we afraid we need to cancel this request on $training_type because $cancel_reason')";

        if ($conn->query($sql) == TRUE) {
            if (isset($_COOKIE["request_id"])) {
                $request_id = $_COOKIE["request_id"];
                $sql = "UPDATE request_form SET request_status='Canceled' WHERE form_id = $request_id";
                $conn->query($sql);
            }
            
        }
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
     }

?> 