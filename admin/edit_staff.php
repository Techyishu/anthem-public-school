<?php
$pageTitle = 'Edit Staff Member';
require_once 'includes/admin_header.php';
global $pdo;

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) { header('Location: staff.php'); exit; }

$stmt = $pdo->prepare("SELECT * FROM staff WHERE id = ?");
$stmt->execute([$id]);
$staff = $stmt->fetch();
if (!$staff) { header('Location: staff.php'); exit; }

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && verifyCSRFToken($_POST['csrf_token'])) {
    $photoFilename = $staff['photo'];
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        if ($photoFilename) deleteFile('../uploads/staff/' . $photoFilename);
        $upload = uploadFile($_FILES['photo'], '../uploads/staff');
        if ($upload['success']) $photoFilename = $upload['filename'];
    }
    
    try {
        $stmt = $pdo->prepare("UPDATE staff SET name=?, photo=?, designation=?, department=?, qualification=?, experience=?, email=?, phone=?, specialization=?, display_order=? WHERE id=?");
        $stmt->execute([
            trim($_POST['name']), $photoFilename, trim($_POST['designation']), trim($_POST['department']),
            trim($_POST['qualification']), trim($_POST['experience']), trim($_POST['email']),
            trim($_POST['phone']), trim($_POST['specialization']), (int)$_POST['display_order'], $id
        ]);
        $message = 'Staff member updated';
        $stmt = $pdo->prepare("SELECT * FROM staff WHERE id = ?");
        $stmt->execute([$id]);
        $staff = $stmt->fetch();
    } catch (PDOException $e) {
        $message = 'Error: ' . $e->getMessage();
    }
}
?>

<div class="mb-6"><a href="staff.php" class="text-blue-600"><i class="fas fa-arrow-left mr-2"></i>Back</a></div>
<div class="bg-white rounded-xl shadow-lg p-8 max-w-3xl">
    <h2 class="text-2xl font-bold mb-6">Edit Staff Member</h2>
    <?php if ($message): ?><div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg"><?php echo $message; ?></div><?php endif; ?>
    
    <form method="POST" enctype="multipart/form-data" class="space-y-4">
        <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
        <?php if ($staff['photo']): ?>
            <div><label class="block font-medium mb-2">Current Photo</label>
                <img src="../uploads/staff/<?php echo clean($staff['photo']); ?>" class="w-32 h-32 rounded-lg object-cover"></div>
        <?php endif; ?>
        <div><label class="block text-gray-700 font-medium mb-2">Name *</label>
            <input type="text" name="name" required value="<?php echo clean($staff['name']); ?>" class="w-full px-4 py-2 border rounded-lg"></div>
        <div><label class="block text-gray-700 font-medium mb-2">Photo</label>
            <input type="file" name="photo" accept="image/*" class="w-full px-4 py-2 border rounded-lg"></div>
        <div class="grid grid-cols-2 gap-4">
            <div><label class="block text-gray-700 font-medium mb-2">Designation *</label>
                <input type="text" name="designation" required value="<?php echo clean($staff['designation']); ?>" class="w-full px-4 py-2 border rounded-lg"></div>
            <div><label class="block text-gray-700 font-medium mb-2">Department *</label>
                <select name="department" required class="w-full px-4 py-2 border rounded-lg">
                    <option value="Administration" <?php echo $staff['department'] === 'Administration' ? 'selected' : ''; ?>>Administration</option>
                    <option value="Science" <?php echo $staff['department'] === 'Science' ? 'selected' : ''; ?>>Science</option>
                    <option value="Mathematics" <?php echo $staff['department'] === 'Mathematics' ? 'selected' : ''; ?>>Mathematics</option>
                    <option value="English" <?php echo $staff['department'] === 'English' ? 'selected' : ''; ?>>English</option>
                    <option value="Social Science" <?php echo $staff['department'] === 'Social Science' ? 'selected' : ''; ?>>Social Science</option>
                    <option value="Sports" <?php echo $staff['department'] === 'Sports' ? 'selected' : ''; ?>>Sports</option>
                    <option value="Others" <?php echo $staff['department'] === 'Others' ? 'selected' : ''; ?>>Others</option>
                </select></div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div><label class="block text-gray-700 font-medium mb-2">Qualification</label>
                <input type="text" name="qualification" value="<?php echo clean($staff['qualification']); ?>" class="w-full px-4 py-2 border rounded-lg"></div>
            <div><label class="block text-gray-700 font-medium mb-2">Experience</label>
                <input type="text" name="experience" value="<?php echo clean($staff['experience']); ?>" class="w-full px-4 py-2 border rounded-lg"></div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div><label class="block text-gray-700 font-medium mb-2">Email</label>
                <input type="email" name="email" value="<?php echo clean($staff['email']); ?>" class="w-full px-4 py-2 border rounded-lg"></div>
            <div><label class="block text-gray-700 font-medium mb-2">Phone</label>
                <input type="tel" name="phone" value="<?php echo clean($staff['phone']); ?>" class="w-full px-4 py-2 border rounded-lg"></div>
        </div>
        <div><label class="block text-gray-700 font-medium mb-2">Specialization</label>
            <textarea name="specialization" rows="2" class="w-full px-4 py-2 border rounded-lg"><?php echo clean($staff['specialization']); ?></textarea></div>
        <div><label class="block text-gray-700 font-medium mb-2">Display Order</label>
            <input type="number" name="display_order" value="<?php echo clean($staff['display_order']); ?>" class="w-full px-4 py-2 border rounded-lg"></div>
        <div class="flex space-x-4">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Update</button>
            <a href="staff.php" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg">Cancel</a>
        </div>
    </form>
</div>

<?php require_once 'includes/admin_footer.php'; ?>

