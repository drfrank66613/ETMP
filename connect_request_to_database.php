<?php
session_start();

$userid = 0;
$trainingid = 'NOT SET';
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$trainingname = $_POST['training_name'];
$venue = $_POST['venue'];
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

    $query_training_type = "SELECT * FROM training_type WHERE '$trainingname' = training_type_name";
    $result_training = mysqli_query($conn, $query_training_type);
    while ($row = mysqli_fetch_assoc($result_training)) {
      $trainingid = $row['training_type_id'];
    }


    $username = $_SESSION['username'];
    $query_user_id = "SELECT * FROM user_information WHERE '$username' = username";
    $result_user_id = mysqli_query($conn, $query_user_id);
    $row = mysqli_fetch_assoc($result_user_id);
    $userid = $row['id'];


    $sql = "INSERT INTO request_form (user_id, training_type_id, fname, lname, phone, address, city, state, training_venue, training_date, training_time)
    VALUES('$userid','$trainingid', '$firstname', '$lastname', '$phone', '$address', '$city', '$state', '$venue', '$date', '$time')";
    if (mysqli_query($conn, $sql)) {
      header("Location: client_homepage.php");
      }
    else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

 ?>
