<!--Add this to your code to start the session-->
<?php include('session_control.php') ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="styles/notify.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Notifications</title>

  </head>

  <body>
    <!--Use the title & navbar bar for all client pages-->
    <div class="title">
        <img src="images/etmp_logo.png" alt="logo" style="margin-top: 1rem;">
        <h4 class="appdesc">ONE OF THE LARGEST TRAINING PROVIDER IN SARAWAK</h4>
    </div>
    <div class="navbar">
        <a href="client_homepage.php">Home</a>
        <a href="#news">My Training</a>
        <a href="client_about_page.php">About</a>
        <div class="rightnavbar">
            <a class="active" class="notif" href="notification.php"><i class="fa fa-bell"></i></a>
            <div class="dropdown">
                <button class="profile">Welcome, <?php echo $_SESSION['username']; ?><i class="fa fa-sort-down" ></i></button>
                <div class="dropdown-content">
                  <a href="#">Edit Profile</a>
                  <a href="logout_session.php?logout">Log Out</a>
                </div>
              </div> 
        </div>  
    </div>
    <!---->
    
    <h1 class="notification_title">Notifications</h1>
    <table class="notifications_table">

      <?php
      $host = "localhost";
      $dbUsername = "root";
      $dbPassword = "";
      $dbname = "etmp";
      $conn = mysqli_connect("$host", "$dbUsername", "$dbPassword", "$dbname");
      if ($conn->connect_error) {
        die("Connection failed:". $conn->connect_error);
      }

      $sql = "SELECT * FROM notifications";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
          echo "<tr class='the_row'><td><h3>" . $row["title"] . "</h3></td><td class='dates' rowspan='2'>" . "<p>Date Received</p>" . $row["date_received"] . "</td></tr><tr class='the_row'><td class='contents'>" . $row["content"] . "</td></tr>";
        }
        echo "</table";
      } else { echo "No Data"; }
      $conn->close();
      ?>
    </table>

  </body>
</html>
