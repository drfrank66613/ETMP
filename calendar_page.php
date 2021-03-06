<!--Add this to your code to start the session-->
<?php include('session_control.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Calendar Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="George Kennedy">
    <!--Full Calendar Links-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <!--End of it--> 
    <!--Use link below to display icons on the navbar-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!--End of it-->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="./styles/calendar_page.css">

    <script>
        $(document).ready(function(){
            var calendar = $('#calendar').fullCalendar({
                editable:true,
                header:{
                    left:'prev',
                    center:'title',
                    right:'today next'
                },
                events: {
                    url: './calendar_event_management.php',
                    color: '#ff9a00',
                    textColor: 'black'
                },
                eventConstraint: {
                    start: moment().format('YYYY-MM-DD'),
                    end: '2100-01-01'
                },
                eventClick: function(calEvent, jsEvent, view) {
                    alert('Training: ' + calEvent.title + 
                            '\nDate: ' + calEvent.start.format('YYYY-MM-DD') +
                            '\nTime: ' + calEvent.time);
                    
                }
                
            });
        });
    </script>
    
</head>
<body>
<!--Use the title & navbar bar for all client pages-->
    <div class="title">
        <img id="logo" src="images/etmp_logo.png" alt="logo" style="margin-top: 1rem;">
        <script>
            document.getElementById('logo').onclick = function() {
                <?php if($_SESSION['userLevel'] == 'Client') : ?>
                    location.href = "client_homepage.php";
                <?php  endif ?>
                <?php if($_SESSION['userLevel'] == 'Admin') : ?>
                    location.href = "admin_homepage.php";
                <?php  endif ?>
            }
        </script>
        <h4 class="appdesc">ONE OF THE LARGEST TRAINING PROVIDER IN SARAWAK</h4>
    </div>
    <div class="navbar">
        <a href="client_homepage.php">Home</a>
        <a href="my_training_page.php">My Training</a>
        <a href="client_about_page.php">About</a>
        <div class="rightnavbar">
            <a class="active" href="calendar_page.php"><i class="fa fa-calendar"></i></a>
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
        <h1>Calendar</h1>
        <div id="calendar"></div>
    </div>


</body>
</html>