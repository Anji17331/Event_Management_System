<?php ob_start(); ?>
<?php
require_once __DIR__ . '/../Includes/session.php';

if (isLoggedIn() && $_SESSION['is_admin'] === true) {
    header('Location: admin/dashboard.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Events | Chronos Revel</title>
    <link rel="stylesheet" href="vje.css" />
</head>

<body>
    <?php include '../Includes/header.php'; ?>

    <main>
        <h2 class="section_title">Current Events</h2>
        <div id="event_grid" class="event_grid">
            <!-- Events will be injected here by JavaScript -->
            <p>Loading events...</p>
        </div>
    </main>

    <?php include '../Includes/footer.php'; ?>

    <script>
        fetch('api/get_events.php')
            .then(res => res.json())
            .then(response => {
                const container = document.getElementById('event_grid');
                if (response.status !== 'success') {
                    container.innerHTML = `<p>Error loading events.</p>`;
                    return;
                }

                const events = response.data;
                if (!events.length) {
                    container.innerHTML = `<p>No events available.</p>`;
                    return;
                }

                container.innerHTML = events.map(ev => `
      <div class="event_card">
        ${ev.image_path ? `
          <div class="event_image">
            <img src="${ev.image_path}" alt="${ev.title}">
          </div>` : ''
        }

        <div class="event_details">
          <h3 class="event_title">${ev.title}</h3>
          <p class="event_description">${ev.description.substring(0, 100)}...</p>
          <div class="event_meta">
            <div class="event_location">
              <i></i> ${ev.location}
            </div>
            <div class="event_date">
              <i></i> ${ev.event_date}
            </div>
          </div>
          <button class="register_button">Register</button>
        </div>
      </div>
    `).join('');
            })
            .catch(err => {
                document.getElementById('event_grid').innerHTML = `<p>Failed to load events.</p>`;
                console.error(err);
            });
    </script>

</body>

</html>

<?php ob_end_flush(); ?>