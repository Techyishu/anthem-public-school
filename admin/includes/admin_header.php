<?php
require_once '../includes/auth.php';
require_once '../includes/functions.php';

// Require login for all admin pages
requireLogin();

$admin = getLoggedInAdmin();
$currentPage = basename($_SERVER['PHP_SELF']);

if (!isset($pageTitle)) {
    $pageTitle = 'Dashboard';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo clean($pageTitle); ?> - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .sidebar-link {
            transition: all 0.3s ease;
        }
        .sidebar-link:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }
        .sidebar-link.active {
            background: rgba(255, 255, 255, 0.15);
            border-left: 4px solid #fff;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-blue-600 to-indigo-700 text-white flex-shrink-0 hidden md:block overflow-y-auto">
            <div class="p-6">
                <div class="mb-8">
                    <img src="../assets/images/logo.png" alt="Anthem School" class="h-16 w-auto object-contain mx-auto">
                    <div class="text-center mt-3">
                        <h2 class="font-bold text-lg">Admin Panel</h2>
                    </div>
                </div>

                <nav class="space-y-1">
                    <a href="dashboard.php" class="sidebar-link <?php echo $currentPage === 'dashboard.php' ? 'active' : ''; ?> flex items-center px-4 py-3 rounded">
                        <i class="fas fa-home w-6"></i>
                        <span>Dashboard</span>
                    </a>
                    
                    <a href="toppers.php" class="sidebar-link <?php echo $currentPage === 'toppers.php' || $currentPage === 'add_topper.php' || $currentPage === 'edit_topper.php' ? 'active' : ''; ?> flex items-center px-4 py-3 rounded">
                        <i class="fas fa-trophy w-6"></i>
                        <span>Toppers</span>
                    </a>
                    
                    <a href="staff.php" class="sidebar-link <?php echo $currentPage === 'staff.php' || $currentPage === 'add_staff.php' || $currentPage === 'edit_staff.php' ? 'active' : ''; ?> flex items-center px-4 py-3 rounded">
                        <i class="fas fa-user-tie w-6"></i>
                        <span>Staff</span>
                    </a>
                    
                    <a href="gallery.php" class="sidebar-link <?php echo $currentPage === 'gallery.php' || $currentPage === 'add_gallery.php' ? 'active' : ''; ?> flex items-center px-4 py-3 rounded">
                        <i class="fas fa-images w-6"></i>
                        <span>Gallery</span>
                    </a>
                    
                    <a href="announcements.php" class="sidebar-link <?php echo $currentPage === 'announcements.php' || $currentPage === 'add_announcement.php' || $currentPage === 'edit_announcement.php' ? 'active' : ''; ?> flex items-center px-4 py-3 rounded">
                        <i class="fas fa-bullhorn w-6"></i>
                        <span>Announcements</span>
                    </a>
                    
                    <a href="events.php" class="sidebar-link <?php echo $currentPage === 'events.php' || $currentPage === 'add_event.php' || $currentPage === 'edit_event.php' ? 'active' : ''; ?> flex items-center px-4 py-3 rounded">
                        <i class="fas fa-calendar-alt w-6"></i>
                        <span>Events</span>
                    </a>
                    
                    <a href="testimonials.php" class="sidebar-link <?php echo $currentPage === 'testimonials.php' ? 'active' : ''; ?> flex items-center px-4 py-3 rounded">
                        <i class="fas fa-star w-6"></i>
                        <span>Testimonials</span>
                    </a>
                    
                    <a href="admissions.php" class="sidebar-link <?php echo $currentPage === 'admissions.php' ? 'active' : ''; ?> flex items-center px-4 py-3 rounded">
                        <i class="fas fa-envelope w-6"></i>
                        <span>Admission Inquiries</span>
                    </a>
                    
                    <a href="settings.php" class="sidebar-link <?php echo $currentPage === 'settings.php' ? 'active' : ''; ?> flex items-center px-4 py-3 rounded">
                        <i class="fas fa-cog w-6"></i>
                        <span>Settings</span>
                    </a>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm z-10">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center">
                        <button onclick="toggleMobileSidebar()" class="md:hidden mr-4 text-gray-600 hover:text-gray-800">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h1 class="text-2xl font-bold text-gray-800"><?php echo clean($pageTitle); ?></h1>
                    </div>

                    <div class="flex items-center space-x-4">
                        <a href="../index.php" target="_blank" class="text-gray-600 hover:text-blue-600 transition">
                            <i class="fas fa-external-link-alt mr-2"></i>
                            <span class="hidden sm:inline">View Website</span>
                        </a>
                        
                        <div class="relative">
                            <button onclick="toggleProfileMenu()" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 transition">
                                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white">
                                    <i class="fas fa-user"></i>
                                </div>
                                <span class="hidden sm:inline font-medium"><?php echo clean($admin['username']); ?></span>
                                <i class="fas fa-chevron-down text-sm"></i>
                            </button>
                            
                            <div id="profileMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl py-2 z-50">
                                <a href="settings.php" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-cog mr-2"></i>Settings
                                </a>
                                <a href="logout.php" class="block px-4 py-2 text-red-600 hover:bg-gray-100">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6">

