<?php
/**
 * Quick Installation Script for PostgreSQL
 * Use this if install.php doesn't work
 */

// Get database credentials from environment variables
$host = getenv('DB_HOST') ?: 'dpg-d4snl9ccjiac739ndr0g-a';
$dbname = getenv('DB_NAME') ?: 'anthem_school_db';
$username = getenv('DB_USER') ?: 'anthem_school_db_user';
$password = getenv('DB_PASS') ?: 'FBtOLsLeGb1e375A13vuQfp0vbrMJthD';
$port = getenv('DB_PORT') ?: '5432';

$errors = [];
$success = false;

// Process installation
if ($_SERVER['REQUEST_METHOD'] === 'POST' || isset($_GET['auto'])) {
    try {
        // Connect to PostgreSQL database
        $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Read and execute PostgreSQL SQL file
        $sqlFile = __DIR__ . '/database_pgsql.sql';
        if (!file_exists($sqlFile)) {
            throw new Exception('database_pgsql.sql file not found!');
        }
        
        $sql = file_get_contents($sqlFile);
        
        // Split by semicolon and execute each statement
        $statements = array_filter(array_map('trim', explode(';', $sql)));
        
        foreach ($statements as $statement) {
            if (!empty($statement) && substr($statement, 0, 2) !== '--') {
                try {
                    $pdo->exec($statement);
                } catch (PDOException $e) {
                    // Ignore "already exists" errors
                    if (strpos($e->getMessage(), 'already exists') === false && 
                        strpos($e->getMessage(), 'duplicate') === false &&
                        strpos($e->getMessage(), 'ON CONFLICT') === false) {
                        // Only show real errors
                        if (strpos($e->getMessage(), 'relation') === false || strpos($e->getMessage(), 'does not exist') === false) {
                            throw $e;
                        }
                    }
                }
            }
        }
        
        $success = true;
        
    } catch (PDOException $e) {
        $errors[] = 'Database Error: ' . $e->getMessage();
    } catch (Exception $e) {
        $errors[] = 'Error: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quick Install - Anthem School</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen py-12 px-4">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-8 text-center">
                <h1 class="text-3xl font-bold mb-2">Quick Database Setup</h1>
                <p class="text-blue-100">PostgreSQL Installation</p>
            </div>
            
            <?php if ($success): ?>
                <div class="p-8">
                    <div class="text-center mb-6">
                        <svg class="w-20 h-20 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 text-center mb-4">Installation Successful!</h2>
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                        <p class="text-green-800 mb-3">Database tables created successfully!</p>
                        <ul class="text-sm text-green-700 space-y-2">
                            <li>✓ All tables created</li>
                            <li>✓ Sample data inserted</li>
                            <li>✓ Default admin account ready</li>
                        </ul>
                    </div>
                    
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                        <h3 class="font-semibold text-blue-900 mb-2">Admin Login Credentials:</h3>
                        <div class="text-sm text-blue-800 space-y-1">
                            <p><strong>Username:</strong> admin</p>
                            <p><strong>Password:</strong> admin123</p>
                            <p class="text-red-600 mt-2">⚠️ Please change the password after first login!</p>
                        </div>
                    </div>
                    
                    <div class="flex gap-4 justify-center">
                        <a href="index.php" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                            Visit Website
                        </a>
                        <a href="admin/login.php" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition">
                            Go to Admin Panel
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <div class="p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Database Setup</h2>
                    
                    <?php if (!empty($errors)): ?>
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                            <h3 class="font-semibold text-red-900 mb-2">Errors:</h3>
                            <ul class="text-sm text-red-700 space-y-1">
                                <?php foreach ($errors as $error): ?>
                                    <li>• <?php echo htmlspecialchars($error); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                        <p class="text-sm text-blue-800 mb-2">
                            <strong>Using environment variables:</strong>
                        </p>
                        <ul class="text-xs text-blue-700 space-y-1">
                            <li>Host: <?php echo htmlspecialchars($host); ?></li>
                            <li>Database: <?php echo htmlspecialchars($dbname); ?></li>
                            <li>User: <?php echo htmlspecialchars($username); ?></li>
                            <li>Port: <?php echo htmlspecialchars($port); ?></li>
                        </ul>
                    </div>
                    
                    <form method="POST" action="">
                        <button type="submit" 
                                class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-3 rounded-lg font-semibold hover:from-blue-700 hover:to-indigo-700 transition">
                            Create Database Tables
                        </button>
                    </form>
                    
                    <p class="text-sm text-gray-600 text-center mt-4">
                        Or <a href="?auto=1" class="text-blue-600 hover:underline">click here to auto-install</a>
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

