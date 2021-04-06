<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="styles/notify.css">
    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <title>Notifications</title>

  </head>

  <body>
    <h1 class="notification_title">Notifications</h1>
    <table class="notifications_table">
      <!--<tr>
        <th>Title</th>
        <th>Content</th>
        <th>Date</th>
      </tr>-->

      <?php
      $conn = mysqli_connect("localhost", "root", "", "etmp");
      if ($conn->connect_error) {
        die("Connection failed:". $conn->connect_error);
      }

      $sql = "SELECT * FROM notifications";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
          echo "<tr class='the_row'><td><h3>" . $row["title"] . "</h3></td><td class='dates' rowspan='2'>" . $row["date_received"] . "</td></tr><tr class='the_row'><td class='contents'>" . $row["content"] . "</td></tr>";
        }
        echo "</table";
      } else { echo "No Data"; }
      $conn->close();
      ?>
    </table>

  </body>
</html>
