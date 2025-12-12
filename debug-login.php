<?php
/**
 * Debug Login Issues
 * This script will help diagnose login problems
 */

require_once 'includes/config.php';

header('Content-Type: text/html; charset=utf-8');

$debug = [];

// Test database connection
try {
    $debug[] = "✅ Database connection: OK";
    $debug[] = "Database Type: " . (defined('DB_TYPE') ? DB_TYPE : 'mysql');
} catch (Exception $e) {
    $debug[] = "❌ Database connection: FAILED - " . $e->getMessage();
}

// Check admin_users table
try {
    $stmt = $pdo->query("SELECT id, username, email, LENGTH(password) as pwd_len, SUBSTRING(password, 1, 20) as pwd_start FROM admin_users");
    $users = $stmt->fetchAll();
    
    $debug[] = "<br><strong>Admin Users in Database:</strong>";
    foreach ($users as $user) {
        $debug[] = sprintf(
            "ID: %d | Username: %s | Email: %s | Password Length: %d | Hash Start: %s",
            $user['id'],
            htmlspecialchars($user['username']),
            htmlspecialchars($user['email']),
            $user['pwd_len'],
            htmlspecialchars($user['pwd_start'])
        );
    }
} catch (PDOException $e) {
    $debug[] = "❌ Error querying admin_users: " . $e->getMessage();
}

// Test password verification
if (isset($_POST['test_password'])) {
    $testUsername = trim($_POST['test_username'] ?? '');
    $testPassword = trim($_POST['test_password'] ?? '');
    
    if ($testUsername && $testPassword) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = ? OR email = ?");
            $stmt->execute([$testUsername, $testUsername]);
            $admin = $stmt->fetch();
            
            if ($admin) {
                $debug[] = "<br><strong>Password Verification Test:</strong>";
                $debug[] = "Username found: " . htmlspecialchars($admin['username']);
                $debug[] = "Password hash length: " . strlen($admin['password']);
                $debug[] = "Password hash: " . htmlspecialchars($admin['password']);
                
                $verifyResult = password_verify($testPassword, $admin['password']);
                $debug[] = "password_verify() result: " . ($verifyResult ? "✅ TRUE (Password matches!)" : "❌ FALSE (Password does NOT match)");
                
                // Also test with password_hash to see what a new hash would look like
                $newHash = password_hash($testPassword, PASSWORD_DEFAULT);
                $debug[] = "New hash for this password would be: " . htmlspecialchars($newHash);
                
            } else {
                $debug[] = "❌ Username/Email not found in database";
            }
        } catch (PDOException $e) {
            $debug[] = "❌ Error: " . $e->getMessage();
        }
    }
}

// Test login function
if (isset($_POST['test_login'])) {
    require_once 'includes/auth.php';
    
    $testUsername = trim($_POST['test_username'] ?? '');
    $testPassword = trim($_POST['test_password'] ?? '');
    
    if ($testUsername && $testPassword) {
        $result = loginAdmin($testUsername, $testPassword);
        $debug[] = "<br><strong>Login Function Test:</strong>";
        $debug[] = "Success: " . ($result['success'] ? "✅ YES" : "❌ NO");
        $debug[] = "Message: " . htmlspecialchars($result['message'] ?? 'N/A');
        
        if ($result['success']) {
            $debug[] = "Session variables set:";
            $debug[] = "- admin_logged_in: " . (isset($_SESSION['admin_logged_in']) ? "✅" : "❌");
            $debug[] = "- admin_id: " . ($_SESSION['admin_id'] ?? 'NOT SET');
            $debug[] = "- admin_username: " . ($_SESSION['admin_username'] ?? 'NOT SET');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debug Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-8">
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Login Debug Tool</h1>
        
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
            <p class="text-sm text-blue-800">
                <strong>⚠️ Security Warning:</strong> Delete this file after debugging!
            </p>
        </div>
        
        <!-- Debug Output -->
        <div class="bg-gray-50 rounded-lg p-6 mb-6">
            <h2 class="text-xl font-bold mb-4">Debug Information:</h2>
            <pre class="whitespace-pre-wrap font-mono text-sm"><?php echo implode("\n", $debug); ?></pre>
        </div>
        
        <!-- Test Form -->
        <div class="bg-white border rounded-lg p-6">
            <h2 class="text-xl font-bold mb-4">Test Password Verification</h2>
            <form method="POST" class="space-y-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Username or Email</label>
                    <input type="text" name="test_username" required
                           class="w-full px-4 py-2 border rounded-lg"
                           placeholder="Enter username or email">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Password</label>
                    <input type="password" name="test_password" required
                           class="w-full px-4 py-2 border rounded-lg"
                           placeholder="Enter password">
                </div>
                <div class="flex space-x-4">
                    <button type="submit" name="test_password" value="1"
                            class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                        Test Password Verify
                    </button>
                    <button type="submit" name="test_login" value="1"
                            class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">
                        Test Login Function
                    </button>
                </div>
            </form>
        </div>
        
        <div class="mt-6">
            <a href="admin/login.php" class="text-blue-600 hover:text-blue-800">
                ← Back to Login Page
            </a>
        </div>
    </div>
</body>
</html>

