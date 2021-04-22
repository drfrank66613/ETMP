<!--Add this to your code to start the session-->
<?php include('session_control.php') ?>

<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <meta charset="UTF-8">
    <meta name="author" content="George Kennedy">
    <meta name="description" content="Home page">
    <meta name="keywords" content="training, workshop">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">

    <!--Use link below to display icons on the navbar-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="./styles/admin_about_page.css">
</head>
<body>
    <!--Use the title & navbar bar for all admin pages-->
    <div class="title">
        <img src="images/etmp_logo.png" alt="logo" style="margin-top: 1rem;">
        <h4 class="appdesc">ONE OF THE LARGEST TRAINING PROVIDER IN SARAWAK</h4>
    </div>
    <div class="navbar">
        <a href="admin_homepage.php">Request Handler</a>
        <a class="active" href="admin_about_page.php">About</a>
        <div class="rightnavbar">
            <a class="notif" href="notification_admin.php"><i class="fa fa-bell"></i></a>
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

    <div class="hero-image">
        <div class="hero-text">
            <div class="about-title">

                <h2>Our Story</h2>
                <hr>
            </div>

            <div class="lefttxt">
                <p>Expert.com is a local training provider which provides in-house training (or on site/bespoke) for companies or employees within Sarawak. <br><br> The objectives of Training Expert.com is to provide hands-on solutions through practical information sharing to help solve day to day business challenges by developing human capitals that meets the company’s needs.</p>
            </div>
            <div class="righttxt">
                <p >The company established since 2001 and has trained more than 50,000 people to improving their work productivity, leadership & communication skills, language proficiency, sales, negotiation & presentation  skills,  workplace  management  and  personal  development. <br><br> The  company  operates  completely independent and is open for clients and public throughout the years.</p>
            </div>
            <hr>
        </div>
    </div>
</body>
</html>
