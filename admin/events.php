<?php
$pageTitle = 'Manage Events';
require_once 'includes/admin_header.php';
global $pdo;

// Handle add/edit/delete - similar to announcements
if ($_SERVER['REQUEST_METHOD'] === 'POST' && verifyCSRFToken($_POST['csrf_token'])) {
    if (isset($_POST['add'])) {
        $stmt = $pdo->prepare("INSERT INTO events (title, description, event_date, event_time, location, status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([trim($_POST['title']), trim($_POST['description']), $_POST['event_date'], $_POST['event_time'], trim($_POST['location']), $_POST['status']]);
        echo "<script>showToast('Event added', 'success');</script>";
    } elseif (isset($_POST['edit'])) {
        $stmt = $pdo->prepare("UPDATE events SET title=?, description=?, event_date=?, event_time=?, location=?, status=? WHERE id=?");
        $stmt->execute([trim($_POST['title']), trim($_POST['description']), $_POST['event_date'], $_POST['event_time'], trim($_POST['location']), $_POST['status'], (int)$_POST['id']]);
        echo "<script>showToast('Event updated', 'success');</script>";
    }
}

if (isset($_GET['delete']) && verifyCSRFToken($_GET['token'])) {
    $stmt = $pdo->prepare("DELETE FROM events WHERE id = ?");
    $stmt->execute([(int)$_GET['delete']]);
    echo "<script>showToast('Event deleted', 'success');</script>";
}

$editing = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM events WHERE id = ?");
    $stmt->execute([(int)$_GET['edit']]);
    $editing = $stmt->fetch();
}

$stmt = $pdo->query("SELECT * FROM events ORDER BY event_date DESC");
$events = $stmt->fetchAll();
?>

<div class="mb-6"><h2 class="text-2xl font-bold">Events</h2></div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h3 class="text-xl font-bold mb-4"><?php echo $editing ? 'Edit' : 'Add'; ?> Event</h3>
        <form method="POST" class="space-y-4">
            <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
            <?php if ($editing): ?><input type="hidden" name="id" value="<?php echo $editing['id']; ?>"><input type="hidden" name="edit" value="1">
            <?php else: ?><input type="hidden" name="add" value="1"><?php endif; ?>
            <div><label class="block font-medium mb-2">Title *</label>
                <input type="text" name="title" required value="<?php echo $editing ? clean($editing['title']) : ''; ?>" class="w-full px-4 py-2 border rounded-lg"></div>
            <div><label class="block font-medium mb-2">Description</label>
                <textarea name="description" rows="3" class="w-full px-4 py-2 border rounded-lg"><?php echo $editing ? clean($editing['description']) : ''; ?></textarea></div>
            <div class="grid grid-cols-2 gap-4">
                <div><label class="block font-medium mb-2">Date *</label>
                    <input type="date" name="event_date" required value="<?php echo $editing ? $editing['event_date'] : ''; ?>" class="w-full px-4 py-2 border rounded-lg"></div>
                <div><label class="block font-medium mb-2">Time</label>
                    <input type="time" name="event_time" value="<?php echo $editing ? $editing['event_time'] : ''; ?>" class="w-full px-4 py-2 border rounded-lg"></div>
            </div>
            <div><label class="block font-medium mb-2">Location</label>
                <input type="text" name="location" value="<?php echo $editing ? clean($editing['location']) : ''; ?>" class="w-full px-4 py-2 border rounded-lg"></div>
            <div><label class="block font-medium mb-2">Status</label>
                <select name="status" class="w-full px-4 py-2 border rounded-lg">
                    <option value="upcoming" <?php echo (!$editing || $editing['status'] === 'upcoming') ? 'selected' : ''; ?>>Upcoming</option>
                    <option value="completed" <?php echo ($editing && $editing['status'] === 'completed') ? 'selected' : ''; ?>>Completed</option>
                    <option value="cancelled" <?php echo ($editing && $editing['status'] === 'cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                </select></div>
            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg">Save</button>
                <?php if ($editing): ?><a href="events.php" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg">Cancel</a><?php endif; ?>
            </div>
        </form>
    </div>

    <div class="space-y-4">
        <?php foreach ($events as $event): ?>
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex justify-between items-start mb-2">
                    <h4 class="font-bold"><?php echo clean($event['title']); ?></h4>
                    <span class="text-xs px-2 py-1 rounded-full bg-indigo-100 text-indigo-700"><?php echo ucfirst($event['status']); ?></span>
                </div>
                <?php if ($event['description']): ?><p class="text-sm text-gray-600 mb-3"><?php echo clean($event['description']); ?></p><?php endif; ?>
                <div class="flex items-center text-sm text-gray-600 space-x-4 mb-3">
                    <span><i class="fas fa-calendar mr-1"></i><?php echo formatDate($event['event_date']); ?></span>
                    <?php if ($event['event_time']): ?><span><i class="fas fa-clock mr-1"></i><?php echo date('g:i A', strtotime($event['event_time'])); ?></span><?php endif; ?>
                </div>
                <?php if ($event['location']): ?><p class="text-sm text-gray-600 mb-3"><i class="fas fa-map-marker-alt mr-1"></i><?php echo clean($event['location']); ?></p><?php endif; ?>
                <div class="flex space-x-2 text-xs">
                    <a href="?edit=<?php echo $event['id']; ?>" class="text-blue-600">Edit</a>
                    <a href="?delete=<?php echo $event['id']; ?>&token=<?php echo generateCSRFToken(); ?>" onclick="return confirmDelete()" class="text-red-600">Delete</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once 'includes/admin_footer.php'; ?>

