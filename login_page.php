<?php
$con = new mysqli('localhost', 'root', '', 'etmp');

if($con->connect_error){
    die("Database error:". $con->connect_error);
}

$username = "";
$email = "";
$errors = array();

if (isset($_POST['submitLogInfo'])){
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    if (!preg_match('/^[a-zA-Z]+[a-zA-Z0-9._]+$/', $username)) {
        array_push($errors, "Only alphanumeric characters are allowed");
    }
    if ($password !== $confirmPass) {
        array_push($errors, "Password does not match");
    }
    if(strlen($username) > 30 ){
        array_push($errors, "Maximum character for Username is 30");
    }
    if(strlen($password) > 12 ){
        array_push($errors, "Maximum character for Password is 12");
    }
    if(strlen($password) < 8 ){
        array_push($errors, "Minimum character for Password is 8");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $userLevel = "SELECT privilege_level FROM user_information WHERE username='$username'";
        $query = "SELECT * FROM user_information WHERE username='$username' AND password='$password'";
        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result) == 1){
            $_SESSION['username'] = $username;
        }else{
            array_push($errors, "Invalid Username or Password!")
        }
           
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <meta charset="UTF-8">
    <meta name="author" content="George Kennedy">
    <meta name="description" content="Login page">
    <meta name="keywords" content="training, workshop">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles/login_page.css">
</head>
<body>
    <h1 class="title">Expert Training Managament Portal</h1>
    <p id="bigTxt">WE PROVIDE YOU THE BEST TRAINING WORKSHOP EVER!</p>
    <p id="smallTxt">Log In to Request Your Training Workshop Now!</p>
    
    <form action="login_page.php" method="POST" style="border:1px solid #ccc">
        <div class="container">
          <h1>Log In</h1>
          
          <hr>
        
          <label for="email"><b>Email</b></label>
          <input type="text" placeholder="Enter Your Email" name="email" required>
      
          <label for="password"><b>Password</b></label>
          <input type="password" placeholder="Enter Your Password" name="password" required>
      
       
          <button type="submit" name="submitLogInfo" class="signupbtn"><b>Log In</b></button>

          <p>Don't have an account ?   <a href="registration_form.php">Sign Up Now!</a></p>
          
        </div>
      </form>
</body>
</html>