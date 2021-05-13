<!--Add this to your code to start the session-->
<?php include('session_control.php') ?>

<!DOCTYPE html>
<html>
<head>
    <title>Presentation Skills</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="training, workshop">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">

    <!--Use link below to display icons on the navbar-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!--End of it-->

    <link rel="stylesheet" href="./styles/workshop_details.css">

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
        <a class="active" href="presentation.php">Training Courses</a>
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
    <?php
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "etmp";
    $conn = mysqli_connect("$host", "$dbUsername", "$dbPassword", "$dbname");
    if ($conn->connect_error) {
      die("Connection failed:". $conn->connect_error);
    }

    $query_workshop_details = "SELECT * FROM training_workshop WHERE training_type_id = 3";
    $result = mysqli_query($conn, $query_workshop_details);
    $query_workshop_name = "SELECT * FROM training_type WHERE training_type_id = 3";
    $result_workshop_name = mysqli_query($conn, $query_workshop_name);
    $workshop_name = mysqli_fetch_assoc($result_workshop_name);

    echo "<div class='wrapper'>";

    echo "<h1>" . $workshop_name['training_type_name'] . "</h1>";
    if ($result->num_rows > 0) {
     while ($fetch = mysqli_fetch_assoc($result)){

    echo "<div class='container'>";
      echo "<div class='img-container'>";
        echo "<img src='" . $fetch['training_image_link'] . "' alt='" . $workshop_name['training_type_name'] . "'>";
        echo "</div>";

        echo "<div class='content-container'>";
        echo "<h2>" . $fetch['training_name'] . "</h2>";
        echo "<p class='bolded'>Price: MYR " . $fetch['training_price'] . "</p>";
        echo "<p class='bolded'>Duration: " . $fetch['training_duration'] . "</p>";
        echo "<p>" . $fetch['training_details'] . "</p>
      </div></div>"; }
    }

    echo "</div>

    </div>";$conn->close();?>


</body>
</html>
