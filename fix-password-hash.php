<?php
/**
 * Fix Corrupted Password Hash
 * The password hash in the database has a % character at the end which breaks password verification
 * Run this once, then DELETE this file!
 */

require_once 'includes/config.php';

header('Content-Type: text/html; charset=utf-8');

$message = '';
$success = false;

try {
    // Get current user
    $stmt = $pdo->query("SELECT id, username, email, password FROM admin_users WHERE username = 'schooladmin' OR username = 'admin' LIMIT 1");
    $user = $stmt->fetch();
    
    if (!$user) {
        $message = "❌ No admin user found in database";
    } else {
        $message = "<strong>Found user:</strong><br>";
        $message .= "ID: " . $user['id'] . "<br>";
        $message .= "Username: " . htmlspecialchars($user['username']) . "<br>";
        $message .= "Email: " . htmlspecialchars($user['email']) . "<br>";
        $message .= "Current password hash length: " . strlen($user['password']) . "<br>";
        $message .= "Current hash (first 30 chars): " . htmlspecialchars(substr($user['password'], 0, 30)) . "...<br>";
        
        // Check if hash has % at the end
        if (substr($user['password'], -1) === '%') {
            $message .= "<br>⚠️ <strong>Problem detected:</strong> Password hash ends with '%' character!<br>";
            
            // Remove the % character
            $cleanHash = rtrim($user['password'], '%');
            $message .= "Cleaned hash length: " . strlen($cleanHash) . "<br>";
            
            // Update the password hash (remove %)
            $stmt = $pdo->prepare("UPDATE admin_users SET password = ? WHERE id = ?");
            $stmt->execute([$cleanHash, $user['id']]);
            
            $message .= "<br>✅ <strong>Fixed:</strong> Removed '%' from password hash<br>";
        } else {
            $message .= "<br>✅ Password hash looks correct (no % at end)<br>";
        }
        
        // Now create/update admin user with known password
        $newPassword = 'admin123';
        $newHash = password_hash($newPassword, PASSWORD_DEFAULT);
        
        // Check if admin user exists
        $stmt = $pdo->prepare("SELECT id FROM admin_users WHERE username = 'admin'");
        $stmt->execute();
        $adminUser = $stmt->fetch();
        
        if ($adminUser) {
            // Update existing admin user
            $stmt = $pdo->prepare("UPDATE admin_users SET password = ? WHERE username = 'admin'");
            $stmt->execute([$newHash]);
            $message .= "<br>✅ Updated 'admin' user password<br>";
        } else {
            // Create new admin user
            $stmt = $pdo->prepare("INSERT INTO admin_users (username, password, email) VALUES (?, ?, ?)");
            $stmt->execute(['admin', $newHash, 'admin@anthemschool.com']);
            $message .= "<br>✅ Created 'admin' user<br>";
        }
        
        // Also fix the schooladmin user password
        $stmt = $pdo->prepare("UPDATE admin_users SET password = ? WHERE username = 'schooladmin'");
        $stmt->execute([$newHash]);
        $message .= "✅ Updated 'schooladmin' user password<br>";
        
        $message .= "<br><strong>Login Credentials:</strong><br>";
        $message .= "Username: <strong>admin</strong> OR <strong>schooladmin</strong><br>";
        $message .= "Password: <strong>admin123</strong><br>";
        
        $success = true;
    }
    
    // Show all users
    $stmt = $pdo->query("SELECT id, username, email, LENGTH(password) as pwd_len FROM admin_users ORDER BY id");
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
    <title>Fix Password Hash</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-lg p-8 max-w-2xl w-full">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Fix Password Hash</h1>
        
        <div class="mb-6 p-4 rounded-lg <?php echo $success ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
            <?php echo nl2br($message); ?>
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
                            <p><strong>Password Hash Length:</strong> <?php echo htmlspecialchars($user['pwd_len']); ?> (should be 60)</p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
        
        <div class="bg-yellow-100 border border-yellow-300 text-yellow-800 p-4 rounded-lg mb-6">
            <p class="font-semibold mb-2">⚠️ Security Notice:</p>
            <p class="text-sm">After verifying login works, please DELETE this file for security!</p>
        </div>
        
        <div class="flex space-x-4">
            <a href="admin/login.php" class="block text-center bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                Test Login
            </a>
            <a href="debug-login.php" class="block text-center bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700">
                Debug Login
            </a>
        </div>
    </div>
</body>
</html>

