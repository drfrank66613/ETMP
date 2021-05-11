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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!--End of it-->
    <link rel="stylesheet" href="./styles/admin_homepage.css">
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

    <!-- In Page Module Tab -->
    <div id="module-tab">
        <button class="link" id="openByDefault" value="requests-management-section">Requests</button>
        <button class="link" value="training-itinerary-management-section">Training Itinerary</button>
    </div>




    <section id="requests-management-section" class="content">
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
            $headers = array("Form ID", "First Name", "Last Name", "Selected Training Type", "Request Status", "Date Created");


            $numOfHeaders = 6;


            if (($result)) {
                echo "<table class='management-table'> <tr>";

                if (mysqli_num_rows($result) > 0) {
                    for ($i = 0; $i < $numOfHeaders; $i++) {
                        echo "<th>" . $headers[$i] . "</th>";
                    }
                    echo "</tr>";

                    while ($rows = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        echo "<tr>";
                        
                        echo "<td>" . $rows["form_id"] . "</td>";
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

                        echo "<td><button class='button-training-request' type='submit'" . " value= " . $rows['form_id'] . ">Manage</button></td>";
                        echo "</tr>";
                    }
                }
                echo "</table>";
            }
        ?>

    </section>


    <section id="training-itinerary-management-section" class="content">
        <?php
            $sql = "SELECT ti.training_itinerary_id, us.username, ti.status, f.form_id, ti.date, ti.time FROM itinerary_management im 
                    INNER JOIN training_itinerary ti ON im.training_itinerary_id = ti.training_itinerary_id
                    INNER JOIN request_form f ON im.user_id = f.user_id
                    INNER JOIN user_information us ON us.id = im.user_id";

            $result = $conn->query($sql);

            if (mysqli_num_rows($result) > 0) {
                $headers = array("Form ID", "User Name", "Training Start Date", "Training Start Time" ,"Itinerary Status");
                
                echo "<table class='management-table'> <tr>";

                for ($i = 0; $i < sizeof($headers); $i++) {
                    echo "<th>" . $headers[$i] . "</th>";
                }

                echo "</tr>";

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                        
                    echo "<td>" . $row["form_id"] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['time'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                    echo "<td><button class='button-training-itinerary' type='submit'" . " value= " . $row['training_itinerary_id'] . ">Manage</button></td>";

                    echo "</tr>";
                }
                echo "</table>";
            }   
        ?>
    </section>
    <script src="scripts/requestHandlerSystem.js"></script>

    <script>
        $(document).ready(function() {
            var defaultOpenSection = $("#openByDefault").attr("value");

            $(".content").css("display", "none");

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
        });
    </script>
</body>
</html>
