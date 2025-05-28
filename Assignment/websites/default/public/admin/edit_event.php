<?php
// Require admin session
require_once __DIR__ . '/../Includes/session.php';
requireAdmin();

// Include DB config
require_once __DIR__ . '/../Includes/config.php';

$success = $error = '';
$id = $_GET['id'] ?? null;

// Stop if no event ID
if (!$id) {
    die("Missing event ID.");
}

// Fetch event by ID
$stmt = $pdo->prepare("SELECT * FROM events WHERE id = ?");
$stmt->execute([$id]);
$event = $stmt->fetch();

if (!$event) {
    die("Event not found.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $title       = trim($_POST['title']);
    $description = trim($_POST['description']);
    $location    = trim($_POST['location']);
    $category    = trim($_POST['category']);
    $event_date  = $_POST['event_date'];
    $image_path  = $event['image_path'];

    // Handle optional image upload
    if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../uploads/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

        $filename = time() . '_' . basename($_FILES['image']['name']);
        $targetPath = $uploadDir . $filename;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $image_path = 'uploads/' . $filename;
        }
    }

    // Update event in DB
    try {
        $stmt = $pdo->prepare("UPDATE events SET title = ?, description = ?, location = ?, category = ?, event_date = ?, image_path = ? WHERE id = ?");
        $stmt->execute([$title, $description, $location, $category, $event_date, $image_path, $id]);

        // Redirect after successful update
        $success = "Event updated successfully.";
        header("Location: dashboard.php");
        exit;
    } catch (PDOException $e) {
        $error = "Update failed: " . $e->getMessage();
    }
}
?>

<?php include __DIR__ . '/../Includes/header_admin.php'; ?>
<title>Admin | Edit Event</title>

<main>
    <h1 class="section_title">Edit Event</h1>

    <!-- Show messages if any -->
    <?php if ($success): ?><p class="input_feedback valid"><?= $success ?></p><?php endif; ?>
    <?php if ($error): ?><p class="input_feedback invalid"><?= $error ?></p><?php endif; ?>

    <!-- Edit Event Form -->
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

        <!-- Image Preview & Upload -->
        <div class="form_group">
            <label>Change Image (optional)</label><br>
            <?php if (!empty($event['image_path'])): ?>
                <img id="imagePreview" src="../<?= htmlspecialchars($event['image_path']) ?>" alt="Current Image"
                    style="display:block; max-height:150px; margin-bottom:10px; border-radius: 6px;">
            <?php else: ?>
                <img id="imagePreview" src="" alt="Image Preview" style="display:none; max-height:150px; margin-bottom:10px;">
            <?php endif; ?>
            <input name="image" type="file" accept="image/*" onchange="previewImage(this)">
        </div>

        <button type="submit" class="buy_button">Update Event</button>
    </form>

    <!-- Show preview of selected image -->
    <script>
        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</main>

<?php include __DIR__ . '/../Includes/footer.php'; ?>