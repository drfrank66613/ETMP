<!--Add this to your code to start the session-->
<?php include('session_control.php') ?>
<?php include('manage_itinerary_admin.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Itinerary Management</title>
    <link rel="stylesheet" href="styles/admin_itinerary_management_page.css">
    <link rel="stylesheet" href="styles/itinerary_page.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">

    <!--Use link below to display icons on the navbar-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!--End of it-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body>
    <!--Use the title & navbar bar for all admin pages-->
    <div class="title">
        <img src="images/etmp_logo.png" alt="logo" style="margin-top: 1rem;">
        <h4 class="appdesc">ONE OF THE LARGEST TRAINING PROVIDER IN SARAWAK</h4>
    </div>
    <div class="navbar">
        <a class="active" href="admin_homepage.php">Request Handler</a>
        <a href="admin_about_page.php">About</a>
        <div class="rightnavbar">
            <a class="notif" href="notification_admin.php"><i class="fa fa-bell"></i></a>
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


    <div id="contain" class="container">
        <div class="split-container">
            <h2>Training Itinerary</h2>
            <div class="client-info">
                <h3>Client Information</h3>
                <p><b>Name</b> <span style="padding-left:113px">: <?php echo $fname, " ", $lname; ?></span></p>
                <p><b>Phone Number</b><span style="padding-left:50px"> : <?php echo $phone; ?></span></p>
                <p><b>Date</b><span style="padding-left:122px"> : <?php echo date_format(date_create($date), "F d, Y"); ?></span></p>
                <?php 
                    if($modified_date != "-" && $modified_time != "-") {
                        echo '<p class="modification_request"><b>Requested Date</b><span style="padding-left:46px"> : ' . date_format(date_create($modified_date), "F d, Y") . '</span></p>';
                        echo '<p class="modification_request"><b>Requested Time</b><span style="padding-left:45px"> : ' . $time = date("h:i A",strtotime("+1 hour",strtotime($modified_time))) . '</span></p>';
                    }

                ?>
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
            <?php 
                
            ?>
            <div class="button-container">
                <div class="center">
                <form action="admin_itinerary_management_page.php" method="POST">
                    <input type="submit" name="accept" value="Accept" <?php if (!($training_itinerary_status == 'Waiting for modification')){ ?> disabled <?php   } ?>>
                    <input type="submit" name="reject" value="Reject" <?php if (!($training_itinerary_status == 'Waiting for modification')){ ?> disabled <?php   } ?>>
                </form>
                </div>
            </div>
        </div>
    </div>

<!--
    <div class="modification-respond-section">
        <button class="accept-modification-button">Accept Modification</button>
        <button class="reject-modification-button">Reject Modification</button>
    </div>

-->
</body>
</html>