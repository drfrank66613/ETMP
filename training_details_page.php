<!--Add this to your code to start the session-->
<?php include('session_control.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Training Details</title>
    <link rel="stylesheet" href="styles/training_details_page.css">
    <!--Use link below to display icons on the navbar-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!--End of it-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body>
    <!--Use the title & navbar bar for all client pages-->
    <div class="title">
        <img src="images/etmp_logo.png" alt="logo" style="margin-top: 1rem;">
        <h4 class="appdesc">ONE OF THE LARGEST TRAINING PROVIDER IN SARAWAK</h4>
    </div>
    <div class="navbar">
        <a href="client_homepage.php">Home</a>
        <a class="active" href="my_training_page.php">My Training</a>
        <a href="client_about_page.php">About</a>
        <div class="rightnavbar">
            <a href="calendar_page.php"><i class="fa fa-calendar"></i></a>
            <a href="notification.php"><i class="fa fa-bell"></i></a>
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

    <!-- Section for showing the Training Workshop details -->
    <div class="training-section">
        <div class="training-details-section">
            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "etmp";

                $conn = mysqli_connect($servername, $username, $password, $dbname);

                if ($conn->connect_errno) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $chosen_training = $_COOKIE["training_name"];
                $status = $_COOKIE["training_status"];

                $user_name = $_SESSION["username"];
                $description;
                
                $sql = "SELECT * FROM training_workshop WHERE training_name = '$chosen_training'";
                $result = $conn->query($sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    $type_id = $row["training_type_id"];
                    $sql2 = "SELECT * FROM training_type WHERE training_type_id='$type_id'";
                    $result2 = $conn->query($sql2);

                    while ($row2 = mysqli_fetch_assoc($result2)) {
                        if ($status == "unconfirmed") {
                            echo "<img src='" . $row["training_image_link"] . "'/>";
                            echo "<div class='training-text-section'>";
                            echo "<h2>" . $row["training_name"] . "</h2>";
                            echo "<h3>" . $row2["training_type_name"] . "</h3>";
                            echo "<p><i class='fa fa-money'> : MYR " . $row["training_price"] . "</i></p>";
                            echo "<p><i class='fa fa-clock'> : " . $row["training_duration"] . "</i></p>";
                            echo "<button class='confirmed-button-section'>Confirm & Pay</button>";
                            echo "</div>";
                        }
                        else {
                            echo "<img src='" . $row["training_image_link"] . "'/>";
                            echo "<div class='training-text-section'>";
                            echo "<h2>" . $row["training_name"] . "</h2>";
                            echo "<h3>" . $row2["training_type_name"] . "</h3>";
                            echo "<p><i class='custom-money fa fa-money'> : MYR " . $row["training_price"] . "</i></p>";
                            echo "<p><i class='custom-clock fa fa-clock'> : " . $row["training_duration"] . "</i></p>";
                            echo "<button class='cancel-button'>Cancel Training</button>";
                            echo "</div>";
                        }


                        $description = $row["training_details"];
                    }
                }
            ?>
            
        </div>
        <h3>Description</h3>
        <hr/>
        <p><?php echo $description; ?></p>


        <!-- Cancel request as operator Modal Box -->
        <div class="cancel-modal">
            <div class="modal-content">
                <span class="cancel-close-button">×</span>
                <h2>Cancel Training</h2>
                <p>There will be no refund after canceling. Confirm to cancel this training?</p>
                <div class="custom-select">
                    <h4>Reason of cancellation</h4>
                    <select>
                        <option value="" disabled selected>Reason:</option>
                        <option value="financial reason">Financial reason</option>
                        <option value="full schedule">The training itinerary cannot be fit inside the schedule</option>
                        <option value="others">Others</option>
                    </select>
                </div>
                <div id="other-reason-section">
                    <h4>What is the other reason</h4>
                    <textarea name="other-reason" cols="30" rows="10"></textarea>
                </div>
                <button class="cancel-modal-confirm-button-disabled" disabled>Cancel request</button>
            </div>
        </div>

        <div class="cancel-confirmed-modal">
            <div class="modal-content">
                <span class="cancel-confirmed-close-button">×</span>
                <h4>The training has been canceled</h4>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                var cancelModal = $(".cancel-modal");
                var cancelConfirmationModal = $(".cancel-confirmed-modal");


                $(".confirmed-button-section").on("click", function() {
                    /***
                     * Right here Irwan, put in the link to your payment page
                     */
                    //document.location = "your_payment_page.php";
                });

                $(".cancel-modal select").on("change", function(e) {
                    var selectedOption = $(this).find("option:selected");
                    var selectedValue  = selectedOption.val();
                    var otherSection = $("#other-reason-section");
                    var submitButton = $(".cancel-modal-confirm-button-disabled");
                    
                    submitButton.prop("disabled", !selectedValue);

                    if (selectedValue) {
                        submitButton.removeClass("cancel-modal-confirm-button-disabled");
                        submitButton.addClass("cancel-modal-confirm-button");
                    }
                    
                    if (selectedValue == "others") {
                        otherSection.css("display", "block");
                    }
                    else {
                        otherSection.css("display", "none");
                    }
                });


                $(function() {
                    $(".cancel-button").on("click", function() {
                        cancelModal.toggleClass("show-modal");
                    });

                    $(".cancel-close-button").on("click", function() {
                        cancelModal.toggleClass("show-modal");
                    });

                    $(".cancel-modal-confirm-button-disabled").on("click", function() {
                        var option = $(".cancel-modal select").children("option:selected");
                        var value = option.val();
                        var predefinedReason = "";
                        var otherReason = "";

                        var userName = "<?php echo $user_name; ?>";
                        var trainingName = "<?php echo $chosen_training; ?>";

                        if (value = "others") {
                            otherReason = $("textarea").val();
                        }
            
                        predefinedReason = option.text();
                        
                        if (option.val() == "others") {
                            $.post("cancel_registered_training.php", {user_name: userName, cancel_reason: otherReason, training_name: trainingName});
                        }
                        else {
                            $.post("cancel_registered_training.php", {user_name: userName, cancel_reason: predefinedReason, training_name: trainingName});
                        }
                        
                        cancelModal.toggleClass("show-modal");
                        cancelConfirmationModal.toggleClass("show-modal");
                        //document.location = "admin_homepage.php";
                    });

                    $(".cancel-confirmed-close-button").on("click", function() {
                        cancelConfirmationModal.toggleClass("show-modal");
                    });
                });
            });
        </script>
    </div>
</body>
</html>