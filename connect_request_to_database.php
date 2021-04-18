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

    $sql = "INSERT INTO request_form (fname, lname, phone, email, address, city, state, training_type, training_venue, training_date, training_time)
    VALUES('$firstname', '$lastname', '$phone', '$email', '$address', '$city', '$state', '$training', '$venue', '$date', '$time')";
 ?>
