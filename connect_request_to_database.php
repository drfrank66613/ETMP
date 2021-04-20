<?php

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$training = $_POST['training_type'];
$venue = $_POST['training_venue'];
$date = $_POST['date'];
$time = $_POST['time'];

    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "etmp";
    $conn = mysqli_connect("$host", "$dbUsername", "$dbPassword", "$dbname");

    if ($conn->connect_error) {
      die("Connection failed:" . $conn->connect_error);
    }



    $query_user_id = mysqli_query($conn, "SELECT * FROM user_information WHERE id = user_id");
    //$query_training_id = "SELECT * FROM training_type WHERE training_type_id = '$trainingid'";
    $query_training_name = "SELECT training_type_id FROM training_type WHERE training_type_name = '$training'";
    $result = $conn->query($query_training_name);
    $trainingid = 1;
    while ($row = mysqli_fetch_assoc($result)) {
    $trainingid = $row["training_type_id"];}

    $sql = "INSERT INTO request_form (user_id, training_type_id, fname, lname, phone, email, address, city, state, training_venue, training_date, training_time)
    VALUES('1','$trainingid', '$firstname', '$lastname', '$phone', '$email', '$address', '$city', '$state', '$venue', '$date', '$time')";
    if (mysqli_query($conn, $sql)) {
      echo "New record created successfully";
      }
    else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }


 ?>
