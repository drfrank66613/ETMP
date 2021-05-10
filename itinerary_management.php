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

$query = "SELECT request_form.fname, request_form.lname, request_form.phone
        FROM itinerary_management, training_itinerary, training_workshop, request_form 
        WHERE itinerary_management.training_itinerary_id = training_itinerary.training_itinerary_id 
        AND itinerary_management.user_id = $id
        AND training_itinerary.training_id = training_workshop.training_id
        AND request_form.form_id = training_itinerary.form_id";

$result = mysqli_query($con, $query);
$fname = "";
$lname = "";
$phone = "";
foreach($result as $row){
    $fname = $row["fname"];
    $lname = $row["lname"];
    $phone = $row["phone"];
}
mysqli_free_result($result);

?>