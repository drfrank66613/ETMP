<!--Add this to your code to start the session-->
<?php include('session_control.php') ?>
<?php include('payment_validation.php')?>
<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="training, workshop">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">

    <!--Use link below to display icons on the navbar-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!--End of it-->

    <link rel="stylesheet" href="./styles/payment.css">

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
    <div class="wrap">

      <div class="split-wrap">
      <div class="split-left">
        <form action="payment.php" method="POST">

          <div class="fieldset-wrap">

          <fieldset class="payment-wrap">
          <div>
            <?php  if (count($errors) > 0) : ?>
               <div class="errors">
    	            <?php foreach ($errors as $error) : ?>
    	                <p><?php echo $error ?></p>
              	<?php endforeach ?>
               </div>
              <?php  endif ?>
            <div class="payment-items">
              <label for="cardnumber">Card Number</label>
              <input required type="text" inputmode="numeric" name="ccnumber" pattern="[0-9]*" class="payment-inputs" id="cardnumber" title="Input a valid Card">
            </div>
            <div class="payment-items">
              <label for="cardowner">Name on Card</label>
              <input required type="text" name="ccowner" class="payment-inputs" id="cardowner" title="Name should only contain letters and spaces">
            </div>
            <div class="inline">
            <div class="payment-items">
              <label for="expiry">Expiration Date</label>
              <input required type="text" inputmode="numeric" name="ccexpiry" pattern="[0-9\/]*" class="payment-inputs" id="expiry" placeholder="(MM/YY)">
            </div>
            <div class="payment-items">
              <label for="securitycode">CVV</label>
              <input required type="text" inputmode="numeric" name="ccsecurity" pattern="[0-9]{3,4}" class="payment-inputs" id="securitycode" title="3 or 4 digits behind your card">
            </div>
          </div>

            <div class="payment-items">
              <button type="submit" name="submitPayment" class="button-submit" value="Submit">Pay Now</button>
            </div>
            <div class="payment-items">
              <button onclick="window.location='client_homepage.php';" type="button" class="button-cancel">Cancel</button>
            </div>

          </div>
          </fieldset>
          </div>
        </form>

      </div>
      <div class="split-right">
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

        $chosen_training = $_COOKIE["training_name"];
        $query_workshop_details = "SELECT * FROM training_workshop WHERE training_name = '$chosen_training'";
        $result = mysqli_query($conn, $query_workshop_details);

        echo "<div class='checkout-container'>";
        echo "<div class='checkout-items'>";
        echo "<div class='image-container'>";
        echo "<img src='images/leadership-2.jfif' class='checkout-image' alt='Leadership'>";
        echo "</div>";
        echo "<div class='checkout-details'>";
        echo "<h2>Leadership and Communication</h2>";
        echo "<p>Price: RM300</p>";
        echo "<p>Duration: 6 hours</p>";
        echo "</div>
        </div>
        </div>";
        $conn->close();?>
      </div>
    </div>
  </div>

</body>
</html>
