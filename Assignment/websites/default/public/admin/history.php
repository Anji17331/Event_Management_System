<?php
require_once __DIR__ . '/../Includes/session.php';
requireAdmin();
require_once __DIR__ . '/../Includes/config.php';

$stmt = $pdo->prepare("SELECT * FROM events WHERE event_date < CURDATE() ORDER BY event_date DESC");
$stmt->execute();
$pastEvents = $stmt->fetchAll();
?>

<?php include __DIR__ . '/../Includes/header_admin.php'; ?>
<title>Admin | History</title>
<main>
    <h1 class="section_title">Past Events</h1>

    <?php if (empty($pastEvents)): ?>
        <p>No past events found.</p>
    <?php else: ?>
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