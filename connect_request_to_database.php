<?php
$trainingid = 'NOT SET';
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$phone = $_POST['phone'];
$email = $_POST['email'];
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
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn = mysqli_connect("$host", "$dbUsername", "$dbPassword", "$dbname");

    if ($conn->connect_error) {
      die("Connection failed:" . $conn->connect_error);
    }

    $query_training_type = "SELECT * FROM training_type WHERE '$trainingname' = training_type_name";
    $result_training = mysqli_query($conn, $query_training_type);
    while ($row = mysqli_fetch_assoc($result_training)) {
      $trainingid = $row['training_type_id'];
    }


    $sql = "INSERT INTO request_form (user_id, training_type_id, fname, lname, phone, email, address, city, state, training_venue, training_date, training_time)
    VALUES('1','$trainingid', '$firstname', '$lastname', '$phone', '$email', '$address', '$city', '$state', '$venue', '$date', '$time')";
    if (mysqli_query($conn, $sql)) {
      echo "Training Request Form Submitted";
      }
    else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

 ?>
