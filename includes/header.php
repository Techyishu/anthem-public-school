<?php
if (!isset($pageTitle)) {
    $pageTitle = 'Welcome';
}
$schoolName = getSiteSetting('school_name', 'Anthem Public School');
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo clean($pageTitle); ?> - <?php echo clean($schoolName); ?></title>
    <meta name="description" content="<?php echo clean(getSiteSetting('about_text', 'Anthem Public School - Excellence in Education')); ?>">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 50%, #6366f1 100%);
        }
        .gradient-text {
            background: linear-gradient(135deg, #1e40af 0%, #6366f1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Top Bar -->
    <div class="bg-blue-900 text-white py-2 hidden md:block">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center text-sm">
                <div class="flex items-center space-x-6">
                    <a href="tel:<?php echo clean(getSiteSetting('school_phone')); ?>" class="hover:text-blue-200 transition">
                        <i class="fas fa-phone mr-2"></i><?php echo clean(getSiteSetting('school_phone', '+91-9876543210')); ?>
                    </a>
                    <a href="mailto:<?php echo clean(getSiteSetting('school_email')); ?>" class="hover:text-blue-200 transition">
                        <i class="fas fa-envelope mr-2"></i><?php echo clean(getSiteSetting('school_email', 'info@anthemschool.com')); ?>
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <?php if (getSiteSetting('facebook_url')): ?>
                        <a href="<?php echo clean(getSiteSetting('facebook_url')); ?>" target="_blank" class="hover:text-blue-200 transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    <?php endif; ?>
                    <?php if (getSiteSetting('twitter_url')): ?>
                        <a href="<?php echo clean(getSiteSetting('twitter_url')); ?>" target="_blank" class="hover:text-blue-200 transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                    <?php endif; ?>
                    <?php if (getSiteSetting('instagram_url')): ?>
                        <a href="<?php echo clean(getSiteSetting('instagram_url')); ?>" target="_blank" class="hover:text-blue-200 transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                    <?php endif; ?>
                    <?php if (getSiteSetting('youtube_url')): ?>
                        <a href="<?php echo clean(getSiteSetting('youtube_url')); ?>" target="_blank" class="hover:text-blue-200 transition">
                            <i class="fab fa-youtube"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <a href="index.php" class="flex items-center">
                    <img src="assets/images/logo.png" alt="<?php echo clean($schoolName); ?>" class="h-12 md:h-16 w-auto object-contain">
                </a>

                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="index.php" class="<?php echo $currentPage === 'index.php' ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-blue-600'; ?> transition">
                        Home
                    </a>
                    <a href="about.php" class="<?php echo $currentPage === 'about.php' ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-blue-600'; ?> transition">
                        About
                    </a>
                    <a href="toppers.php" class="<?php echo $currentPage === 'toppers.php' ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-blue-600'; ?> transition">
                        Toppers
                    </a>
                    <a href="staff.php" class="<?php echo $currentPage === 'staff.php' ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-blue-600'; ?> transition">
                        Staff
                    </a>
                    <a href="gallery.php" class="<?php echo $currentPage === 'gallery.php' ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-blue-600'; ?> transition">
                        Gallery
                    </a>
                    <a href="contact.php" class="<?php echo $currentPage === 'contact.php' ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-blue-600'; ?> transition">
                        Contact
                    </a>
                    
                    <!-- Search Icon -->
                    <button onclick="toggleSearch()" class="text-gray-700 hover:text-blue-600 transition">
                        <i class="fas fa-search"></i>
                    </button>
                    
                    <!-- Admission Button -->
                    <a href="admission.php" class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-2 rounded-full hover:from-blue-700 hover:to-indigo-700 transition">
                        Admission
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button onclick="toggleMobileMenu()" class="lg:hidden text-gray-700 hover:text-blue-600">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobileMenu" class="hidden lg:hidden pb-4">
                <div class="flex flex-col space-y-3">
                    <a href="index.php" class="<?php echo $currentPage === 'index.php' ? 'text-blue-600 font-semibold' : 'text-gray-700'; ?> py-2">Home</a>
                    <a href="about.php" class="<?php echo $currentPage === 'about.php' ? 'text-blue-600 font-semibold' : 'text-gray-700'; ?> py-2">About</a>
                    <a href="toppers.php" class="<?php echo $currentPage === 'toppers.php' ? 'text-blue-600 font-semibold' : 'text-gray-700'; ?> py-2">Toppers</a>
                    <a href="staff.php" class="<?php echo $currentPage === 'staff.php' ? 'text-blue-600 font-semibold' : 'text-gray-700'; ?> py-2">Staff</a>
                    <a href="gallery.php" class="<?php echo $currentPage === 'gallery.php' ? 'text-blue-600 font-semibold' : 'text-gray-700'; ?> py-2">Gallery</a>
                    <a href="contact.php" class="<?php echo $currentPage === 'contact.php' ? 'text-blue-600 font-semibold' : 'text-gray-700'; ?> py-2">Contact</a>
                    <a href="admission.php" class="bg-blue-600 text-white px-6 py-2 rounded-full inline-block text-center">Admission</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Search Modal -->
    <div id="searchModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-start justify-center pt-20">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl mx-4">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Search</h3>
                    <button onclick="toggleSearch()" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <input type="text" 
                       id="searchInput" 
                       placeholder="Search for toppers, staff, announcements..."
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       onkeyup="performSearch()">
                <div id="searchResults" class="mt-4 max-h-96 overflow-y-auto"></div>
            </div>
        </div>
    </div>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }

        function toggleSearch() {
            const modal = document.getElementById('searchModal');
            const input = document.getElementById('searchInput');
            modal.classList.toggle('hidden');
            if (!modal.classList.contains('hidden')) {
                input.focus();
            } else {
                input.value = '';
                document.getElementById('searchResults').innerHTML = '';
            }
        }

        let searchTimeout;
        function performSearch() {
            clearTimeout(searchTimeout);
            const query = document.getElementById('searchInput').value;
            
            if (query.length < 2) {
                document.getElementById('searchResults').innerHTML = '';
                return;
            }
            
            searchTimeout = setTimeout(() => {
                fetch('search.php?q=' + encodeURIComponent(query))
                    .then(response => response.json())
                    .then(data => {
                        displaySearchResults(data);
                    })
                    .catch(error => {
                        console.error('Search error:', error);
                    });
            }, 300);
        }

        function displaySearchResults(results) {
            const container = document.getElementById('searchResults');
            
            if (results.length === 0) {
                container.innerHTML = '<p class="text-gray-500 text-center py-4">No results found</p>';
                return;
            }
            
            let html = '<div class="space-y-2">';
            results.forEach(result => {
                const icon = result.type === 'topper' ? 'fa-trophy' : 
                           result.type === 'staff' ? 'fa-user-tie' : 'fa-bullhorn';
                const link = result.type === 'topper' ? 'toppers.php' :
                           result.type === 'staff' ? 'staff.php' : 'index.php#announcements';
                
                html += `
                    <a href="${link}" class="block p-3 hover:bg-gray-50 rounded-lg transition">
                        <div class="flex items-start">
                            <i class="fas ${icon} text-blue-600 mt-1 mr-3"></i>
                            <div>
                                <h4 class="font-semibold text-gray-800">${result.title}</h4>
                                <p class="text-sm text-gray-600">${result.description}</p>
                            </div>
                        </div>
                    </a>
                `;
            });
            html += '</div>';
            
            container.innerHTML = html;
        }

        // Close search on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const modal = document.getElementById('searchModal');
                if (!modal.classList.contains('hidden')) {
                    toggleSearch();
                }
            }
        });
    </script>

