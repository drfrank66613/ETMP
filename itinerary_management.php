<?php

$con = new mysqli('localhost', 'root', '', 'etmp');

if($con->connect_error){
    die("Database error:". $con->connect_error);
}

$con->set_charset('utf8mb4');
$stmt = $con->prepare("SELECT id FROM user_information WHERE username=? limit 1");
$stmt->bind_param('s', $_SESSION['username']);
$stmt->execute();
$tempResult = $stmt->get_result();
$value = $tempResult->fetch_object();
$id = $value->id;

$query = "SELECT request_form.fname, request_form.lname, request_form.phone, 
                training_itinerary.current_used_date, training_itinerary.current_used_time,
                training_workshop.training_duration
        FROM itinerary_management, training_itinerary, training_workshop, request_form, itinerary_details
        WHERE itinerary_management.training_itinerary_id = training_itinerary.training_itinerary_id 
        AND itinerary_management.user_id = $id
        AND training_itinerary.training_id = training_workshop.training_id
        AND request_form.form_id = training_itinerary.form_id
        AND training_itinerary.itinerary_details_id = itinerary_details.itinerary_details_id
        AND training_itinerary.training_id = training_workshop.training_id";

$result = mysqli_query($con, $query);
$fname = "";
$lname = "";
$phone = "";
$date = "";
$time = "";
$duration = "";

foreach($result as $row){
    $fname = $row["fname"];
    $lname = $row["lname"];
    $phone = $row["phone"];
    $date = $row["current_used_date"];
    $time = $row["current_used_time"];
    $duration = $row["training_duration"];
}
mysqli_free_result($result);
$duration = substr($duration, 0,1);
$hours = '';
if($duration == '5'){
    $hours = '+3 hours';
}
if($duration == '4'){
    $hours = '+2 hours';
}

?>