<?php
// Only allow access if logged in as admin
require_once __DIR__ . '/../Includes/session.php';
requireAdmin();

// Connect to the database
require_once __DIR__ . '/../Includes/config.php';

// Fetch all upcoming events, ordered by date
$stmt = $pdo->prepare("SELECT * FROM events WHERE event_date >= CURDATE() ORDER BY event_date ASC");
$stmt->execute();
$events = $stmt->fetchAll();
?>

<?php include __DIR__ . '/../Includes/header_admin.php'; ?>
<title>Admin | Dashboard</title>

<main>
    <h1 class="section_title">Dashboard</h1>

    <!-- Show message if no events exist -->
    <?php if (empty($events)): ?>
        <p>No events yet. <a href="add_event.php">Add one now</a></p>
    <?php else: ?>
        <div class="event_table_container">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Event Name</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="event_table_body">
                    <!-- Loop through and display each event -->
                    <?php foreach ($events as $ev): ?>
                        <tr>
                            <td><?= htmlspecialchars($ev['title']) ?></td>
                            <td><?= date('d-m-Y', strtotime($ev['event_date'])) ?></td>
                            <td>
                                <!-- Edit and Delete action links -->
                                <a class="btn-edit" href="edit_event.php?id=<?= $ev['id'] ?>" title="Edit">Edit</a>
                                <a class="btn-delete" href="delete_event.php?id=<?= $ev['id'] ?>" onclick="return confirm('Are you sure you want to delete this event?')" title="Delete">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</main>

<!-- Placeholder for additional dashboard JS -->
<script>
</script>

<?php include __DIR__ . '/../Includes/footer.php'; ?>