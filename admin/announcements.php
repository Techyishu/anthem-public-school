<?php
$pageTitle = 'Manage Announcements';
require_once 'includes/admin_header.php';
global $pdo;

// Handle add/edit/delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && verifyCSRFToken($_POST['csrf_token'])) {
    if (isset($_POST['add'])) {
        $stmt = $pdo->prepare("INSERT INTO announcements (title, content, date, priority, status) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([trim($_POST['title']), trim($_POST['content']), $_POST['date'], $_POST['priority'], $_POST['status']]);
        echo "<script>showToast('Announcement added', 'success');</script>";
    } elseif (isset($_POST['edit'])) {
        $stmt = $pdo->prepare("UPDATE announcements SET title=?, content=?, date=?, priority=?, status=? WHERE id=?");
        $stmt->execute([trim($_POST['title']), trim($_POST['content']), $_POST['date'], $_POST['priority'], $_POST['status'], (int)$_POST['id']]);
        echo "<script>showToast('Announcement updated', 'success');</script>";
    }
}

if (isset($_GET['delete']) && verifyCSRFToken($_GET['token'])) {
    $stmt = $pdo->prepare("DELETE FROM announcements WHERE id = ?");
    $stmt->execute([(int)$_GET['delete']]);
    echo "<script>showToast('Announcement deleted', 'success');</script>";
}

$editing = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM announcements WHERE id = ?");
    $stmt->execute([(int)$_GET['edit']]);
    $editing = $stmt->fetch();
}

$stmt = $pdo->query("SELECT * FROM announcements ORDER BY date DESC, priority DESC");
$announcements = $stmt->fetchAll();
?>

<div class="mb-6"><h2 class="text-2xl font-bold">Announcements</h2></div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h3 class="text-xl font-bold mb-4"><?php echo $editing ? 'Edit' : 'Add'; ?> Announcement</h3>
        <form method="POST" class="space-y-4">
            <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
            <?php if ($editing): ?><input type="hidden" name="id" value="<?php echo $editing['id']; ?>"><input type="hidden" name="edit" value="1">
            <?php else: ?><input type="hidden" name="add" value="1"><?php endif; ?>
            <div><label class="block font-medium mb-2">Title *</label>
                <input type="text" name="title" required value="<?php echo $editing ? clean($editing['title']) : ''; ?>" class="w-full px-4 py-2 border rounded-lg"></div>
            <div><label class="block font-medium mb-2">Content *</label>
                <textarea name="content" rows="4" required class="w-full px-4 py-2 border rounded-lg"><?php echo $editing ? clean($editing['content']) : ''; ?></textarea></div>
            <div class="grid grid-cols-2 gap-4">
                <div><label class="block font-medium mb-2">Date *</label>
                    <input type="date" name="date" required value="<?php echo $editing ? $editing['date'] : date('Y-m-d'); ?>" class="w-full px-4 py-2 border rounded-lg"></div>
                <div><label class="block font-medium mb-2">Priority</label>
                    <select name="priority" class="w-full px-4 py-2 border rounded-lg">
                        <option value="low" <?php echo ($editing && $editing['priority'] === 'low') ? 'selected' : ''; ?>>Low</option>
                        <option value="medium" <?php echo (!$editing || $editing['priority'] === 'medium') ? 'selected' : ''; ?>>Medium</option>
                        <option value="high" <?php echo ($editing && $editing['priority'] === 'high') ? 'selected' : ''; ?>>High</option>
                    </select></div>
            </div>
            <div><label class="block font-medium mb-2">Status</label>
                <select name="status" class="w-full px-4 py-2 border rounded-lg">
                    <option value="published" <?php echo (!$editing || $editing['status'] === 'published') ? 'selected' : ''; ?>>Published</option>
                    <option value="draft" <?php echo ($editing && $editing['status'] === 'draft') ? 'selected' : ''; ?>>Draft</option>
                </select></div>
            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg">Save</button>
                <?php if ($editing): ?><a href="announcements.php" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg">Cancel</a><?php endif; ?>
            </div>
        </form>
    </div>

    <div class="space-y-4">
        <?php foreach ($announcements as $ann): ?>
            <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 <?php echo $ann['priority'] === 'high' ? 'border-red-500' : ($ann['priority'] === 'medium' ? 'border-yellow-500' : 'border-blue-500'); ?>">
                <div class="flex justify-between items-start mb-2">
                    <h4 class="font-bold"><?php echo clean($ann['title']); ?></h4>
                    <span class="text-xs px-2 py-1 rounded-full <?php echo $ann['status'] === 'published' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700'; ?>"><?php echo ucfirst($ann['status']); ?></span>
                </div>
                <p class="text-sm text-gray-600 mb-3"><?php echo clean($ann['content']); ?></p>
                <div class="flex justify-between items-center text-xs text-gray-500">
                    <span><?php echo formatDate($ann['date']); ?></span>
                    <div class="space-x-2">
                        <a href="?edit=<?php echo $ann['id']; ?>" class="text-blue-600">Edit</a>
                        <a href="?delete=<?php echo $ann['id']; ?>&token=<?php echo generateCSRFToken(); ?>" onclick="return confirmDelete()" class="text-red-600">Delete</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once 'includes/admin_footer.php'; ?>

