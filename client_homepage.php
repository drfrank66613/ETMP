<!--Add this to your code to start the session-->
<?php include('session_control.php') ?>

<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="George Kennedy">
    <meta name="description" content="Home page">
    <meta name="keywords" content="training, workshop">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    
    <!--Use link below to display icons on the navbar-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--End of it-->
    
    <link rel="stylesheet" href="./styles/client_homepage.css">
    
</head>
<body>
    <!--Use the title & navbar bar for all client pages-->
    <div class="title">
        <img src="images/etmp_logo.png" alt="logo" style="margin-top: 1rem;">
        <h4 class="appdesc">ONE OF THE LARGEST TRAINING PROVIDER IN SARAWAK</h4>
    </div>
    <div class="navbar">
        <a class="active" href="client_homepage.php">Home</a>
        <a href="#news">My Training</a>
        <a href="client_about_page.php">About</a>
        <div class="rightnavbar">
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
    <div id="modalBox" class="modal-box">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form action="/action_page.php" class="form-container">
                <h1>Edit Profile</h1>
                <label for="username"><b>Username</b></label>
                <input type="text" name="username" value="<?php echo $_SESSION['username'];?>" required>
        
                <label for="email"><b>Email</b></label>
                <input type="email" name="email" value="dm66613@gmail.com" required>
        
                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter Your New Password" name="regPassword" required>
        
                <label for="password-confirm"><b>Confirm Password</b></label>
                <input type="password" placeholder="Confirm Your Password" name="confirm-password" required>

                <button type="submit" name="submitEditForm" value="Submit" class="savebtn"><b>Save Changes</b></button>
                <button type="button" class="cancelbtn"><b>Cancel</b></button>
            </form>
        </div>
    </div>
    <script src="./scripts/editProfileModalBox.js"></script>

    <div class="hero-image">
        <div class="hero-text">
            <p id="longtxt">We provide you hands-on solutions through practical information sharing to help solve day  to  day  business  challenges  by  developing  human  capitals  that  meets  your  company’s  needs.</p>
                <div class="container"><p>Expert.com has the right training workshop for you</p>
                    <a href="request_form.php">
                        <button type="button" ><b>Request Now</b></button>
                    </a>
                    <button type="button" ><b>Learn More</b></button>
                </div>
        </div>
    </div>
</body>
</html>