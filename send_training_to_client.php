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
        $training_arr = sizeof($_POST["training_name"]);

        $training_type_arr = $_POST["training_type"];
        $inserted_training_type = array();


        foreach ($training_type_arr as $value) {
            if (!in_array($value, $inserted_training_type)) {
                array_push($inserted_training_type, $value);
            }
        }
        $training_types = implode(",", $inserted_training_type);
        
        $sql = "INSERT INTO notifications (user_id, title, content) VALUES ($user_value, 'Requested Training' , 'You have received $training_arr training workshop in $training_types type')";

        if ($conn->query($sql) == TRUE) {
           echo "Trainings have been successfully sent to the client";

        }
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

?>