<?php
$pageTitle = 'Add Staff Member';
require_once 'includes/admin_header.php';
global $pdo;

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && verifyCSRFToken($_POST['csrf_token'])) {
    $photoFilename = null;
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $upload = uploadFile($_FILES['photo'], '../uploads/staff');
        if ($upload['success']) $photoFilename = $upload['filename'];
    }
    
    try {
        $stmt = $pdo->prepare("INSERT INTO staff (name, photo, designation, department, qualification, experience, email, phone, specialization, display_order) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            trim($_POST['name']), $photoFilename, trim($_POST['designation']), trim($_POST['department']),
            trim($_POST['qualification']), trim($_POST['experience']), trim($_POST['email']),
            trim($_POST['phone']), trim($_POST['specialization']), (int)$_POST['display_order']
        ]);
        echo "<script>showToast('Staff member added', 'success'); setTimeout(() => window.location.href = 'staff.php', 1500);</script>";
    } catch (PDOException $e) {
        $message = 'Error: ' . $e->getMessage();
    }
}
?>

<div class="mb-6"><a href="staff.php" class="text-blue-600"><i class="fas fa-arrow-left mr-2"></i>Back</a></div>
<div class="bg-white rounded-xl shadow-lg p-8 max-w-3xl">
    <h2 class="text-2xl font-bold mb-6">Add Staff Member</h2>
    <?php if ($message): ?><div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg"><?php echo $message; ?></div><?php endif; ?>
    
    <form method="POST" enctype="multipart/form-data" class="space-y-4">
        <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
        <div><label class="block text-gray-700 font-medium mb-2">Name *</label>
            <input type="text" name="name" required class="w-full px-4 py-2 border rounded-lg"></div>
        <div><label class="block text-gray-700 font-medium mb-2">Photo</label>
            <input type="file" name="photo" accept="image/*" class="w-full px-4 py-2 border rounded-lg"></div>
        <div class="grid grid-cols-2 gap-4">
            <div><label class="block text-gray-700 font-medium mb-2">Designation *</label>
                <input type="text" name="designation" required class="w-full px-4 py-2 border rounded-lg"></div>
            <div><label class="block text-gray-700 font-medium mb-2">Department *</label>
                <select name="department" required class="w-full px-4 py-2 border rounded-lg">
                    <option value="">Select</option><option value="Administration">Administration</option>
                    <option value="Science">Science</option><option value="Mathematics">Mathematics</option>
                    <option value="English">English</option><option value="Social Science">Social Science</option>
                    <option value="Sports">Sports</option><option value="Others">Others</option>
                </select></div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div><label class="block text-gray-700 font-medium mb-2">Qualification</label>
                <input type="text" name="qualification" class="w-full px-4 py-2 border rounded-lg"></div>
            <div><label class="block text-gray-700 font-medium mb-2">Experience</label>
                <input type="text" name="experience" class="w-full px-4 py-2 border rounded-lg" placeholder="e.g., 10 Years"></div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div><label class="block text-gray-700 font-medium mb-2">Email</label>
                <input type="email" name="email" class="w-full px-4 py-2 border rounded-lg"></div>
            <div><label class="block text-gray-700 font-medium mb-2">Phone</label>
                <input type="tel" name="phone" class="w-full px-4 py-2 border rounded-lg"></div>
        </div>
        <div><label class="block text-gray-700 font-medium mb-2">Specialization</label>
            <textarea name="specialization" rows="2" class="w-full px-4 py-2 border rounded-lg"></textarea></div>
        <div><label class="block text-gray-700 font-medium mb-2">Display Order</label>
            <input type="number" name="display_order" value="0" class="w-full px-4 py-2 border rounded-lg"></div>
        <div class="flex space-x-4">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Save</button>
            <a href="staff.php" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg">Cancel</a>
        </div>
    </form>
</div>

<?php require_once 'includes/admin_footer.php'; ?>

