<!--Add this to your code to start the session-->
<?php include('session_control.php') ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="./styles/training_details.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <!--Use link below to display icons on the navbar-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!--End of it-->
    <title>Training</title>

  </head>

  <body>
    <!--Use the title & navbar bar for all client pages-->
    <div class="title">
        <img src="images/etmp_logo.png" alt="logo" style="margin-top: 1rem;">
        <h4 class="appdesc">ONE OF THE LARGEST TRAINING PROVIDER IN SARAWAK</h4>
    </div>
    <div class="navbar">
        <a href="client_homepage.php">Home</a>
        <a href="my_training_page.php">My Training</a>
        <a href="client_about_page.php">About</a>
        <div class="rightnavbar">
            <a href="calendar_page.php"><i class="fa fa-calendar"></i></a>
            <a class="notif" href="notification.php"><i class="fa fa-bell"></i></a>
            <div class="dropdown">
                <button class="profile">Welcome, <?php echo $_SESSION['username']; ?><i class="fa fa-sort-down" ></i></button>
                <div class="dropdown-content">
                  <a href="profile_page.php">Edit Profile</a>
                  <a href="logout_session.php?logout">Log Out</a>
                </div>
              </div>
        </div>
    </div>
    <!---->
    <div class="wrapper">
    <h1>Training Courses</h1>
    <div class="card-container">
      <div class="card-item">
        <img class="item-image" src="images/leadership.jpg" alt="Leadership">
        <h2 class="item-content">Leadership &#38; Communication Skills</h2>
      </div>
      <div class="card-item">
        <img class="item-image" src="images/interrogation.jpg" alt="Negotiation">
        <h2 class="item-content">Negotiation Skills</h2>
      </div>
      <div class="card-item">
        <img class="item-image" src="images/presentation.jpg" alt="Presentation">
        <h2 class="item-content">Presentation Skills</h2>
      </div>
    </div>
  </div>
  </body>
  </html>
