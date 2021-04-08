<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "etmp";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if ($conn->connect_errno) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    if (isset($_POST['value']) && strlen($_POST['value'])) {
        $search_value = $_POST['value'];
        $sql_3 = "SELECT tw.training_name, tw.training_price, tt.training_type_name FROM training_workshop tw INNER JOIN training_type tt ON tt.training_type_id = tw.training_type_id 
                    WHERE '$search_value' = tt.training_type_name OR '$search_value' = tw.training_name"; 
        $result_3 = $conn->query($sql_3);

        echo "<tr>";
        echo "<th>Training Name</th>";
        echo "<th>Training Type</th>";
        echo "<th>Price</th>";
        echo "<th></th>";
        echo "</tr>";

        if ($result_3) {
            if (mysqli_num_rows($result_3) == 0) {
                echo "<tr>";
                echo "<td colspan=3> Not Found </td>";
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
        }
        else {
            echo "No Result";
        }
    }
    else  {
        $sql_3 = "SELECT tw.training_name, tw.training_price, tt.training_type_name  FROM training_workshop tw
                            INNER JOIN training_type tt ON tt.training_type_id = tw.training_type_id";
        $result_3 = $conn->query($sql_3);

        echo "<tr>";
        echo "<th>Training Name</th>";
        echo "<th>Training Type</th>";
        echo "<th>Price</th>";
        echo "<th></th>";
        echo "</tr>";

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
    }
    

?>