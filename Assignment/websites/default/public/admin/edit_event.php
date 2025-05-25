<?php
require_once __DIR__ . '/../Includes/session.php';
requireAdmin();

require_once __DIR__ . '/../Includes/config.php';

$success = $error = '';
$id = $_GET['id'] ?? null;

if (!$id) {
    die("Missing event ID.");
}

// Fetch existing event
$stmt = $pdo->prepare("SELECT * FROM events WHERE id = ?");
$stmt->execute([$id]);
$event = $stmt->fetch();

if (!$event) {
    die("Event not found.");
}

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title       = trim($_POST['title']);
    $description = trim($_POST['description']);
    $location    = trim($_POST['location']);
    $category    = trim($_POST['category']);
    $event_date  = $_POST['event_date'];

    $image_path = $event['image_path'];

    // Handle image replacement
    if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../uploads/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

        $filename = time() . '_' . basename($_FILES['image']['name']);
        $targetPath = $uploadDir . $filename;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $image_path = 'uploads/' . $filename;
        }
    }

    try {
        $stmt = $pdo->prepare("UPDATE events SET title = ?, description = ?, location = ?, category = ?, event_date = ?, image_path = ? WHERE id = ?");
        $stmt->execute([$title, $description, $location, $category, $event_date, $image_path, $id]);
        $success = "Event updated successfully.";
    } catch (PDOException $e) {
        $error = "Update failed: " . $e->getMessage();
    }
}
?>

<?php include __DIR__ . '/../../Includes/header.php'; ?>

<main>
    <h1 class="section_title">Edit Event</h1>

    <?php if ($success): ?><p class="input_feedback valid"><?= $success ?></p><?php endif; ?>
    <?php if ($error): ?><p class="input_feedback invalid"><?= $error ?></p><?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="form_group">
            <label>Title</label>
            <input name="title" type="text" value="<?= htmlspecialchars($event['title']) ?>" required>
        </div>

        <div class="form_group">
            <label>Description</label>
            <textarea name="description" rows="5" required><?= htmlspecialchars($event['description']) ?></textarea>
        </div>

        <div class="form_group">
            <label>Location</label>
            <input name="location" type="text" value="<?= htmlspecialchars($event['location']) ?>" required>
        </div>

        <div class="form_group">
            <label>Category</label>
            <input name="category" type="text" value="<?= htmlspecialchars($event['category']) ?>">
        </div>

        <div class="form_group">
            <label>Date</label>
            <input name="event_date" type="date" value="<?= $event['event_date'] ?>" required>
        </div>

        <div class="form_group">
            <label>Change Image (optional)</label>
            <input name="image" type="file" accept="image/*">
        </div>

        <button type="submit" class="buy_button">Update Event</button>
    </form>
</main>

<?php include __DIR__ . '/../../Includes/footer.php'; ?>