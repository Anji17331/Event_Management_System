<?php
// boot the session & enforce admin
require_once __DIR__ . '/../../Includes/session.php';
requireAuth();
requireAdmin();

// connect to DB
require_once __DIR__ . '/../../Includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title       = trim($_POST['title']);
    $description = trim($_POST['description']);
    $location    = trim($_POST['location']);
    $category    = trim($_POST['category']);
    $event_date  = $_POST['event_date'];

    // handle optional upload
    $image_path = null;
    if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $filename   = time() . '_' . basename($_FILES['image']['name']);
        $targetPath = $uploadDir . $filename;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            // save relative path for web
            $image_path = 'admin/uploads/' . $filename;
        }
    }

    $stmt = $pdo->prepare("
        INSERT INTO events 
          (title, description, location, category, event_date, image_path)
        VALUES
          (?, ?, ?, ?, ?, ?)
    ");
    if ($stmt->execute([$title, $description, $location, $category, $event_date, $image_path])) {
        $success = "Event “" . htmlspecialchars($title) . "” added.";
    } else {
        $error = "Sorry, couldn’t save that event.";
    }
}
?>
<?php include __DIR__ . '/../header.php'; ?>

<main>
    <h1 class="section_title">Add New Event</h1>

    <?php if (!empty($success)): ?>
        <p class="input_feedback valid"><?= $success ?></p>
    <?php elseif (!empty($error)): ?>
        <p class="input_feedback invalid"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="form_group">
            <label for="title">Title</label>
            <input id="title" name="title" type="text" required>
        </div>

        <div class="form_group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="5" required></textarea>
        </div>

        <div class="form_group">
            <label for="location">Location</label>
            <input id="location" name="location" type="text" required>
        </div>

        <div class="form_group">
            <label for="category">Category</label>
            <input id="category" name="category" type="text">
        </div>

        <div class="form_group">
            <label for="event_date">Date</label>
            <input id="event_date" name="event_date" type="date" required>
        </div>

        <div class="form_group">
            <label for="image">Image (optional)</label>
            <input id="image" name="image" type="file" accept="image/*">
        </div>

        <button type="submit" class="buy_button">Add Event</button>
    </form>
</main>

<?php include __DIR__ . '/../footer.php'; ?>