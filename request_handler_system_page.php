<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>
    <section>
        <h1>Request Handler System</h1>

        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "etmp";

            $conn = mysqli_connect($servername, $username, $password, $dbname);

            if ($conn->connect_errno) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT fname, lname, selected_training_type, request_status, request_date FROM request_form";
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

                    while ($rows = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        foreach ($rows as $data) {
                            echo "<td>" . $data . "</td>";
                        }
                        echo "<td><button class='button-training-request'>Manage</button></td>";
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
</body>
</html>