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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
        <a href="my_training_page.php">My Training</a>
        <a href="client_about_page.php">About</a>
        <div class="rightnavbar">
            <a class="calendar" href="calendar_page.php"><i class="fa fa-calendar"></i></a>
            <a class="notif" href="notification.php"><i class="fa fa-bell"></i></a>
            <div class="dropdown">
                <button class="profile">Welcome, <?php echo $_SESSION['username']; ?><i class="fa fa-sort-down" ></i></button>
                <div class="dropdown-content">
                  <a href="profile_page.php" id="editProfileBtn">Edit Profile</a>
                  <a href="logout_session.php?logout">Log Out</a>
                </div>
              </div>
        </div>
    </div>
    <!---->

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
    <!--General Information-->
    <div class="grid">
      <div class="grid-item">
        <i class="fas fa-mountain"></i>
        <h3 class="item-title">Discover New Frontiers</h3>
        <p>Explore new skills, deepen existing passions, and get lost in creativity. What you find just might surprise and inspire you.</p>
      </div>
      <div class="grid-item">
        <i class="fas fa-user-tie"></i>
        <h3 class="item-title">Raise Your Standards</h3>
        <p>Move your creative journey forward without putting life on hold. Wow your employers and let us help you find inspiration that fits your routine.</p>
      </div>
      <div class="grid-item">
        <i class="fas fa-network-wired"></i>
        <h3 class="item-title">Diversify Your Portfolio</h3>
        <p>Diversify your portfolio, whether you’ve got a fresh idea or are looking for a new way to make money.</p>
      </div>
    </div>
    <!---->
</body>
</html>
