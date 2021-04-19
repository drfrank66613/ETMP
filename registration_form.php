<?php
$con = new mysqli('localhost', 'root', '', 'etmp');

if($con->connect_error){
    die("Database error:". $con->connect_error);
}

$username = "";
$email = "";
$errors = array();

if (isset($_POST['submitRegForm'])){
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirmPass = mysqli_real_escape_string($con, $_POST['confirm-password']);

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
        $password = md5($password);
  
        $query = "INSERT INTO user_information (username, email_address, password) 
                  VALUES('$username', '$email', '$password')";
        mysqli_query($con, $query);
           
    }
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <meta charset="UTF-8">
    <meta name="author" content="George Kennedy">
    <meta name="description" content="Registration form page">
    <meta name="keywords" content="training, workshop">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles/registration_form.css">
</head>
<body>
    <h1 class="title">Expert Training Managament Portal</h1>
    <p id="bigTxt">WE PROVIDE YOU THE BEST TRAINING WORKSHOP EVER!</p>
    <p id="smallTxt">Sign Up to Request Your Training Workshop Now!</p>
    <form action="registration_form.php" method="POST" style="border:1px solid #ccc">
        <div class="container">
          <h2 >Sign Up</h2>
          <?php  if (count($errors) > 0) : ?>
             <div class="error">
  	            <?php foreach ($errors as $error) : ?>
  	                <p><?php echo $error ?></p>
            	<?php endforeach ?>
             </div>
            <?php  endif ?>
          <hr>

          <label for="username"><b>Username</b></label>
          <input type="text" placeholder="Enter Your Username" name="username" value="<?php echo $username;?>" required>
      
          <label for="email"><b>Email</b></label>
          <input type="email" placeholder="Enter Your Email" name="email" value="<?php echo $email;?>" required>
      
          <label for="password"><b>Password</b></label>
          <input type="password" placeholder="Enter Your Password" name="password" required>
      
          <label for="password-confirm"><b>Confirm Password</b></label>
          <input type="password" placeholder="Confirm Your Password" name="confirm-password" required>
       
          <button type="submit" name="submitRegForm" value="Submit" class="signupbtn"><b>Sign Up</b></button>

          <button onclick="window.location='login_page.html';" type="button" class="cancelbtn"><b>Cancel</b></button>
          
        </div>
      </form>
</body>
</html>