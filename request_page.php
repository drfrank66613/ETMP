<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Page</title>
    <link rel="stylesheet" href="styles/request_handler_system.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
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

            if (isset($_COOKIE["request_id"])) {
                $request_id = $_COOKIE["request_id"];

                $sql = "SELECT * FROM request_form WHERE form_id = $request_id";
                $result = $conn->query($sql);

                while($row = mysqli_fetch_assoc($result)) {
                    echo "<h5>" . "First Name" . "</h5>";
                    echo "<p>"  . $row["fname"] . "</p>";
                    echo "<hr>";

                    echo "<h5>" . "Last Name" . "</h5>";
                    echo "<p>"  . $row["lname"] . "</p>";
                    echo "<hr>";

                    echo "<h5>" . "Phone" . "</h5>";
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

                    echo "<h5>" . "Training Type" . "</h5>";
            
                    $data_int = (int)$row['training_type_id'];
                            
                    $sql_2 = "SELECT * FROM training_type WHERE training_type_id = $data_int";
                    $result2 = $conn->query($sql_2);
                    
                    while ($row = mysqli_fetch_assoc($result2)) {
                        echo "<p>" . $row['training_type_name'] . "</p>";
                    }
                    
                    echo "<hr>";
                }
            }
        ?>
    </div>
        
    <div class="search-training-section">
        <h1>Search Trainings</h1>
        <form method="post">
            <label class="label-training-type" for="search">Training Type</label>
            <input class="training-search-bar" type="text" placeholder="Search..." name="search"/>
            <button class='search-button' type="submit"><i class="fa fa-search"></i></button>   
        </form>

        <table class="search-training-table">
            <tr>
                <th>Training Name</th>
                <th>Training Type</th>
                <th>Price</th>
            </tr>

        </table>

        <p class="container-send-training-button">
            <button class="send-training-button">Send Training</button>
        </p>
    </div>
    
    

    <script>
        var p = document.getElementById("test");
    </script>
</body>
</html>