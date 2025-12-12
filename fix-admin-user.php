<?php
/**
 * Fix Admin User - Create admin user with default password
 * Run this once via: https://your-site.onrender.com/fix-admin-user.php
 * Then DELETE this file for security!
 */

require_once 'includes/config.php';

header('Content-Type: text/html; charset=utf-8');

$message = '';
$success = false;

try {
    // Check if admin user already exists
    $stmt = $pdo->prepare("SELECT id, username FROM admin_users WHERE username = 'admin'");
    $stmt->execute();
    $existing = $stmt->fetch();
    
    if ($existing) {
        // Update password for existing admin user
        $passwordHash = password_hash('admin123', PASSWORD_DEFAULT);
        
        if ($dbType === 'pgsql') {
            $stmt = $pdo->prepare("UPDATE admin_users SET password = ? WHERE username = 'admin'");
        } else {
            $stmt = $pdo->prepare("UPDATE admin_users SET password = ? WHERE username = 'admin'");
        }
        $stmt->execute([$passwordHash]);
        
        $message = "✅ Admin user password updated successfully!<br>";
        $message .= "Username: <strong>admin</strong><br>";
        $message .= "Password: <strong>admin123</strong>";
        $success = true;
    } else {
        // Create new admin user
        $passwordHash = password_hash('admin123', PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO admin_users (username, password, email) VALUES (?, ?, ?)");
        $stmt->execute(['admin', $passwordHash, 'admin@anthemschool.com']);
        
        $message = "✅ Admin user created successfully!<br>";
        $message .= "Username: <strong>admin</strong><br>";
        $message .= "Password: <strong>admin123</strong>";
        $success = true;
    }
    
    // Show all admin users
    $stmt = $pdo->query("SELECT id, username, email FROM admin_users ORDER BY id");
    $allUsers = $stmt->fetchAll();
    
} catch (PDOException $e) {
    $message = "❌ Error: " . $e->getMessage();
    $success = false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fix Admin User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-lg p-8 max-w-md w-full">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Fix Admin User</h1>
        
        <div class="mb-6 p-4 rounded-lg <?php echo $success ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
            <?php echo $message; ?>
        </div>
        
        <?php if (isset($allUsers)): ?>
            <div class="mb-6">
                <h2 class="text-lg font-semibold mb-3">All Admin Users:</h2>
                <div class="space-y-2">
                    <?php foreach ($allUsers as $user): ?>
                        <div class="p-3 bg-gray-50 rounded-lg">
                            <p><strong>ID:</strong> <?php echo htmlspecialchars($user['id']); ?></p>
                            <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
        
        <div class="bg-yellow-100 border border-yellow-300 text-yellow-800 p-4 rounded-lg">
            <p class="font-semibold mb-2">⚠️ Security Notice:</p>
            <p class="text-sm">After verifying login works, please DELETE this file (<code>fix-admin-user.php</code>) for security!</p>
        </div>
        
        <div class="mt-6">
            <a href="admin/login.php" class="block text-center bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                Go to Admin Login
            </a>
        </div>
    </div>
</body>
</html>

