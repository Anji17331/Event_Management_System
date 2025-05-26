<?php ob_start(); ?>
<?php
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
    <?php include './Includes/header_public.php'; ?>
    <main>
        <h2 class="section_title">Browse Events</h2>
        <input type="hidden" id="filter_type" value="<?= $_GET['filter'] ?? '' ?>">
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

        <div id="event_grid" class="event_grid">
            <p>Loading events...</p>
        </div>

        <div id="pagination_controls" style="text-align: center; margin-top: 20px;"></div>
    </main>
    <?php include './Includes/footer.php'; ?>
    <script src="js/event_search.js"></script>
</body>

</html>
<?php ob_end_flush(); ?>