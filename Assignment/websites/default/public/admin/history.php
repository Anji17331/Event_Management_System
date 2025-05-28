<?php
// Ensure user is logged in as admin
require_once __DIR__ . '/../Includes/session.php';
requireAdmin();

// Connect to the database
require_once __DIR__ . '/../Includes/config.php';

// Fetch past events (before today), newest first
$stmt = $pdo->prepare("SELECT * FROM events WHERE event_date < CURDATE() ORDER BY event_date DESC");
$stmt->execute();
$pastEvents = $stmt->fetchAll();
?>

<?php include __DIR__ . '/../Includes/header_admin.php'; ?>
<title>Admin | History</title>

<main>
    <h1 class="section_title">Past Events</h1>

    <!-- Show message if no past events -->
    <?php if (empty($pastEvents)): ?>
        <p>No past events found.</p>
    <?php else: ?>
        <!-- Past events table -->
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Location</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pastEvents as $event): ?>
                    <tr>
                        <td><?= htmlspecialchars($event['title']) ?></td>
                        <td><?= date('d-m-Y', strtotime($event['event_date'])) ?></td>
                        <td><?= htmlspecialchars($event['location']) ?></td>
                        <td><?= htmlspecialchars($event['category']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</main>

<?php include __DIR__ . '/../Includes/footer.php'; ?>