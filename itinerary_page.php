<!--Add this to your code to start the session-->
<?php include('session_control.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Itinerary Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="George Kennedy">
    <!--Use link below to display icons on the navbar-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!--End of it-->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="./styles/itinerary_page.css">
    
</head>
<body>
<!--Use the title & navbar bar for all client pages-->
    <div class="title">
        <img src="images/etmp_logo.png" alt="logo" style="margin-top: 1rem;">
        <h4 class="appdesc">ONE OF THE LARGEST TRAINING PROVIDER IN SARAWAK</h4>
    </div>
    <div class="navbar">
        <a href="client_homepage.php">Home</a>
        <a class="active"  href="my_training_page.php">My Training</a>
        <a href="client_about_page.php">About</a>
        <div class="rightnavbar">
            <a href="calendar_page.php"><i class="fa fa-calendar"></i></a>
            <a href="notification.php"><i class="fa fa-bell"></i></a>
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

    <div class="container">
        <div>
            <h2>Training Itinerary</h2>
            <div class="client-info">
                <h3>Client Information</h3>
                <p><b>Name</b> <span style="padding-left:113px">: George Kennedy</span></p>
                <p><b>Phone Number</b><span style="padding-left:49px"> : 016211111</span></p>
                <p><b>Date (Day 1)</b><span style="padding-left:70px"> : May 10, 2021</span></p>
                <p><b>Date (Day 2)</b><span style="padding-left:70px"> : May 11, 2021</span></p>
            </div>
        </div>
        <div>
            <h2>Day 1</h2>
            <table>
            <tr>
                <th>Time</th>
                <th>Activity</th>
            </tr>
            <tr>
                <td>10:00</td>
                <td>Opening Ceremony</td>
            </tr>
            <tr>
                <td>12:00</td>
                <td>Break</td>
            </tr>
            <tr>
                <td>13:00</td>
                <td>Training Session Starts</td>
            </tr>
            <tr>
                <td>16:00</td>
                <td>Closing Remarks</td>
            </tr>
            </table>
        </div>
        <div>
            <h2>Day 2</h2>
            <table>
            <tr>
                <th>Time</th>
                <th>Activity</th>
            </tr>
            <tr>
                <td>10:00</td>
                <td>Mini Games</td>
            </tr>
            <tr>
                <td>11:00</td>
                <td>Break</td>
            </tr>
            <tr>
                <td>12:00</td>
                <td>Training Session Starts</td>
            </tr>
            <tr>
                <td>15:00</td>
                <td>Closing Remarks</td>
            </tr>
            </table>
        </div>
        
    </div>

    


</body>
</html>