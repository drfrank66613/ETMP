<?php include('authentication_control.php')?>

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
    <img class="center" src="images/etmp_logo.png" alt="logo">
    <p id="bigTxt">WE PROVIDE YOU THE BEST TRAINING WORKSHOP EVER!</p>
    <p id="smallTxt">Sign Up to Request Your Training Workshop Now!</p>
    <form action="registration_form.php" method="POST">
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
          <input type="password" placeholder="Enter Your Password" name="regPassword" required>
      
          <label for="password-confirm"><b>Confirm Password</b></label>
          <input type="password" placeholder="Confirm Your Password" name="confirm-password" required>
       
          <button type="submit" name="submitRegForm" value="Submit" class="signupbtn"><b>Sign Up</b></button>

          <button onclick="window.location='login_page.php';" type="button" class="cancelbtn"><b>Cancel</b></button>
          
        </div>
      </form>
</body>
</html>