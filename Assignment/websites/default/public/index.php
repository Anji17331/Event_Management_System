<?php
    // 1) Pull in our secure session helpers…
    require_once(__DIR__ . '/../Includes/session.php');


    // // 2) …and force login if needed
    //      requireAuth();

    // 3) Then bring in the header (which itself includes session.php)
    require_once __DIR__ . '/../Includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/vje.css">
</head>

<body>


    <?php include 'event_listing.php'; ?>

    <?php
    include '../includes/footer.php';
    ?>
</body>

</html>