<?php
// Start output buffering to manage header and output ordering
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Define character set and ensure responsive scaling on different devices -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Page title shown in browser tab -->
  <title>Events | Chronos Revel</title>

  <!-- Link to the main stylesheet for page styling -->
  <link rel="stylesheet" href="vje.css" />
</head>

<!--
  Include the PHP file responsible for querying and outputting
  the list of events in HTML format. Keeping logic separate
  from the template helps maintain cleaner code.
  -->

<?php include 'event_listing.php'; ?>

<!-- Load JavaScript for live search/filter functionality -->
<script src="js/event_search.js"></script>


</html>

<?php
// Flush the output buffer and send the final page to the browser
ob_end_flush();
?>