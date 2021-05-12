<?php

$con = new mysqli('localhost', 'root', '', 'etmp');

if($con->connect_error){
    die("Database error:". $con->connect_error);
}

//fetching Itinerary from database
$con->set_charset('utf8mb4');
$stmt = $con->prepare("SELECT id FROM user_information WHERE username=? limit 1");
$stmt->bind_param('s', $_SESSION['username']);
$stmt->execute();
$tempResult = $stmt->get_result();
$value = $tempResult->fetch_object();
$id = $value->id;

$query = "SELECT request_form.fname, request_form.lname, request_form.phone, 
                training_itinerary.current_used_date, training_itinerary.current_used_time,
                training_workshop.training_duration, training_itinerary.training_itinerary_id,
                training_itinerary.training_itinerary_status
        FROM itinerary_management, training_itinerary, training_workshop, request_form
        WHERE itinerary_management.training_itinerary_id = training_itinerary.training_itinerary_id 
        AND itinerary_management.user_id = $id
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

foreach($result as $row){
    $fname = $row["fname"];
    $lname = $row["lname"];
    $phone = $row["phone"];
    $date = $row["current_used_date"];
    $time = $row["current_used_time"];
    $duration = $row["training_duration"];
    $training_itinerary_id = $row["training_itinerary_id"];
    $training_itinerary_status = $row["training_itinerary_status"];
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
if(isset($_POST['confirm'])){
    $content = $_SESSION['username'] . ' has confirmed his/her Training Itinerary';
    $notif_query = "INSERT INTO notifications (user_id, title, content) 
            VALUES (1, 'Itinerary Confirmed', '$content')";
    $changeStatus_query = "UPDATE training_itinerary 
                        SET training_itinerary_status='Confirmed'
                        WHERE training_itinerary_id = $training_itinerary_id";
    $notif_result = mysqli_query($con, $notif_query);
    $changeStatus_result = mysqli_query($con, $changeStatus_query);
    if($notif_result && $changeStatus_result){
        echo '<script type="text/javascript">'; 
        echo 'alert("Your Training Itinerary has been confirmed");'; 
        echo 'window.location.href = "itinerary_page.php";';
        echo '</script>';
    } else{
        echo "ERROR: Could not able to execute $notif_result & $changeStatus_result. " . mysqli_error($con);
    }

}

if(isset($_POST['modificationForm'])){
    $modified_date = $_POST['date'];
    $modified_time = $_POST['time'];

    $content = 'Itinerary modification from ' . $_SESSION['username'] . ' needs to be checked';
    $notif_query = "INSERT INTO notifications (user_id, title, content) 
            VALUES (1, 'Itinerary Modification', '$content')";
    $modify_query = "UPDATE training_itinerary 
                        SET modification_date = '$modified_date', modification_time = '$modified_time', training_itinerary_status = 'Waiting for modification'
                        WHERE training_itinerary_id = $training_itinerary_id";
   $modify_result = mysqli_query($con, $modify_query);
   $notif_result = mysqli_query($con, $notif_query);
   if($modify_result && $notif_query){
       echo '<script type="text/javascript">'; 
       echo 'alert("Your Training Itinerary changes has been sent to admin\nPlease wait for confirmation");'; 
       echo 'window.location.href = "itinerary_page.php";';
       echo '</script>';
   } else{
       echo "ERROR: Could not able to execute $modify_result & $notif_query. " . mysqli_error($con);
   }
}
?>