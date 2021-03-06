<!--Add this to your code to start the session-->
<?php include('session_control.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Bryan Austyn Ichsan">
    <title>Request Page</title>
    <link rel="stylesheet" href="styles/request_handler_system.css">
    <!--Use link below to display icons on the navbar-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!--End of it-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>
    <!--Use the title & navbar bar for all admin pages-->
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

    <div class="request-detail-section">
        <h1>Request Details</h1>
        <p class="container-cancel-button">
            <button class="cancel-button">Cancel Request</button>
        </p>
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "etmp";

            $conn = mysqli_connect($servername, $username, $password, $dbname);

            if ($conn->connect_errno) {
                die("Connection failed: " . $conn->connect_error);
            }

            $user;

            $training_type;

            if (isset($_COOKIE["request_id"])) {
                $request_id = $_COOKIE["request_id"];

                $sql = "SELECT * FROM request_form WHERE form_id = $request_id";
                $result = $conn->query($sql);

                while($row = mysqli_fetch_assoc($result)) {
                    $user = $row["user_id"];

                    echo "<h5>" . "First Name" . "</h5>";
                    echo "<p>"  . $row["fname"] . "</p>";
                    echo "<hr>";

                    echo "<h5>" . "Last Name" . "</h5>";
                    echo "<p>"  . $row["lname"] . "</p>";
                    echo "<hr>";

                    echo "<h5>" . "Contact Number" . "</h5>";
                    echo "<p>"  . $row["phone"] . "</p>";
                    echo "<hr>";

                    echo "<h5>" . "Address" . "</h5>";
                    echo "<p>"  . $row["address"] . "</p>";
                    echo "<hr>";

                    echo "<h5>" . "City" . "</h5>";
                    echo "<p>"  . $row["city"] . "</p>";
                    echo "<hr>";

                    echo "<h5>" . "State" . "</h5>";
                    echo "<p>"  . $row["state"] . "</p>";
                    echo "<hr>";

                    echo "<h5>" . "Chosen Venue" . "</h5>";
                    echo "<p>" . $row["training_venue"] . "</p>";
                    echo "<hr>";

                    echo "<h5>" . "Chosen Date" . "</h5>";
                    echo "<p>" . $row["training_date"] . "</h5>";
                    echo "<hr>";

                    echo "<h5>" . "Chosen Time" . "</h5>";
                    echo "<p>" . $row["training_time"] . "</h5>";
                    echo "<hr>";

                    echo "<h5>" . "Training Type" . "</h5>";

                    $data_int = (int)$row['training_type_id'];

                    $sql_2 = "SELECT * FROM training_type WHERE training_type_id = $data_int";
                    $result2 = $conn->query($sql_2);

                    while ($row = mysqli_fetch_assoc($result2)) {
                        $training_type = $row['training_type_name'];
                        echo "<p>" . $training_type . "</p>";
                    }
                    echo "<hr>";
                }
            }
        ?>
    </div>

    <div class="search-training-section">
        <h1>Search Trainings</h1>
        <form id="search-form" method="post">
            <label class="label-training-type" for="search">Training Type</label>
            <input id="search" class="training-search-bar" type="text" placeholder="Search..." name="search"/>
            <button class='search-button' type="submit"><i class="fa fa-search"></i></button>
        </form>

        <table class="search-training-table">
            <tr>
                <th>Training Name</th>
                <th>Training Type</th>
                <th>Price</th>
                <th></th>

            </tr>

            <?php
                $request_id = $_COOKIE["request_id"];
                $sql_3 = "SELECT tw.training_name, tw.training_price, tt.training_type_name FROM training_workshop tw
                INNER JOIN training_type tt ON tt.training_type_id = tw.training_type_id
                WHERE tw.training_id NOT IN (SELECT training_id FROM unconfirmed_training_workshop WHERE form_id = '$request_id')";

                $result_3 = $conn->query($sql_3);

                if (mysqli_num_rows($result_3) == 0) {
                    echo "<tr>";
                    echo "<td colspan=3> No Training </td>";
                    echo "</tr>";
                }
                else {
                while ($row = mysqli_fetch_assoc($result_3)) {
                    echo "<tr>";
                    echo "<td>" . $row["training_name"] . "</td>";
                    echo "<td>" . $row["training_type_name"] . "</td>";
                    echo "<td>" . "RM " . $row["training_price"] . "</td>";
                    echo "<td class='checkbox-row'><input type='checkbox' name='training' value='" . $row["training_name"] . "," .  $row["training_type_name"] . "'/>" . "</td>";

                    echo "</tr>";
                    }
                }
            ?>
        </table>

        <p class="container-send-training-button">
            <button class="send-training-button">Send Training</button>
        </p>
    </div>

    <!-- Sending Training to client Modal Box -->
    <div class="send-modal">
        <div class="modal-content">
            <span class="send-close-button">??</span>
            <h3></h3>
        </div>
    </div>


    <!-- Cancel request as operator Modal Box -->
    <div class="cancel-modal">
        <div class="modal-content">
            <span class="cancel-close-button">??</span>
            <h2>Are you sure cancel this request?</h2>
            <div class="custom-select">
                <h4>Reason of cancellation</h4>
                <select>
                    <option value="" disabled selected>Reason:</option>
                    <option value="no response">No response for a week</option>
                    <option value="full">The training workshop is full</option>
                    <option value="others">Others</option>
                </select>
            </div>
            <div id="other-reason-section">
                <h4>What is the other reason</h4>
                <textarea name="other-reason" cols="30" rows="10"></textarea>
            </div>
            <button class="confirm-button-disabled" disabled>Cancel request</button>
        </div>
    </div>

    <script type="text/javascript">
        var user_id = "<?php echo $user?>"
        var training_type = "<?php echo $training_type?>";

        var sendModal = $(".send-modal");
        var cancelModal = $(".cancel-modal");

        $(document).ready(function() {
            $("#search-form").bind('submit',function() {
                var value = $('#search').val();
                $.post('search_training.php',{value:value}, function(data){
                    $(".search-training-table").html(data);
                });
                return false;
            });

            $("select").on("change", function(e) {
                var selectedOption = $(this).find("option:selected");
                var selectedValue  = selectedOption.val();
                var otherSection = $("#other-reason-section");
                var submitButton = $(".confirm-button-disabled");
                
                submitButton.prop("disabled", !selectedValue);

                if (selectedValue) {
                    submitButton.removeClass("confirm-button-disabled");
                    submitButton.addClass("confirm-button");
                }
                
                if (selectedValue == "others") {
                    otherSection.css("display", "block");
                }
                else {
                    otherSection.css("display", "none");
                }

            });

            $(function() {
                $('.send-training-button').on("click", function() {
                    var checkboxValues = [];
                    var training_types = [];

                    $("input[type='checkbox']:checked").each(function(index, elem){
                        var temp = $(elem).val().split(",");
                        console.log(temp[0]);
                        console.log(temp[1]);

                        checkboxValues.push(temp[0]);
                        training_types.push(temp[1]);
                    });

                    $.post("send_training_to_client.php", {training_name: checkboxValues, user: user_id, training_type: training_types}, function(data) {
                        if (data) {
                            $(".send-modal h3").html(data);
                            sendModal.toggleClass("show-modal");
                        }
                    });
                });

                $(".send-close-button").on("click", function() {
                    sendModal.toggleClass("show-modal");
                    document.location = "admin_homepage.php";
                });
            });

            $(function() {
                var type = "<?php echo $training_type ?>"

                $(".cancel-button").on("click", function() {
                    cancelModal.toggleClass("show-modal");
                });

                $(".cancel-close-button").on("click", function() {
                    cancelModal.toggleClass("show-modal");
                });
                
                $(".confirm-button-disabled").on("click", function() {
                    var option = $("select").children("option:selected");
                    var value = option.val();
                    var predefinedReason = "";
                    var otherReason = "";

                    if (value = "others") {
                        otherReason = $("textarea").val();
                    }
           
                    predefinedReason = option.text();
                    
                    if (option.val() == "others") {
                        $.post("cancel_requests_as_operator.php", {training_type: type, user: user_id, cancel_reason: otherReason});
                    }
                    else {
                        $.post("cancel_requests_as_operator.php", {training_type: type, user: user_id, cancel_reason: predefinedReason});
                    }
                    
                    cancelModal.toggleClass("show-modal");
                    document.location = "admin_homepage.php";
                });
            });
            
        })

    </script>
</body>
</html>
