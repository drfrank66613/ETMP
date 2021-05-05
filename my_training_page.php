<!--Add this to your code to start the session-->
<?php include('session_control.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Bryan Austyn Ichsan">
    <title>My Training</title>
    <link rel="stylesheet" href="styles/my_training.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--Use link below to display icons on the navbar-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--End of it-->
</head>
<body>
    <!--Use the title & navbar bar for all client pages-->
    <div class="title">
        <img src="images/etmp_logo.png" alt="logo" style="margin-top: 1rem;">
        <h4 class="appdesc">ONE OF THE LARGEST TRAINING PROVIDER IN SARAWAK</h4>
    </div>
    <div class="navbar">
        <a href="client_homepage.php">Home</a>
        <a class="active" href="my_training_page.php">My Training</a>
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

    <div id="module-tab">
        <button class="link" id="openByDefault" value="pending-section">Pending/In Progress Training</button>
        <button class="link" value="confirmed-section">Confirmed Training</button>
    </div>
    
    <div id="pending-section" class="content">
        <div class="training-workshop-content">
            <img src="images/leadership.jfif" alt="leadership">
            <div>
                <h3>First by default</h3>
                <p>Leadership & Communication</p>
                <p>Duration: 1 day</p>
                <p>Price: MYR 350</p>
                <p>The aim of this workshop on the art of listening is to learn what the speaker has to say about a subject. Employees benefit about each other as they pay attention to each other. A workplace where workers are continually learning from one another will benefit from a free flow of ideas that are genuinely listened to.</p>
            </div>
        </div>

        <div class="training-workshop-content">
            <img src="images/leadership.jfif" alt="leadership">
            <div>
                <h3>First by default</h3>
                <p>Leadership & Communication</p>
                <p>Duration: 1 day</p>
                <p>Price: MYR 350</p>
                <p>The aim of this workshop on the art of listening is to learn what the speaker has to say about a subject. Employees benefit about each other as they pay attention to each other. A workplace where workers are continually learning from one another will benefit from a free flow of ideas that are genuinely listened to.</p>
            </div>
        </div>
        
        <div id="user-interaction">
            <button class="cancel-request-button">Cancel request</button>
            <button class="request-alternatives-button">Request for more alternatives</button>
        </div>
    </div>

    <div id="confirmed-section" class="content">
        <div class="training-workshop-content">
            <img src="images/leadership.jfif" alt="leadership">
            <div>
                <h3>First by default</h3>
                <p>Leadership & Communication</p>
                <p>Duration: 1 day</p>
                <p>Price: MYR 350</p>
                <p>The aim of this workshop on the art of listening is to learn what the speaker has to say about a subject. Employees benefit about each other as they pay attention to each other. A workplace where workers are continually learning from one another will benefit from a free flow of ideas that are genuinely listened to.</p>
            </div>
        </div>

        <div class="training-workshop-content">
            <img src="images/leadership.jfif" alt="leadership">
            <div>
                <h3>First by default</h3>
                <p>Leadership & Communication</p>
                <p>Duration: 1 day</p>
                <p>Price: MYR 350</p>
                <p>The aim of this workshop on the art of listening is to learn what the speaker has to say about a subject. Employees benefit about each other as they pay attention to each other. A workplace where workers are continually learning from one another will benefit from a free flow of ideas that are genuinely listened to.</p>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            var defaultOpenSection = $("#openByDefault").attr("value");
            $("#openByDefault").css("border-bottom", "5px #0065ff solid");
            $("#" + defaultOpenSection).css("display", "block");
            $("#openByDefault").css("background-color", "white");
            $("#openByDefault").css("font-weight", "bold");
            $("#openByDefault").css("color", "#0065ff");

            $(".link").on("click", function() {
                $(".content").css("display", "none");
                var section = $(this).attr("value");

                $(".link").css("border-bottom", "none");
                $(".link").css("font-weight", "normal");
                $(".link").css("color", "black");

                $("#" + section).css("display", "block");
                $(this).css("border-bottom", "5px #0065ff solid");
                $(this).css("font-weight", "bold");
                $(this).css("color", "#0065ff");
                

            });

            $(".training-workshop-content").hover(function() {
                $(this).find("img").css("filter", "brightness(50%)");
                $(this).css("cursor", "pointer");
            }, function() {
                $(this).find("img").css("filter", "none");
                $(this).css("cursor", "auto");
            });
        });
    </script>
</body>
</html>