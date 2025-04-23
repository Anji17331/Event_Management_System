<?php
// any logged-in user can view the dashboard
require_once '../Includes/session.php';
requireAuth();

// database connection
require_once '../Includes/config.php';

// fetch all events, newest first
$stmt   = $pdo->query("SELECT * FROM events ORDER BY event_date DESC");
$events = $stmt->fetchAll();
?>
<?php include 'header.php'; ?>

<main>
    <h1 class="section_title">Dashboard</h1>

    <?php if (empty($events)): ?>
        <p>No events found. <?php if (isAdmin()): ?><a href="add_event.php">Add one now.</a><?php endif; ?></p>
    <?php else: ?>
        <div class="event_grid">
            <?php foreach ($events as $ev): ?>
                <div class="event_card">
                    <?php if ($ev['image_path']): ?>
                        <div class="event_image">
                            <img src="<?= htmlspecialchars($ev['image_path']) ?>"
                                alt="<?= htmlspecialchars($ev['title']) ?>">
                        </div>
                    <?php endif; ?>
                    <div class="event_details">
                        <div class="event_title"><?= htmlspecialchars($ev['title']) ?></div>
                        <div class="event_description">
                            <?= nl2br(htmlspecialchars(mb_strimwidth($ev['description'], 0, 100, '…'))) ?>
                        </div>
                        <div class="event_meta">
                            <div class="event_loaction">
                                <i class="material-icons">location_on</i>
                                <?= htmlspecialchars($ev['location']) ?>
                            </div>
                            <div class="event_date">
                                <i class="material-icons">calendar_today</i>
                                <?= date('F j, Y', strtotime($ev['event_date'])) ?>
                            </div>
                        </div>
                        <?php if (isAdmin()): ?>
                            <a href="edit_event.php?id=<?= $ev['id'] ?>" class="buy_button">Edit</a>
                            <a href="delete_event.php?id=<?= $ev['id'] ?>" class="buy_button">Delete</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>