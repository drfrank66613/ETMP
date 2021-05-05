<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "etmp";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if ($conn->connect_errno) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST["training_name"]) && isset($_POST["user"]) && isset($_POST["training_type"])) {
        $user_value = $_POST["user"];
        $training_workshops = $_POST["training_name"];

        $training_arr = sizeof($training_workshops);

        $training_type_arr = $_POST["training_type"];
        $inserted_training_type = array();

        $request_id = $_COOKIE["request_id"];

        foreach ($training_type_arr as $value) {
            if (!in_array($value, $inserted_training_type)) {
                array_push($inserted_training_type, $value);
            }
        }
        $training_types = implode(",", $inserted_training_type);
        
        // For giving notification to the client side
        $sql = "INSERT INTO notifications (user_id, title, content) VALUES ($user_value, 'Requested Training' , 'You have received $training_arr training workshop in $training_types type')";
        $conn->query($sql);
    
        // For sending the training workshops to the client side
        $training_id = array();

        foreach($training_workshops as $training) {
            echo $training;
            $sql = "SELECT * FROM training_workshop WHERE training_name = '$training'";
            $result = $conn->query($sql);

            if (mysqli_num_rows($result) == 0) {
                echo "empty";
            }
            else {
                while ($row = mysqli_fetch_assoc($result)) {
                    array_push($training_id, $row["training_id"]);
                    echo $row["training_id"];
                }
            }
        }

        foreach ($training_id as $id) {
            $sql = "INSERT INTO unconfirmed_training_workshop (form_id, training_id, training_status) VALUES ('$request_id', '$id', 'unconfirmed')";
            
            if ($conn->query($sql) == TRUE) {
                echo "Trainings have been successfully sent to the client";
                $sql = "UPDATE request_form SET request_status='In Progress' WHERE form_id = $request_id";
                $conn->query($sql);
            }
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            
        }
    
    }
    $conn->close();
?>