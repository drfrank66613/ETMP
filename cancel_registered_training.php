<?php include('session_control.php') ?>

<?php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "etmp";
 
     $conn = mysqli_connect($servername, $username, $password, $dbname);

     if ($conn->connect_errno) {
         die("Connection failed: " . $conn->connect_error);
     }

     if (isset($_POST["cancel_reason"]) && isset($_POST["user_name"]) && isset($_POST["training_name"])) {
        $cancel_reason = strtolower($_POST["cancel_reason"]);
        $user_name = $_POST["user_name"];
        $training_name = strtolower($_POST["training_name"]);

        $admin_id = array();

        $sql = "SELECT * FROM user_information WHERE privilege_level = 'Admin'";
        $result = $conn->query($sql);

        while ($row = mysqli_fetch_assoc($result)) {
            array_push($admin_id, $row["id"]);
        }
        
        foreach ($admin_id as $id) {
            $sql = "INSERT INTO notifications (user_id, title, content) VALUES ($id, 'Registered Training Cancelation', '$user_name cancel registered training called $training_name because of $cancel_reason')";
            $conn->query($sql);
        }
        echo $_SESSION['username'];

        $stmt = $conn->prepare("SELECT id FROM user_information WHERE username=? limit 1");
        $stmt->bind_param('s', $_SESSION['username']);
        $stmt->execute();
        $tempResult = $stmt->get_result();
        $value = $tempResult->fetch_object();
        $id = $value->id;

        echo $id;
        
        $sql = "SELECT user_information.id, training_itinerary.training_itinerary_id, training_itinerary.form_id, request_form.form_id  
                FROM itinerary_management, user_information, training_itinerary, request_form
                WHERE itinerary_management.training_itinerary_id = training_itinerary.training_itinerary_id
                AND itinerary_management.user_id = $id";
        $result = $conn->query($sql);

        $itinerary_id;
        $request_id;

        while ($row = mysqli_fetch_assoc($result)) {
            $itinerary_id = $row["training_itinerary_id"];
            $request_id = $row["form_id"];
        }

        $sql = "UPDATE request_form SET request_status='Canceled' WHERE form_id = $request_id";
        $conn->query($sql);
        
        $sql = "UPDATE training_itinerary SET training_itinerary_status = 'Canceled' WHERE training_itinerary_id = $itinerary_id";
        $conn->query($sql);
        /* Should change the status of training itinerary from default to "Canceled" here */
        /* Should wait from Abeng */
        

            
     }

?> 