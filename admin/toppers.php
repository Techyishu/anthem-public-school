<?php
$pageTitle = 'Manage Toppers';
require_once 'includes/admin_header.php';

global $pdo;

// Handle delete
if (isset($_GET['delete']) && isset($_GET['token']) && verifyCSRFToken($_GET['token'])) {
    $id = (int)$_GET['delete'];
    
    try {
        // Get topper photo
        $stmt = $pdo->prepare("SELECT photo FROM toppers WHERE id = ?");
        $stmt->execute([$id]);
        $topper = $stmt->fetch();
        
        // Delete photo file
        if ($topper && $topper['photo']) {
            deleteFile('../uploads/toppers/' . $topper['photo']);
        }
        
        // Delete from database
        $stmt = $pdo->prepare("DELETE FROM toppers WHERE id = ?");
        $stmt->execute([$id]);
        
        echo "<script>showToast('Topper deleted successfully', 'success');</script>";
    } catch (PDOException $e) {
        echo "<script>showToast('Error deleting topper', 'error');</script>";
    }
}

// Get all toppers
try {
    $stmt = $pdo->query("SELECT * FROM toppers ORDER BY year DESC, percentage DESC");
    $toppers = $stmt->fetchAll();
} catch (PDOException $e) {
    $toppers = [];
}
?>

<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-gray-800">All Toppers</h2>
    <a href="add_topper.php" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
        <i class="fas fa-plus mr-2"></i>Add New Topper
    </a>
</div>

<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <?php if (empty($toppers)): ?>
        <div class="text-center py-16">
            <i class="fas fa-trophy text-gray-400 text-6xl mb-4"></i>
            <h3 class="text-xl font-bold text-gray-600 mb-2">No Toppers Yet</h3>
            <p class="text-gray-500 mb-4">Start by adding your first topper</p>
            <a href="add_topper.php" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                <i class="fas fa-plus mr-2"></i>Add Topper
            </a>
        </div>
    <?php else: ?>
        <div class="overflow-x-auto -mx-4 sm:mx-0">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Photo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Class</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Marks</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">%</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Year</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Board</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($toppers as $topper): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php if ($topper['photo']): ?>
                                    <img src="../uploads/toppers/<?php echo clean($topper['photo']); ?>" 
                                         alt="<?php echo clean($topper['name']); ?>" 
                                         class="w-12 h-12 rounded-full object-cover">
                                <?php else: ?>
                                    <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-gray-400"></i>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-medium text-gray-900"><?php echo clean($topper['name']); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-600"><?php echo clean($topper['class']); ?></span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-medium text-gray-900"><?php echo clean($topper['marks']); ?></span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    <?php echo clean($topper['percentage']); ?>%
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-600"><?php echo clean($topper['year']); ?></span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-600"><?php echo clean($topper['board']); ?></span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="edit_topper.php?id=<?php echo $topper['id']; ?>" 
                                   class="text-blue-600 hover:text-blue-900 mr-3">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="?delete=<?php echo $topper['id']; ?>&token=<?php echo generateCSRFToken(); ?>" 
                                   class="text-red-600 hover:text-red-900"
                                   onclick="return confirmDelete('Are you sure you want to delete this topper?')">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php require_once 'includes/admin_footer.php'; ?>

