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


}

}
