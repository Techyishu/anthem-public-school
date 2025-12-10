<?php
/**
 * Installation Script for Anthem Public School Website
 * Run this file once to set up the database
 */

// Configuration
$host = 'localhost';
$dbname = 'your_database_name';  // Change this
$username = 'your_username';      // Change this
$password = 'your_password';      // Change this

$errors = [];
$success = false;

// Check if already installed
$lockFile = __DIR__ . '/install.lock';
if (file_exists($lockFile)) {
    die('
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Already Installed</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100 flex items-center justify-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-md">
            <div class="text-red-600 text-center mb-4">
                <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-4">Already Installed</h2>
            <p class="text-gray-600 text-center mb-6">
                The installation has already been completed. To reinstall, please delete the <code class="bg-gray-200 px-2 py-1 rounded">install.lock</code> file.
            </p>
            <div class="text-center">
                <a href="index.php" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 inline-block">Go to Homepage</a>
            </div>
        </div>
    </body>
    </html>
    ');
}

// Process installation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $host = trim($_POST['host'] ?? 'localhost');
    $dbname = trim($_POST['dbname'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    // Validate inputs
    if (empty($dbname)) {
        $errors[] = 'Database name is required';
    }
    if (empty($username)) {
        $errors[] = 'Database username is required';
    }
    
    if (empty($errors)) {
        try {
            // Connect to database
            $dsn = "mysql:host=$host;charset=utf8mb4";
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Create database if not exists
            $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
            $pdo->exec("USE `$dbname`");
            
            // Read and execute SQL file
            $sqlFile = __DIR__ . '/database.sql';
            if (!file_exists($sqlFile)) {
                throw new Exception('database.sql file not found!');
            }
            
            $sql = file_get_contents($sqlFile);
            
            // Split by semicolon and execute each statement
            $statements = array_filter(array_map('trim', explode(';', $sql)));
            
            foreach ($statements as $statement) {
                if (!empty($statement) && substr($statement, 0, 2) !== '--') {
                    $pdo->exec($statement);
                }
            }
            
            // Update config.php with database credentials
            $configContent = "<?php
/**
 * Database Configuration
 */

define('DB_HOST', '$host');
define('DB_NAME', '$dbname');
define('DB_USER', '$username');
define('DB_PASS', '$password');

// Create PDO connection
try {
    \$pdo = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
} catch (PDOException \$e) {
    die('Database connection failed: ' . \$e->getMessage());
}

// Session configuration
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 0); // Set to 1 if using HTTPS

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Site URL
define('SITE_URL', 'http://' . \$_SERVER['HTTP_HOST'] . dirname(\$_SERVER['PHP_SELF']));
";
            
            $configDir = __DIR__ . '/includes';
            if (!file_exists($configDir)) {
                mkdir($configDir, 0755, true);
            }
            
            file_put_contents($configDir . '/config.php', $configContent);
            
            // Create uploads directories
            $uploadDirs = [
                __DIR__ . '/uploads',
                __DIR__ . '/uploads/toppers',
                __DIR__ . '/uploads/staff',
                __DIR__ . '/uploads/gallery',
                __DIR__ . '/uploads/testimonials'
            ];
            
            foreach ($uploadDirs as $dir) {
                if (!file_exists($dir)) {
                    mkdir($dir, 0755, true);
                }
            }
            
            // Create lock file
            file_put_contents($lockFile, date('Y-m-d H:i:s'));
            
            $success = true;
            
        } catch (PDOException $e) {
            $errors[] = 'Database Error: ' . $e->getMessage();
        } catch (Exception $e) {
            $errors[] = 'Error: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Install - Anthem Public School</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen py-12 px-4">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-xl overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-8 text-center">
                <h1 class="text-3xl font-bold mb-2">Anthem Public School</h1>
                <p class="text-blue-100">Website Installation</p>
            </div>
            
            <?php if ($success): ?>
                <!-- Success Message -->
                <div class="p-8">
                    <div class="text-center mb-6">
                        <svg class="w-20 h-20 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 text-center mb-4">Installation Successful!</h2>
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                        <p class="text-green-800 mb-3">Your website has been installed successfully.</p>
                        <ul class="text-sm text-green-700 space-y-2">
                            <li>✓ Database tables created</li>
                            <li>✓ Sample data inserted</li>
                            <li>✓ Configuration file created</li>
                            <li>✓ Upload directories created</li>
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
                <!-- Installation Form -->
                <div class="p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Database Configuration</h2>
                    
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
                    
                    <form method="POST" action="">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Database Host</label>
                                <input type="text" name="host" value="localhost" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       required>
                                <p class="text-sm text-gray-500 mt-1">Usually "localhost" for shared hosting</p>
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Database Name</label>
                                <input type="text" name="dbname" value="" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="anthem_school_db"
                                       required>
                                <p class="text-sm text-gray-500 mt-1">Your database name from cPanel</p>
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Database Username</label>
                                <input type="text" name="username" value="" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="db_username"
                                       required>
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Database Password</label>
                                <input type="password" name="password" value="" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="••••••••">
                            </div>
                            
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                <p class="text-sm text-yellow-800">
                                    <strong>Note:</strong> Make sure you have created the database in your hosting control panel (cPanel/Plesk) before running this installation.
                                </p>
                            </div>
                            
                            <button type="submit" 
                                    class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-3 rounded-lg font-semibold hover:from-blue-700 hover:to-indigo-700 transition">
                                Install Now
                            </button>
                        </div>
                    </form>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="text-center mt-6 text-gray-600 text-sm">
            <p>Anthem Public School © <?php echo date('Y'); ?></p>
        </div>
    </div>
</body>
</html>

