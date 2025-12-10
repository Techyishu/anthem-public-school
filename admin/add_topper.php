<?php
$pageTitle = 'Add New Topper';
require_once 'includes/admin_header.php';

global $pdo;

$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (verifyCSRFToken($_POST['csrf_token'])) {
        $name = trim($_POST['name']);
        $marks = trim($_POST['marks']);
        $percentage = (float)$_POST['percentage'];
        $year = (int)$_POST['year'];
        $board = trim($_POST['board']);
        $class = trim($_POST['class']);
        $achievement = trim($_POST['achievement']);
        
        $errors = [];
        
        if (empty($name)) $errors[] = 'Name is required';
        if (empty($marks)) $errors[] = 'Marks are required';
        if ($percentage <= 0) $errors[] = 'Valid percentage is required';
        if ($year <= 0) $errors[] = 'Valid year is required';
        if (empty($board)) $errors[] = 'Board is required';
        if (empty($class)) $errors[] = 'Class is required';
        
        // Handle photo upload
        $photoFilename = null;
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $upload = uploadFile($_FILES['photo'], '../uploads/toppers');
            if ($upload['success']) {
                $photoFilename = $upload['filename'];
            } else {
                $errors[] = $upload['message'];
            }
        }
        
        if (empty($errors)) {
            try {
                $stmt = $pdo->prepare("
                    INSERT INTO toppers (name, photo, marks, percentage, year, board, class, achievement) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
                ");
                $stmt->execute([$name, $photoFilename, $marks, $percentage, $year, $board, $class, $achievement]);
                
                echo "<script>
                    showToast('Topper added successfully', 'success');
                    setTimeout(() => window.location.href = 'toppers.php', 1500);
                </script>";
            } catch (PDOException $e) {
                $message = 'Database error: ' . $e->getMessage();
                $messageType = 'error';
            }
        } else {
            $message = implode('<br>', $errors);
            $messageType = 'error';
        }
    } else {
        $message = 'Invalid security token';
        $messageType = 'error';
    }
}
?>

<div class="mb-6">
    <a href="toppers.php" class="text-blue-600 hover:text-blue-800">
        <i class="fas fa-arrow-left mr-2"></i>Back to Toppers
    </a>
</div>

<div class="bg-white rounded-xl shadow-lg p-8 max-w-3xl">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Add New Topper</h2>

    <?php if ($message): ?>
        <div class="mb-6 p-4 rounded-lg <?php echo $messageType === 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" class="space-y-6">
        <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">

        <div>
            <label class="block text-gray-700 font-medium mb-2">Student Name *</label>
            <input type="text" name="name" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                   placeholder="Enter student name">
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-2">Photo</label>
            <input type="file" name="photo" accept="image/*"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            <p class="text-sm text-gray-500 mt-1">Max 5MB. Accepted: JPG, PNG, GIF</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 font-medium mb-2">Marks Obtained *</label>
                <input type="text" name="marks" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                       placeholder="e.g., 495/500">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-2">Percentage *</label>
                <input type="number" name="percentage" step="0.01" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                       placeholder="e.g., 99.00">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-gray-700 font-medium mb-2">Year *</label>
                <input type="number" name="year" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                       placeholder="e.g., 2024">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-2">Board *</label>
                <select name="board" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Select Board</option>
                    <option value="CBSE">CBSE</option>
                    <option value="ICSE">ICSE</option>
                    <option value="State Board">State Board</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-2">Class *</label>
                <select name="class" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Select Class</option>
                    <option value="Class 10">Class 10</option>
                    <option value="Class 12">Class 12</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-2">Achievement / Special Note</label>
            <textarea name="achievement" rows="3"
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                      placeholder="e.g., All India Rank 15, Perfect Score in Mathematics"></textarea>
        </div>

        <div class="flex space-x-4">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                <i class="fas fa-save mr-2"></i>Save Topper
            </button>
            <a href="toppers.php" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition">
                Cancel
            </a>
        </div>
    </form>
</div>

<?php require_once 'includes/admin_footer.php'; ?>

