<?php
session_start();

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

$query = "SELECT training_workshop.training_name, training_itinerary.current_used_date 
        FROM itinerary_management, training_itinerary, training_workshop 
        WHERE itinerary_management.training_itinerary_id = training_itinerary.training_itinerary_id 
        AND itinerary_management.user_id = $id
        AND training_itinerary.training_id = training_workshop.training_id";

$result = mysqli_query($con, $query);
$eventArray = array();
foreach($result as $row){
    $event = array(
        'title' => $row["training_name"],
        'start' => $row["current_used_date"]
    );
    array_push($eventArray, $event);
}
mysqli_free_result($result);

echo json_encode($eventArray);
?>