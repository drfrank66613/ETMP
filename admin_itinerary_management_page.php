<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Itinerary Management</title>
    <link rel="stylesheet" href="styles/admin_itinerary_management_page.css">
</head>
<body>
    <!-- Fill with George's itinerary -->
    <?php
        $temp = $_COOKIE["itinerary_id"];
    ?>

    <div class="modification-respond-section">
        <button class="accept-modification-button">Accept Modification</button>
        <button class="reject-modification-button">Reject Modification</button>
    </div>
</body>
</html>