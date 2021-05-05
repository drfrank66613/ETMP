<!--Add this to your code to start the session-->
<?php include('session_control.php')?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="./styles/notify.css">
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

    <h1 class="notification_title">Notifications</h1>

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

      $username = $_SESSION['username'];
      $query_user_id = "SELECT * FROM user_information WHERE '$username' = username";
      $result_user_id = mysqli_query($conn, $query_user_id);
      $row = mysqli_fetch_assoc($result_user_id);
      $userid = $row['id'];

      $query_notification = "SELECT * FROM notifications WHERE user_id = $userid ORDER BY date_received DESC";
      $result_notification = mysqli_query($conn, $query_notification);
      if ($result_notification->num_rows > 0) {
        while ($fetch = mysqli_fetch_assoc($result_notification)){
       echo "<table class='notifications_table'>
       <tr>
        <td class ='notification_topic'><h3>" . $row["username"] . ', ' . $fetch["title"] . "</h3></td>
        <td class = 'date_notification_received'>" . $fetch["date_received"] . "</td>
      </tr>
      <tr class = 'table_rows'>
        <td colspan='2' class ='second_row'><span>" .$fetch["content"] . "</span</td>

      </tr>
      </table>";
    }
  }else { echo "<h3 class='notification_empty'>You currently have 0 notifications</h3>"; }
  $conn->close();
  ?>


  </body>
</html>
