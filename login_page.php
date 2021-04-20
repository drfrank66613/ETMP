<?php include('authentication_control.php')?>

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

          <?php  if (count($errors) > 0) : ?>
             <div class="error">
  	            <?php foreach ($errors as $error) : ?>
  	                <p><?php echo $error ?></p>
            	<?php endforeach ?>
             </div>
            <?php  endif ?>
          
          <hr>
        
          <label for="username"><b>Username</b></label>
          <input type="text" placeholder="Enter Your Username" name="username" required>
      
          <label for="password"><b>Password</b></label>
          <input type="password" placeholder="Enter Your Password" name="password" required>
      
       
          <button type="submit" name="submitLogInfo" class="signupbtn"><b>Log In</b></button>

          <p>Don't have an account ?   <a href="registration_form.php">Sign Up Now!</a></p>
          
        </div>
    </form>
</body>
</html>