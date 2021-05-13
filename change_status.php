<?php

$current_section = $_POST["current_section"];

if ($current_section == "pending-section") {
    $_SESSION['status'] = "unconfirmed";
}
else {
    $_SESSION['status'] = "confirmed";
}

echo $_SESSION['status'];

?>