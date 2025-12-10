<?php
$pageTitle = 'Admission Inquiries';
require_once 'includes/admin_header.php';

global $pdo;

// Handle status update
if (isset($_POST['update_status']) && verifyCSRFToken($_POST['csrf_token'])) {
    $id = (int)$_POST['id'];
    $status = $_POST['status'];
    
    try {
        $stmt = $pdo->prepare("UPDATE admission_inquiries SET status = ? WHERE id = ?");
        $stmt->execute([$status, $id]);
        echo "<script>showToast('Status updated successfully', 'success');</script>";
    } catch (PDOException $e) {
        echo "<script>showToast('Error updating status', 'error');</script>";
    }
}

// Handle delete
if (isset($_GET['delete']) && isset($_GET['token']) && verifyCSRFToken($_GET['token'])) {
    $id = (int)$_GET['delete'];
    
    try {
        $stmt = $pdo->prepare("DELETE FROM admission_inquiries WHERE id = ?");
        $stmt->execute([$id]);
        echo "<script>showToast('Inquiry deleted successfully', 'success');</script>";
    } catch (PDOException $e) {
        echo "<script>showToast('Error deleting inquiry', 'error');</script>";
    }
}

// Get filter
$filterStatus = $_GET['status'] ?? 'all';

try {
    if ($filterStatus === 'all') {
        $stmt = $pdo->query("SELECT * FROM admission_inquiries ORDER BY submitted_at DESC");
    } else {
        $stmt = $pdo->prepare("SELECT * FROM admission_inquiries WHERE status = ? ORDER BY submitted_at DESC");
        $stmt->execute([$filterStatus]);
    }
    $inquiries = $stmt->fetchAll();
} catch (PDOException $e) {
    $inquiries = [];
}
?>

<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Admission Inquiries</h2>
    
    <!-- Filters -->
    <div class="flex space-x-2">
        <a href="?status=all" class="px-4 py-2 rounded-lg <?php echo $filterStatus === 'all' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700'; ?>">
            All
        </a>
        <a href="?status=pending" class="px-4 py-2 rounded-lg <?php echo $filterStatus === 'pending' ? 'bg-orange-600 text-white' : 'bg-gray-200 text-gray-700'; ?>">
            Pending
        </a>
        <a href="?status=reviewed" class="px-4 py-2 rounded-lg <?php echo $filterStatus === 'reviewed' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700'; ?>">
            Reviewed
        </a>
        <a href="?status=contacted" class="px-4 py-2 rounded-lg <?php echo $filterStatus === 'contacted' ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-700'; ?>">
            Contacted
        </a>
    </div>
</div>

<div class="space-y-4">
    <?php if (empty($inquiries)): ?>
        <div class="bg-white rounded-xl shadow-lg p-16 text-center">
            <i class="fas fa-envelope-open text-gray-400 text-6xl mb-4"></i>
            <h3 class="text-xl font-bold text-gray-600 mb-2">No Inquiries Found</h3>
            <p class="text-gray-500">Check back later for new admission inquiries</p>
        </div>
    <?php else: ?>
        <?php foreach ($inquiries as $inquiry): ?>
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800"><?php echo clean($inquiry['student_name']); ?></h3>
                        <p class="text-sm text-gray-600">Applying for <?php echo clean($inquiry['class_applying']); ?></p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                        <?php echo $inquiry['status'] === 'pending' ? 'bg-orange-100 text-orange-700' : 
                                  ($inquiry['status'] === 'reviewed' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700'); ?>">
                        <?php echo ucfirst($inquiry['status']); ?>
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <p class="text-sm text-gray-600 mb-1"><strong>Parent Name:</strong> <?php echo clean($inquiry['parent_name']); ?></p>
                        <p class="text-sm text-gray-600 mb-1"><strong>Email:</strong> <?php echo clean($inquiry['email']); ?></p>
                        <p class="text-sm text-gray-600 mb-1"><strong>Phone:</strong> <?php echo clean($inquiry['phone']); ?></p>
                    </div>
                    <div>
                        <?php if ($inquiry['previous_school']): ?>
                            <p class="text-sm text-gray-600 mb-1"><strong>Previous School:</strong> <?php echo clean($inquiry['previous_school']); ?></p>
                        <?php endif; ?>
                        <p class="text-sm text-gray-600"><strong>Submitted:</strong> <?php echo formatDate($inquiry['submitted_at'], 'd M Y, g:i A'); ?></p>
                    </div>
                </div>

                <?php if ($inquiry['message']): ?>
                    <div class="bg-gray-50 rounded-lg p-4 mb-4">
                        <p class="text-sm text-gray-700"><?php echo clean($inquiry['message']); ?></p>
                    </div>
                <?php endif; ?>

                <div class="flex space-x-2">
                    <form method="POST" class="inline">
                        <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                        <input type="hidden" name="id" value="<?php echo $inquiry['id']; ?>">
                        <input type="hidden" name="update_status" value="1">
                        
                        <select name="status" onchange="this.form.submit()" 
                                class="px-3 py-1 border border-gray-300 rounded-lg text-sm">
                            <option value="pending" <?php echo $inquiry['status'] === 'pending' ? 'selected' : ''; ?>>Pending</option>
                            <option value="reviewed" <?php echo $inquiry['status'] === 'reviewed' ? 'selected' : ''; ?>>Reviewed</option>
                            <option value="contacted" <?php echo $inquiry['status'] === 'contacted' ? 'selected' : ''; ?>>Contacted</option>
                        </select>
                    </form>

                    <a href="mailto:<?php echo clean($inquiry['email']); ?>" 
                       class="text-blue-600 hover:text-blue-800 text-sm">
                        <i class="fas fa-envelope mr-1"></i>Email
                    </a>
                    <a href="tel:<?php echo clean($inquiry['phone']); ?>" 
                       class="text-green-600 hover:text-green-800 text-sm">
                        <i class="fas fa-phone mr-1"></i>Call
                    </a>
                    <a href="?delete=<?php echo $inquiry['id']; ?>&token=<?php echo generateCSRFToken(); ?>" 
                       class="text-red-600 hover:text-red-800 text-sm"
                       onclick="return confirmDelete('Delete this inquiry?')">
                        <i class="fas fa-trash mr-1"></i>Delete
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php require_once 'includes/admin_footer.php'; ?>

