<?php

$con = new mysqli('localhost', 'root', '', 'etmp');

if($con->connect_error){
    die("Database error:". $con->connect_error);
}

//fetching Itinerary from database
$con->set_charset('utf8mb4');

$user_id;

$id = $_COOKIE["itinerary_id"];
$sql = "SELECT * FROM itinerary_management im 
        INNER JOIN training_itinerary ti 
        ON ti.training_itinerary_id = im.training_itinerary_id";
            
$result = $con->query($sql);

while ($row = mysqli_fetch_assoc($result)) {
    $user_id = $row["user_id"];
}


$query = "SELECT request_form.fname, request_form.lname, request_form.phone, 
                training_itinerary.current_used_date, training_itinerary.current_used_time,
                training_workshop.training_duration, training_itinerary.training_itinerary_id,
                training_itinerary.training_itinerary_status, training_itinerary.modification_date, training_itinerary.modification_time
        FROM itinerary_management, training_itinerary, training_workshop, request_form
        WHERE itinerary_management.training_itinerary_id = training_itinerary.training_itinerary_id 
        AND itinerary_management.user_id = $user_id
        AND training_itinerary.training_id = training_workshop.training_id
        AND request_form.form_id = training_itinerary.form_id
        AND training_itinerary.training_id = training_workshop.training_id";

$result = mysqli_query($con, $query);
$fname = "";
$lname = "";
$phone = "";
$date = "";
$time = "";
$duration = "";
$training_itinerary_id = "";
$training_itinerary_status = "";
$modified_date = "";
$modified_time = "";

foreach($result as $row){
    $fname = $row["fname"];
    $lname = $row["lname"];
    $phone = $row["phone"];
    $date = $row["current_used_date"];
    $time = $row["current_used_time"];
    $duration = $row["training_duration"];
    $training_itinerary_id = $row["training_itinerary_id"];
    $training_itinerary_status = $row["training_itinerary_status"];
    $modified_date = $row["modification_date"];
    $modified_time = $row["modification_time"];
}
mysqli_free_result($result);
$duration = substr($duration, 0,1);
$startTime = $time;
$hours = '';
if($duration == '5'){
    $hours = '+3 hours';
}
if($duration == '4'){
    $hours = '+2 hours';
}

//Send notification to admin & change status of itinerary
if(isset($_POST['accept'])){
    $content = 'The operation team has accepted your training itinerary modification request';
    $notif_query = "INSERT INTO notifications (user_id, title, content) 
            VALUES ('$user_id', 'Accept Itinerary Modification', '$content')";
    $changeStatus_query = "UPDATE training_itinerary 
                        SET training_itinerary_status='Modification Accepted', current_used_date = '$modified_date', current_used_time = '$modified_time', modification_date = '-', modification_time = '-'
                        WHERE training_itinerary_id = $training_itinerary_id";
    $notif_result = mysqli_query($con, $notif_query);
    $changeStatus_result = mysqli_query($con, $changeStatus_query);
    if($notif_result && $changeStatus_result){
        echo '<script type="text/javascript">'; 
        echo 'alert("The Training Itinerary has been successfully modified");'; 
        echo 'window.location.href = "admin_homepage.php";';
        echo '</script>';
    } else{
        echo "ERROR: Could not able to execute $notif_result & $changeStatus_result. " . mysqli_error($con);
    }

}

if(isset($_POST['reject'])){
    $content = 'The operation team has rejected your training itinerary modification request';
    $notif_query = "INSERT INTO notifications (user_id, title, content) 
            VALUES ('$user_id', 'Reject Itinerary Modification', '$content')";
    $modify_query = "UPDATE training_itinerary 
                        SET modification_date = '-', modification_time = '-', training_itinerary_status = 'Modification Rejected'
                        WHERE training_itinerary_id = $training_itinerary_id";
   $modify_result = mysqli_query($con, $modify_query);
   $notif_result = mysqli_query($con, $notif_query);
   if($modify_result && $notif_query){
       echo '<script type="text/javascript">'; 
       echo 'alert("The Training Itinerary modification request has been rejected");'; 
       echo 'window.location.href = "admin_homepage.php";';
       echo '</script>';
   } else{
       echo "ERROR: Could not able to execute $modify_result & $notif_query. " . mysqli_error($con);
   }
}
?>