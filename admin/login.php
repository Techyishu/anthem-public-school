<?php
require_once '../includes/auth.php';

// Redirect if already logged in
if (isLoggedIn()) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        $error = 'Please enter both username and password';
    } else {
        $result = loginAdmin($username, $password);
        
        if ($result['success']) {
            // Redirect to intended page or dashboard
            $redirect = $_SESSION['redirect_after_login'] ?? 'dashboard.php';
            unset($_SESSION['redirect_after_login']);
            header('Location: ' . $redirect);
            exit;
        } else {
            $error = $result['message'];
        }
    }
}

$timeout = isset($_GET['timeout']) ? true : false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Anthem Public School</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center p-4">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>

    <div class="w-full max-w-md relative z-10">
        <!-- Back to Website -->
        <div class="text-center mb-6">
            <a href="../index.php" class="text-white hover:text-gray-200 transition inline-flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Back to Website
            </a>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-8 text-center">
                <img src="../assets/images/logo.png" alt="Anthem School" class="h-20 w-auto object-contain mx-auto mb-4">
                <h1 class="text-2xl font-bold mb-2">Admin Panel</h1>
                <p class="text-blue-100">Anthem Public School</p>
            </div>

            <!-- Form -->
            <div class="p-8">
                <?php if ($timeout): ?>
                    <div class="bg-yellow-100 border border-yellow-300 text-yellow-800 px-4 py-3 rounded-lg mb-6">
                        <i class="fas fa-clock mr-2"></i>
                        Your session has expired. Please login again.
                    </div>
                <?php endif; ?>

                <?php if ($error): ?>
                    <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-lg mb-6">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="" class="space-y-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">
                            <i class="fas fa-user mr-2 text-blue-600"></i>Username or Email
                        </label>
                        <input type="text" 
                               name="username" 
                               required
                               autofocus
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Enter your username">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">
                            <i class="fas fa-lock mr-2 text-blue-600"></i>Password
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   name="password" 
                                   id="password"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="Enter your password">
                            <button type="button" 
                                    onclick="togglePassword()"
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                                <i class="fas fa-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-3 rounded-lg font-semibold hover:from-blue-700 hover:to-indigo-700 transition shadow-lg">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login to Dashboard
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Default credentials: <strong>admin</strong> / <strong>admin123</strong>
                    </p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-6 text-white text-sm">
            <p>&copy; <?php echo date('Y'); ?> Anthem Public School. All rights reserved.</p>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>

