<!--Add this to your code to start the session-->
<?php include('session_control.php') ?>

<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="George Kennedy, Bryan Austyn Ichsan">
    <meta name="description" content="Home page">
    <meta name="keywords" content="training, workshop">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    
    <!--Use link below to display icons on the navbar-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="./styles/admin_homepage.css">
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
            <a class="notif" href="#notification"><i class="fa fa-bell"></i></a>
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

    <section id="requests-management-section">
        <h1 id="Request-heading">Request Handler System</h1>
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "etmp";

            $conn = mysqli_connect($servername, $username, $password, $dbname);

            if ($conn->connect_errno) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM request_form WHERE request_status='Pending' OR request_status='In Progress'";
            $result = $conn->query($sql);

            mysqli_num_rows($result);
            $headers = array("First Name", "Last Name", "Selected Training Type", "Status", "Date Created");


            $numOfHeaders = 5;


            if (($result)) {
                echo "<table class='request-table'> <tr>";

                if (mysqli_num_rows($result) > 0) {
                    for ($i = 0; $i < $numOfHeaders; $i++) {
                        echo "<th>" . $headers[$i] . "</th>";
                    }
                    echo "</tr>";

                    while ($rows = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        echo "<tr>";
                        
                        echo "<td>" . $rows['fname'] . "</td>";
                        echo "<td>" . $rows['lname'] . "</td>";
                        $data_int = (int)$rows['training_type_id'];
                            
                        $sql_2 = "SELECT * FROM training_type WHERE training_type_id = $data_int";
                        $result2 = $conn->query($sql_2);
                        
                        while ($row = mysqli_fetch_assoc($result2)) {
                            echo "<td>" . $row['training_type_name'] . "</td>";
                        }

                        echo "<td>" . $rows['request_status'] . "</td>";
                        echo "<td>" . $rows['request_date'] . "</td>";
                        
                        echo "<td><button class='button-training-request' name='lala' type='submit'" . " value= " . $rows['form_id'] . ">Manage</button></td>";
                        echo "</tr>";
                    }
                }
                else {
                    echo "No Results found!";
                }
                echo "</table>";
            }
        ?>

    </section>    
    <script src="scripts/requestHandlerSystem.js"></script>
</body>
</html>