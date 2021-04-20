<?php
session_start();

$con = new mysqli('localhost', 'root', '', 'etmp');

if($con->connect_error){
    die("Database error:". $con->connect_error);
}

$username = "";
$email = "";
$errors = array();

// Registration
if (isset($_POST['submitRegForm'])){
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $regPassword = mysqli_real_escape_string($con, $_POST['regPassword']);
    $confirmPass = mysqli_real_escape_string($con, $_POST['confirm-password']);

    if (!preg_match('/^[a-zA-Z]+[a-zA-Z0-9._]+$/', $username)) {
        array_push($errors, "Only alphanumeric characters are allowed for Username & must start with a letter");
    }
    if (!preg_match('/^[a-zA-Z0-9._]+$/', $regPassword)) {
        array_push($errors, "Only alphanumeric characters are allowed for Password");
    }
    if ($regPassword !== $confirmPass) {
        array_push($errors, "Password does not match");
    }
    if(strlen($username) > 30 ){
        array_push($errors, "Maximum character for Username is 30");
    }
    if(strlen($regPassword) > 12 ){
        array_push($errors, "Maximum character for Password is 12");
    }
    if(strlen($regPassword) < 8 ){
        array_push($errors, "Minimum character for Password is 8");
    }

    $user_check_query = "SELECT * FROM user_information WHERE username='$username' OR email_address='$email' LIMIT 1";
    $result = mysqli_query($con, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    
    if ($user) { 
        if ($user['username'] === $username) {
        array_push($errors, "Username already exists");
        }

        if ($user['email_address'] === $email) {
        array_push($errors, "Email already exists");
        }
    }

    if (count($errors) == 0) {
        $password = md5($regPassword);
  
        $query = "INSERT INTO user_information (username, email_address, password) 
                  VALUES('$username', '$email', '$password')";
        mysqli_query($con, $query);
        
        echo '<script type="text/javascript">'; 
        echo 'alert("You have registered successfully\nYou will be redirected to Login page");'; 
        echo 'window.location.href = "login_page.php";';
        echo '</script>';
           
    }
}

// Login
if (isset($_POST['submitLogInfo'])){
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);


    if (count($errors) == 0) {
        $password = md5($password);

        $con->set_charset('utf8mb4');
        $stmt = $con->prepare("SELECT privilege_level FROM user_information WHERE username=? limit 1");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $tempResult = $stmt->get_result();
        $value = $tempResult->fetch_object();
        if(empty($value->privilege_level)){
            $userLevelResult = '';
        }else{
            $userLevelResult = $value->privilege_level;
        }
          
        $query = "SELECT * FROM user_information WHERE username='$username' AND password='$password'";
        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result) == 1){
            $_SESSION['username'] = $username;
            if($userLevelResult == 'Client'){
                header('location: client_homepage.php');
            }elseif($userLevelResult == 'Admin'){
                header('location: admin_homepage.php');
            } 
           
        }else{
            array_push($errors, "Invalid Username or Password!");
        }
           
    }
}

?>