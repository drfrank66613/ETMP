<!--Add this to your code to start the session-->
<?php include('session_control.php') ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="styles/training_request_form.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Training Request Form</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <script src="scripts/requestForm.js"></script>
  </head>

  <body>

    <div class="title">
        <img src="images/etmp_logo.png" alt="logo" style="margin-top: 1rem;">
        <h4 class="appdesc">ONE OF THE LARGEST TRAINING PROVIDER IN SARAWAK</h4>
    </div>
    <div class="navbar">
        <a href="client_homepage.php">Home</a>
        <a href="#news">My Training</a>
        <a href="client_about_page.php">About</a>
        <div class="rightnavbar">
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

    <h1 class="form_title">Training Request Form</h1>

    <div class="wrapper">
    <form action="connect_request_to_database.php" method="POST">
      <fieldset>
        <legend>Customer Details</legend>
        <hr>
        <div class="form_group">
          <input type="text" class="form_control" placeholder="First Name" name="firstname" required>

          <input type="text" class="form_control" placeholder="Last Name" name="lastname" required>
        </div>
        <div class="form_wrapper">
          <input type="tel" class="form_control" placeholder="Contact Number" name="phone" required>
        </div>
        <div class="form_wrapper">
          <input type="text" class="form_control" placeholder="Address" name="address" required>
        </div>

        <div class="form_group">

          <input type="text" class="form_control" placeholder="City" name="city" required>

           <select name="state" class="form_control" required>
            <option value="" disabled selected>State</option>
            <option value="Johor">Johor</option>
            <option value="Kedah">Kedah</option>
            <option value="Kelantan">Kelantan</option>
            <option value="Kuala Lumpur">Kuala Lumpur</option>
            <option value="Labuan">Labuan</option>
            <option value="Malacca">Malacca</option>
            <option value="Negeri Sembilan">Negeri Sembilan</option>
            <option value="Pahang">Pahang</option>
            <option value="Perak">Perak</option>
            <option value="Perlis">Perlis</option>
            <option value="Penang">Penang</option>
            <option value="Sabah">Sabah</option>
            <option value="Sarawak">Sarawak</option>
            <option value="Selangor">Selangor</option>
            <option value="Terengganu">Terengganu</option>
           </select>

          </div>
       </fieldset>

       <fieldset>
         <legend>Training Details</legend>
         <hr>
          <div class="form_group">
            <select name="training_name" class="form_control" required>
                <option value="" disabled selected>Training Course</option>
                <option value="Leadership & Communication skills">Leadership &#38; Communication Skills</option>
                <option value="Negotiation skills">Negotiation Skills</option>
                <option value="Presentation skills">Presentation Skills</option>
            </select>

            <select name="venue" class="form_control" required>
                <option value="" disabled selected>Venue</option>
                <option value="Kuching Branch">Kuching Branch</option>
                <option value="Miri Branch">Miri Branch</option>
                <option value="Sibu Branch">Sibu Branch</option>
            </select>
          </div>

          <div class="form_group">
          <input type="date" class="form_control"  name="date" onkeydown="return false" required>
          <input type="text" id="timePicker" placeholder="--:--" class="form_control" name="time" onkeydown="return false" required>
          </div>
       </fieldset>

       <fieldset class="form_submit">
          <div class="form_group">
            <button type="submit" class="button_submit" value="Submit">Submit</button>
            <button onclick="window.location='client_homepage.php';" type="button" class="button_cancel">Cancel</button>
          </div>
       </fieldset>
      </form>
      </div>
      <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
      <script type="text/javascript">
      $('#timePicker').timepicker({
        timeFormat: 'h:mm p',
        interval: 60,
        minTime: '10:00am',
        maxTime: '4:00pm',
        dynamic: false,
        dropdown: true,
      });
      </script>
  </body>
</html>
