<?php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "etmp";
 
     $conn = mysqli_connect($servername, $username, $password, $dbname);
 
     if ($conn->connect_errno) {
         die("Connection failed: " . $conn->connect_error);
     }

     if (isset($_POST["training_type"])) {
        $user_value = $_POST["user"];
        $training_type = $_POST["training_type"];

        $sql = "INSERT INTO notifications (user_id, title, content) VALUES ($user_value, 'Request Cancellation', 'Hi we afraid we need to cancel this request on $training_type because no response for 1 week')";

        if ($conn->query($sql) == TRUE) {
            
        }
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
     }

?> 