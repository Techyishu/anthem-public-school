<?php
$pageTitle = 'Manage Staff';
require_once 'includes/admin_header.php';

global $pdo;

// Handle delete
if (isset($_GET['delete']) && isset($_GET['token']) && verifyCSRFToken($_GET['token'])) {
    $id = (int)$_GET['delete'];
    
    try {
        $stmt = $pdo->prepare("SELECT photo FROM staff WHERE id = ?");
        $stmt->execute([$id]);
        $staff = $stmt->fetch();
        
        if ($staff && $staff['photo']) {
            deleteFile('../uploads/staff/' . $staff['photo']);
        }
        
        $stmt = $pdo->prepare("DELETE FROM staff WHERE id = ?");
        $stmt->execute([$id]);
        
        echo "<script>showToast('Staff member deleted successfully', 'success');</script>";
    } catch (PDOException $e) {
        echo "<script>showToast('Error deleting staff member', 'error');</script>";
    }
}

try {
    $stmt = $pdo->query("SELECT * FROM staff ORDER BY display_order ASC, name ASC");
    $staffMembers = $stmt->fetchAll();
} catch (PDOException $e) {
    $staffMembers = [];
}
?>

<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-gray-800">All Staff Members</h2>
    <a href="add_staff.php" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
        <i class="fas fa-plus mr-2"></i>Add New Staff
    </a>
</div>

<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <?php if (empty($staffMembers)): ?>
        <div class="text-center py-16">
            <i class="fas fa-user-tie text-gray-400 text-6xl mb-4"></i>
            <h3 class="text-xl font-bold text-gray-600 mb-2">No Staff Members Yet</h3>
            <p class="text-gray-500 mb-4">Start by adding your first staff member</p>
            <a href="add_staff.php" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                <i class="fas fa-plus mr-2"></i>Add Staff
            </a>
        </div>
    <?php else: ?>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Photo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Designation</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Department</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Experience</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($staffMembers as $staff): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php if ($staff['photo']): ?>
                                    <img src="../uploads/staff/<?php echo clean($staff['photo']); ?>" 
                                         alt="<?php echo clean($staff['name']); ?>" 
                                         class="w-12 h-12 rounded-full object-cover">
                                <?php else: ?>
                                    <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-gray-400"></i>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900"><?php echo clean($staff['name']); ?></div>
                                <div class="text-sm text-gray-500"><?php echo clean($staff['email'] ?? ''); ?></div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-900"><?php echo clean($staff['designation']); ?></span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">
                                    <?php echo clean($staff['department']); ?>
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-600"><?php echo clean($staff['experience'] ?? 'N/A'); ?></span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="edit_staff.php?id=<?php echo $staff['id']; ?>" 
                                   class="text-blue-600 hover:text-blue-900 mr-3">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="?delete=<?php echo $staff['id']; ?>&token=<?php echo generateCSRFToken(); ?>" 
                                   class="text-red-600 hover:text-red-900"
                                   onclick="return confirmDelete('Are you sure you want to delete this staff member?')">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php require_once 'includes/admin_footer.php'; ?>

