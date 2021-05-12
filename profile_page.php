<!--Add this to your code to start the session-->
<?php include('session_control.php') ?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="George Kennedy">
    <meta name="description" content="Home page">
    <meta name="keywords" content="training, workshop">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    
    <!--Use link below to display icons on the navbar-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!--End of it-->
    
    <link rel="stylesheet" href="./styles/profile_page.css">
    
</head>
<body>
    <!--Use the title & navbar bar for all client pages-->
    <div class="title">
        <img src="images/etmp_logo.png" alt="logo" style="margin-top: 1rem;">
        <h4 class="appdesc">ONE OF THE LARGEST TRAINING PROVIDER IN SARAWAK</h4>
    </div>
    <div class="navbar">
        <?php if($_SESSION['userLevel'] == 'Client') : ?>
            <a href="client_homepage.php">Home</a>
            <a href="my_training_page.php">My Training</a>
            <a href="client_about_page.php">About</a>
            <a class="active" href="profile_page.php">Profile</a>
        <?php  endif ?>

        <?php if($_SESSION['userLevel'] == 'Admin') : ?>
            <a href="admin_homepage.php">Request Handler</a>
            <a href="admin_about_page.php">About</a>
            <a class="active" href="profile_page.php">Profile</a>
        <?php  endif ?>
        
        <div class="rightnavbar">
            <a class="calendar" href="calendar_page.php"><i class="fa fa-calendar"></i></a>
            <a class="notif" href="notification.php"><i class="fa fa-bell"></i></a>
            <div class="dropdown">
                <button class="profile">Welcome, <?php echo $_SESSION['username']; ?><i class="fa fa-sort-down" ></i></button>
                <div class="dropdown-content">
                  <a href="#" id="editProfileBtn">Edit Profile</a>
                  <a href="logout_session.php?logout">Log Out</a>
                </div>
              </div> 
        </div>  
    </div>
    <!---->
    <?php
    $con = new mysqli('localhost', 'root', '', 'etmp');

    if($con->connect_error){
        die("Database error:". $con->connect_error);
    }

    $errors = array();
    if (isset($_POST['submitEditForm'])){
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

        if (count($errors) == 0) {
            $userSession = $_SESSION['username'];
            $password = md5($regPassword);
    
            $query = "UPDATE user_information SET username = '$username', email_address = '$email',
                        password = '$password' WHERE username = '$userSession' ";
            mysqli_query($con, $query);
            
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            echo '<script type="text/javascript">'; 
            echo 'alert("Your profile updated successfully");'; 
            echo 'window.location.href = "profile_page.php";';
            echo '</script>';
            
        }
    }
    ?>
    <form action="profile_page.php" class="form-container" method="POST">
        <h1>Edit Profile</h1>
        <?php  if (count($errors) > 0) : ?>
             <div class="error">
  	            <?php foreach ($errors as $error) : ?>
  	                <p><?php echo $error ?></p>
            	<?php endforeach ?>
             </div>
            <?php  endif ?>
        <hr>
        <label for="username"><b>Username</b></label>
        <input type="text" name="username" value="<?php echo $_SESSION['username'];?>" required>

        <label for="email"><b>Email</b></label>
        <input type="email" name="email" value="<?php echo $_SESSION['email'];?>" required>

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Your New Password" name="regPassword" required>

        <label for="password-confirm"><b>Confirm Password</b></label>
        <input type="password" placeholder="Confirm Your Password" name="confirm-password" required>

        <button type="submit" name="submitEditForm" value="Submit" class="savebtn"><b>Save Changes</b></button>
        <button id="cancel" type="button" class="cancelbtn"><b>Cancel</b></button>
        <script>
            document.getElementById('cancel').onclick = function() {
                <?php if($_SESSION['userLevel'] == 'Client') : ?>
                    location.href = "client_homepage.php";
                <?php  endif ?>
                <?php if($_SESSION['userLevel'] == 'Admin') : ?>
                    location.href = "admin_homepage.php";
                <?php  endif ?>
            }
        </script>
    </form>

</body>
</html>