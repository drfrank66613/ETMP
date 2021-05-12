<!--Add this to your code to start the session-->
<?php include('session_control.php') ?>
<?php include('itinerary_management.php') ?>

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
    <script src="scripts/requestForm.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    
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

    <div id="contain" class="container">
        <div class="split-container">
            <h2>Training Itinerary</h2>
            <div class="client-info">
                <h3>Client Information</h3>
                <p><b>Name</b> <span style="padding-left:113px">: <?php echo $fname, " ", $lname; ?></span></p>
                <p><b>Phone Number</b><span style="padding-left:49px"> : <?php echo $phone; ?></span></p>
                <p><b>Date</b><span style="padding-left:122px"> : <?php echo date_format(date_create($date), "F d, Y"); ?></span></p>
            </div>
            <div class="itinerary-status">
                <h4>Itinerary Status <br><h4 class="normal-heading"><?php echo $training_itinerary_status; ?></h4></h4>
            </div>
        </div>
        <div>
            <h2>Rundowns</h2>
            <table>
            <tr>
                <th>Time</th>
                <th>Activity</th>
            </tr>
            <tr>
                <td><?php echo $time; ?></td>
                <td>Opening Ceremony</td>
            </tr>
            <tr>
                <td><?php echo $time = date('h:i A',strtotime('+1 hour',strtotime($time))); ?></td>
                <td>Break</td>
            </tr>
            <tr>
                <td><?php echo $time = date('h:i A',strtotime('+1 hour',strtotime($time))); ?></td>
                <td>Training Session Starts</td>
            </tr>
            <tr>
                <td><?php echo $time = date('h:i A',strtotime($hours, strtotime($time))); ?></td>
                <td>Closing Remarks</td>
            </tr>
            </table>
            <div class="button-container">
                <div class="center">
                <form action="itinerary_page.php" method="POST">
                    <input type="submit" name="confirm" value="Confirm" <?php if ($training_itinerary_status == 'Confirmed' or $training_itinerary_status == 'Waiting for modification'){ ?> disabled <?php   } ?>>
                    <input onclick="showDiv()" type="button" value="Modify" <?php if ($training_itinerary_status == 'Confirmed' or $training_itinerary_status == 'Waiting for modification'){ ?> disabled <?php   } ?>>
                </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showDiv(){
            document.getElementById('modif-contain').style.display = "block";
            window.location = '#modif-contain';
        }
    </script>

    <div id="modif-contain" class="modif-container" style="display:none";>
        <h2>Itinerary Modification</h2>
        <form class="modif-form" action="itinerary_page.php" method="POST">
            <label for="time"><b>Start Time</b></label>
            <input type="text" name="time" id="timepicker" value="<?php echo $startTime; ?>">

            <label for="date"><b>Date</b></label>
            <input type="date" name="date" value="<?php echo $date; ?>">

            <button type="submit" name="modificationForm" value="Submit" class="submitbtn"><b>Submit</b></button>

            <button onclick="closeDiv()" type="button" class="cancelbtn"><b>Cancel</b></button>
        </form>
        <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
            <script type="text/javascript">
            $(document).ready(function(){
                $('#timepicker').timepicker({
                timeFormat: 'h:mm p',
                interval: 60,
                minTime: '10:00am',
                maxTime: '4:00pm',
                dynamic: false,
                dropdown: true,
                scrollbar: true
                });
            });
            </script>
    </div>

    <script>
        function closeDiv(){
            document.getElementById('modif-contain').style.display = "none";
            window.location = '#contain';
        }
    </script>

    


</body>
</html>