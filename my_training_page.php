<!--Add this to your code to start the session-->
<?php include('session_control.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Bryan Austyn Ichsan">
    <title>My Training</title>
    <link rel="stylesheet" href="styles/my_training.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--Use link below to display icons on the navbar-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--End of it-->
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
                  <a href="#" id="editProfileBtn">Edit Profile</a>
                  <a href="logout_session.php?logout">Log Out</a>
                </div>
              </div> 
        </div>  
    </div>
    <!---->

    <!-- In Pages Module Tab -->
    <div id="module-tab">
        <button class="link" id="openByDefault" value="pending-section">Pending/In Progress Training</button>
        <button class="link" value="confirmed-section">Confirmed Training</button>
    </div>
    
    <!-- Pending or In Progress Section -->
    <!-- All of the images are taken from Unsplash website -->
    <div id="pending-section" class="content">
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "etmp";

            $conn = mysqli_connect($servername, $username, $password, $dbname);

            if ($conn->connect_errno) {
                die("Connection failed: " . $conn->connect_error);
            }

            $training_id = array();
            
            $user_id;
            $form_id;
            $user_name = $_SESSION["username"];
            $empty;

            // Getting the user_id based on the current user session
            $sql = "SELECT * FROM user_information WHERE username='$user_name'";

            $result = $conn->query($sql);

            while ($row = mysqli_fetch_assoc($result)) {
                $user_id = $row["id"];
            }

            // Getting the form id for this particular user
            $sql = "SELECT * FROM request_form WHERE user_id='$user_id' AND request_status='In Progress'";
            $result = $conn->query($sql);

            if (!(mysqli_num_rows($result) == 0)) {
                $empty = false;
                while ($row = mysqli_fetch_assoc($result)) {
                    $form_id = $row["form_id"];
                }
    
                // Getting the training workshops that have been sent for this client user
                $sql = "SELECT * FROM unconfirmed_training_workshop WHERE form_id='$form_id' AND training_status='unconfirmed'";
                $result = $conn->query($sql);
    
                while ($row = mysqli_fetch_assoc($result)) {
                    array_push($training_id, $row["training_id"]);
                }

                foreach ($training_id as $id) {
                    $sql = "SELECT * FROM training_workshop WHERE training_id='$id'";
                    $result = $conn->query($sql);
    
                    while ($row = mysqli_fetch_assoc($result)) {
                        $type_id = $row["training_type_id"];
                        $sql2 = "SELECT * FROM training_type WHERE training_type_id='$type_id'";
                        $result2 = $conn->query($sql2);
    
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                            echo "<div class='training-workshop-content'>";
                            echo "<img src='" . $row["training_image_link"] . "'/>";
                            echo "<div>";
                            echo "<h3>" . $row["training_name"] . "</h3>";
                            echo "<p>" . $row2["training_type_name"] . "</p>";
                            echo "<p>Duration: " . $row["training_duration"] . "</p>";
                            echo "<p>Price: MYR " . $row["training_price"] . "</p>";
                            echo "<p>" . $row["training_details"] . "</p>";
                            echo "</div>";
                            echo "</div>";        
                        }
                    }
                }
            }
            else {
                $empty = true;
            }

            $conn->close();
        ?>
        
        <div id="user-interaction">
            <button class="cancel-request-button">Cancel request</button>
            <button class="request-alternatives-button">Request for more alternatives</button>
        </div>

        <!-- Cancel request as operator Modal Box -->
        <div class="cancel-modal">
            <div class="modal-content">
                <span class="cancel-close-button">×</span>
                <h2>Are you sure canceling this request?</h2>
                <div class="custom-select">
                    <h4>Reason of cancellation</h4>
                    <select>
                        <option value="" disabled selected>Reason:</option>
                        <option value="not interested">Not interested anymore</option>
                        <option value="full">Financial issue</option>
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
                <h4>The request has been canceled</h4>
            </div>
        </div>


        <!-- Request for training alternatives Modal Box -->
        <div class="request-modal">
            <div class="modal-content">
                <span class="request-close-button">×</span>
                <h2>Request for more training alternatives</h2>
                <div class="custom-select">
                    <h4>Training types</h4>
                    <select>
                        <option value="Leadership & Communication skills" selected>Leadership &#38; Communication Skills</option>
                        <option value="Negotiation skills">Negotiation Skills</option>
                        <option value="Presentation skills">Presentation Skills</option>
                    </select>
                </div>
                <button class="request-modal-confirm-button">Send request</button>
            </div>
        </div>

        <div class="request-confirmed-modal">
            <div class="modal-content">
                <span class="request-confirmed-close-button">×</span>
                <h4>The request for training alternatives have been successfully sent</h4>
            </div>
        </div>
    </div>

    

    
    <!-- Confirmed Section -->
    <div id="confirmed-section" class="content">
        <div class="training-workshop-content">
            <img src="images/leadership.jfif" alt="leadership">
            <div>
                <h3>First by default</h3>
                <p>Leadership & Communication</p>
                <p>Duration: 1 day</p>
                <p>Price: MYR 350</p>
                <p>The aim of this workshop on the art of listening is to learn what the speaker has to say about a subject. Employees benefit about each other as they pay attention to each other. A workplace where workers are continually learning from one another will benefit from a free flow of ideas that are genuinely listened to.</p>
            </div>
        </div>

        <div class="training-workshop-content">
            <img src="images/leadership.jfif" alt="leadership">
            <div>
                <h3>First by default</h3>
                <p>Leadership & Communication</p>
                <p>Duration: 1 day</p>
                <p>Price: MYR 350</p>
                <p>The aim of this workshop on the art of listening is to learn what the speaker has to say about a subject. Employees benefit about each other as they pay attention to each other. A workplace where workers are continually learning from one another will benefit from a free flow of ideas that are genuinely listened to.</p>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            var defaultOpenSection = $("#openByDefault").attr("value");
            var empty = "<?php echo $empty; ?>";

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

            $(".training-workshop-content").hover(function() {
                $(this).find("img").css("filter", "brightness(50%)");
                $(this).css("cursor", "pointer");
            }, function() {
                $(this).find("img").css("filter", "none");
                $(this).css("cursor", "auto");
            });
            
            if (!empty) {
                var cancelModal = $(".cancel-modal");
                var cancelConfirmationModal = $(".cancel-confirmed-modal");

                var requestModal = $(".request-modal");
                var requestConfirmationModal = $(".request-confirmed-modal");

                var user_name = "<?php echo $user_name?>";

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
                    $(".cancel-request-button").on("click", function() {
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

                        if (value = "others") {
                            otherReason = $("textarea").val();
                        }
            
                        predefinedReason = option.text();
                        
                        if (option.val() == "others") {
                            $.post("cancel_requests_as_client.php", {user_name: user_name, cancel_reason: otherReason});
                        }
                        else {
                            $.post("cancel_requests_as_client.php", {user_name: user_name, cancel_reason: predefinedReason});
                        }
                        
                        cancelModal.toggleClass("show-modal");
                        cancelConfirmationModal.toggleClass("show-modal");
                        //document.location = "admin_homepage.php";
                    });

                    $(".cancel-confirmed-close-button").on("click", function() {
                        cancelConfirmationModal.toggleClass("show-modal");
                    });
                });

                $(function() {
                    $(".request-alternatives-button").on("click", function() {
                        requestModal.toggleClass("show-modal");
                    });

                    $(".request-close-button").on("click", function() {
                        requestModal.toggleClass("show-modal");
                    });

                    $(".request-modal-confirm-button").on("click", function() {
                        var option = $(".request-modal select").children("option:selected");
                        var value = option.val();
                        var chosenTrainingType = "";
            
                        chosenTrainingType = option.text();
            
                        $.post("request_for_training_alternatives.php", {user_name: user_name, chosen_training_type: chosenTrainingType});
                        
                        requestModal.toggleClass("show-modal");
                        requestConfirmationModal.toggleClass("show-modal");
                    });

                    $(".request-confirmed-close-button").on("click", function() {
                        requestConfirmationModal.toggleClass("show-modal");
                    });
                });

            }
        });
    </script>
</body>
</html>