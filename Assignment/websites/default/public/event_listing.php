<?php ob_start(); ?>
<?php
// Start session and handle user session logic
require_once __DIR__ . '/Includes/session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Browse Events | Chronos Revel</title>
    <link rel="stylesheet" href="vje.css" />
</head>

<body>
    <?php
    // Include public site header
    include './Includes/header_public.php';
    ?>

    <main>
        <h2 class="section_title">Browse Events</h2>

        <!-- Hidden input to hold filter type passed via URL -->
        <input type="hidden" id="filter_type" value="<?= $_GET['filter'] ?? '' ?>">

        <!-- Category filter dropdown -->
        <div class="filter_bar" style="margin-bottom: 20px;">
            <select id="event_filter">
                <option value="">All Categories</option>
                <option value="Music">Music</option>
                <option value="Technology">Technology</option>
                <option value="Culture">Culture</option>
                <option value="Business">Business</option>
                <option value="Festival">Festival</option>
                <option value="Comedy">Comedy</option>
                <option value="Sports">Sports</option>
            </select>
        </div>

        <!-- Event listings will be loaded here dynamically -->
        <div id="event_grid" class="event_grid">
            <p>Loading events...</p>
        </div>

        <!-- Pagination controls container -->
        <div id="pagination_controls" style="text-align: center; margin-top: 20px;"></div>
    </main>

    <?php
    // Include public site footer
    include './Includes/footer.php';
    ?>

    <!-- JS to handle dynamic event fetching and filtering -->
    <script src="js/event_search.js"></script>
</body>

</html>
<?php ob_end_flush(); ?>