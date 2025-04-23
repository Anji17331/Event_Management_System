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


    <main>
        <h2 class="section_title">Current Events</h2>

        <div class="event_grid">

            <!-- Event_Card_1 -->
            <div class="event_card">
                <div class="event_image">
                    <img src="Wallpapers/5825849.jpg" alt="Event 1">
                </div>
                <div class="event_details">
                    <h3 class="event_title">Arjit singh live in Mumbai</h3>
                    <p class="event_description">Experience India's most beloved voice live</p>
                    <div class="event_meta">
                        <div class="event_location">
                            <i></i> Mumbai
                        </div>
                        <div class="event_date">
                            <i></i>Date
                        </div>
                    </div>
                    <!--  <button class="buy_button">Buy now</button> --> 
                </div>
            </div>

            <!-- Event_Card_2 -->
            <div class="event_card">
                <div class="event_image">
                    <img src="Wallpapers/5825849.jpg" alt="Event 3">
                </div>
                <div class="event_details">
                    <h3 class="event_title">Karthik musical concert live in chennai</h3>
                    <p class="event_description">Experience India's most beloved voice live</p>
                    <div class="event_meta">
                        <div class="event_location">
                            <i></i> chennai
                        </div>
                        <div class="event_date">
                            <i></i>Date
                        </div>
                    </div>
                    <!-- <button class="buy_button">Buy now</button> -->
                </div>
            </div>

            <!-- Event_Card_3 -->
            <div class="event_card">
                <div class="event_image">
                    <img src="Wallpapers/5825849.jpg" alt="Event 3">
                </div>
                <div class="event_details">
                    <h3 class="event_title">SS Thaman's live in Hyderabad</h3>
                    <p class="event_description">Experience India's most beloved voice live</p>
                    <div class="event_meta">
                        <div class="event_location">
                            <i></i> Hyderabad
                        </div>
                        <div class="event_date">
                            <i></i>Date
                        </div>
                    </div>
                    <!-- <button class="buy_button">Buy now</button> -->
                </div>
            </div>
            <!-- Event_Card_4 -->
            <div class="event_card">
                <div class="event_image">
                    <img src="Wallpapers/5825849.jpg" alt="Event 4">
                </div>
                <div class="event_details">
                    <h3 class="event_title">Arjit singh live in Mumbai</h3>
                    <p class="event_description">Experience India's most beloved voice live</p>
                    <div class="event_meta">
                        <div class="event_location">
                            <i></i> Mumbai
                        </div>
                        <div class="event_date">
                            <i></i>Date
                        </div>
                    </div>
                    <!-- <button class="buy_button">Buy now</button> -->
                </div>
            </div>
            <!-- Event_Card_5 -->
            <div class="event_card">
                <div class="event_image">
                    <img src="Wallpapers/5825849.jpg" alt="Event 5">
                </div>
                <div class="event_details">
                    <h3 class="event_title">Arjit singh live in Mumbai</h3>
                    <p class="event_description">Experience India's most beloved voice live</p>
                    <div class="event_meta">
                        <div class="event_location">
                            <i></i> Mumbai
                        </div>
                        <div class="event_date">
                            <i></i>Date
                        </div>
                    </div>
                    <!-- <button class="buy_button">Buy now</button> -->
                </div>
            </div>
            <!-- Event_Card_6 -->
            <div class="event_card">
                <div class="event_image">
                    <img src="Wallpapers/5825849.jpg" alt="Event 6">
                </div>
                <div class="event_details">
                    <h3 class="event_title">Arjit singh live in Mumbai</h3>
                    <p class="event_description">Experience India's most beloved voice live</p>
                    <div class="event_meta">
                        <div class="event_location">
                            <i></i> Mumbai
                        </div>
                        <div class="event_date">
                            <i></i>Date
                        </div>
                    </div>
                    <!-- <button class="buy_button">Buy now</button> -->
                </div>
            </div>
        </div>
    </main>

    <?php
    include '../includes/footer.php';
    ?>
</body>

</html>