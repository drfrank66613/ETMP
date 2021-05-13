<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "etmp";
$conn = mysqli_connect("$host", "$dbUsername", "$dbPassword", "$dbname");
if ($conn->connect_error) {
  die("Connection failed:". $conn->connect_error);
}

$cardnumber = $cardowner = $expiry = $securitycode = "";

$errors = array();

if (isset($_POST['submitPayment'])){
  $cardnumber = mysqli_real_escape_string($conn, $_POST['ccnumber']);
  $cardowner = mysqli_real_escape_string($conn, $_POST['ccowner']);
  $expiry = mysqli_real_escape_string($conn, $_POST['ccexpiry']);
  $securitycode = mysqli_real_escape_string($conn, $_POST['ccsecurity']);

  function luhn_check($number) {
    $number=preg_replace('/\D/', '', $number);
    $number_length=strlen($number);
    $parity=$number_length % 2;
    $total=0;

    for ($i=0; $i<$number_length; $i++) {
      $digit=$number[$i];

      if ($i % 2 == $parity) {
        $digit*=2;

        if ($digit > 9) {
          $digit-=9;
        }
      }
      $total+=$digit;
    }
    return ($total % 10 == 0) ? TRUE : FALSE;
  }

  if(luhn_check($cardnumber) == FALSE || strlen($cardnumber) > 16){
      array_push($errors, "Invalid Card");
  }

  if (!preg_match('/^[a-zA-Z_]+( [a-zA-Z_]+)*$/', $cardowner)) {
      array_push($errors, "Invalid Name");
  }

  if (!preg_match('/^[0-9]{3,4}$/', $securitycode)){
      array_push($errors, "Invalid CVV code");
  }
  //Validate Dates From 2021 and beyond
  if (!preg_match('/^(0[1-9]|1[0-2])\/?([2-9][0-9])$/', $expiry)){
      array_push($errors, "Invalid Expiry Date");
  }

  //If validation successful, do something
  if (count($errors) == 0) {
      $chosen_training = $_COOKIE["training_name"];

      $user_name = $_SESSION["username"];


      // Form values
      $form_id;
      $chosen_training_start_date;
      $chosen_training_start_time;

      // Training workshop value
      $chosen_training_id;
      $training_price;

      // User information value
      $user_id;

      // Training itinerary value
      $itinerary_id;

      // Getting the request form id
      $sql = "SELECT * FROM request_form
              INNER JOIN user_information ON user_information.id = request_form.user_id
              WHERE request_form.request_status = 'Pending' OR request_form.request_status = 'In Progress'";

      $result = $conn->query($sql);

      while ($row = mysqli_fetch_assoc($result)) {
        $form_id = $row["form_id"];
        $chosen_training_start_date = $row["training_date"];
        $chosen_training_start_time = $row["training_time"];
      }


      // Getting the chosen training id
      $sql = "SELECT * FROM training_workshop WHERE training_name = '$chosen_training'";

      $result = $conn->query($sql);

      while ($row = mysqli_fetch_assoc($result)) {
        $chosen_training_id = $row["training_id"];
        $training_price = $row["training_price"];
      }


      // Getting the user id from current username session
      $sql = "SELECT * FROM user_information WHERE username = '$user_name'";

      $result = $conn->query($sql);

      while ($row = mysqli_fetch_assoc($result)) {
        $user_id = $row["id"];
      }

      // Update the request form status to 'Confirmed'
      $sql = "UPDATE request_form SET request_status = 'Confirmed' WHERE form_id = '$form_id'";
      $conn->query($sql);


      // Update the training workshop status in the unconfirmed_training_workshop
      $sql = "UPDATE unconfirmed_training_workshop SET training_status = 'confirmed' WHERE training_id = '$chosen_training_id'";
      $conn->query($sql);


      // Insert new entry into the training_itinerary table
      $sql = "INSERT INTO training_itinerary (training_id, form_id, training_itinerary_status, current_used_date, current_used_time, modification_date, modification_time)
                VALUES ('$chosen_training_id', '$form_id', 'Unconfirmed', '$chosen_training_start_date', '$chosen_training_start_time', '-', '-')";

      $conn->query($sql);


      // Getting the itinerary id from the entry that have been inserted to the training_itinerary table
      $sql = "SELECT * FROM training_itinerary WHERE training_id = '$chosen_training_id' AND form_id = '$form_id'";

      $result = $conn->query($sql);

      while ($row = mysqli_fetch_assoc($result)) {
        $itinerary_id = $row["training_itinerary_id"];
      }



      // Insert new entry into the itinerary_management table
      $sql = "INSERT INTO itinerary_management (user_id, training_itinerary_id) VALUES ('$user_id', '$itinerary_id')";
      $conn->query($sql);


      // Send notification to the Admin or Operator team side to indicate the payment is successful
      $admin_id = array();

      $sql = "SELECT * FROM user_information WHERE privilege_level = 'Admin'";
      $result = $conn->query($sql);

      while ($row = mysqli_fetch_assoc($result)) {
          array_push($admin_id, $row["id"]);
      }

      $training_name = strtolower($chosen_training);

      foreach ($admin_id as $id) {
          $sql = "INSERT INTO notifications (user_id, title, content) VALUES ($id, 'Payment is successful', '$user_name has pay the amount of $training_price for $training_name')";
          $conn->query($sql);
      }

      // Send notification to the Client side to indicate the payment is Successful
      $client_id = array();

      $sql = "SELECT * FROM user_information WHERE id = '$user_id'";
      $result = $conn->query($sql);

      while ($row = mysqli_fetch_assoc($result)) {
          array_push($client_id, $row["id"]);
      }

      foreach ($client_id as $id) {
        $sql ="INSERT INTO notifications (user_id, title, content) VALUES ($id, 'Payment is successful', '$user_name, Thank you for your payment of RM$training_price for $training_name')";
        $conn->query($sql);
      }


      // Finally insert a new entry into the payment details
      $sql = "INSERT INTO payment (user_id, payment_type, payment_amount, payment_status)
                VALUES ('$user_id', 'Credit Card', '$training_price', 'Successful')";

      $conn->query($sql);


      // Make alert and go back to homepage
      echo '<script type="text/javascript">';
      echo 'alert("The payment is successful.");';
      echo 'window.location.href = "client_homepage.php";';
      echo '</script>';


  }

}
