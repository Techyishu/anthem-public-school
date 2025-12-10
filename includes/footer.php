    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 mt-16">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- About Section -->
                <div>
                    <div class="mb-4">
                        <img src="assets/images/logo.png" alt="<?php echo clean(getSiteSetting('school_name', 'Anthem Public School')); ?>" class="h-16 w-auto object-contain mb-3">
                    </div>
                    <p class="text-sm leading-relaxed">
                        <?php echo clean(getSiteSetting('about_text', 'Committed to excellence in education and holistic development of students.')); ?>
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-white text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="index.php" class="hover:text-blue-400 transition">Home</a></li>
                        <li><a href="about.php" class="hover:text-blue-400 transition">About Us</a></li>
                        <li><a href="toppers.php" class="hover:text-blue-400 transition">Our Toppers</a></li>
                        <li><a href="staff.php" class="hover:text-blue-400 transition">Faculty</a></li>
                        <li><a href="gallery.php" class="hover:text-blue-400 transition">Gallery</a></li>
                        <li><a href="admission.php" class="hover:text-blue-400 transition">Admission</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="text-white text-lg font-semibold mb-4">Contact Us</h3>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt text-blue-400 mt-1 mr-3"></i>
                            <span><?php echo clean(getSiteSetting('school_address', 'Education City, New Delhi')); ?></span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone text-blue-400 mr-3"></i>
                            <a href="tel:<?php echo clean(getSiteSetting('school_phone')); ?>" class="hover:text-blue-400 transition">
                                <?php echo clean(getSiteSetting('school_phone', '+91-9876543210')); ?>
                            </a>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope text-blue-400 mr-3"></i>
                            <a href="mailto:<?php echo clean(getSiteSetting('school_email')); ?>" class="hover:text-blue-400 transition">
                                <?php echo clean(getSiteSetting('school_email', 'info@anthemschool.com')); ?>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Social & Newsletter -->
                <div>
                    <h3 class="text-white text-lg font-semibold mb-4">Connect With Us</h3>
                    <div class="flex space-x-3 mb-4">
                        <?php if (getSiteSetting('facebook_url')): ?>
                            <a href="<?php echo clean(getSiteSetting('facebook_url')); ?>" target="_blank" 
                               class="w-10 h-10 bg-blue-600 hover:bg-blue-700 rounded-full flex items-center justify-center transition">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        <?php endif; ?>
                        <?php if (getSiteSetting('twitter_url')): ?>
                            <a href="<?php echo clean(getSiteSetting('twitter_url')); ?>" target="_blank" 
                               class="w-10 h-10 bg-blue-400 hover:bg-blue-500 rounded-full flex items-center justify-center transition">
                                <i class="fab fa-twitter"></i>
                            </a>
                        <?php endif; ?>
                        <?php if (getSiteSetting('instagram_url')): ?>
                            <a href="<?php echo clean(getSiteSetting('instagram_url')); ?>" target="_blank" 
                               class="w-10 h-10 bg-pink-600 hover:bg-pink-700 rounded-full flex items-center justify-center transition">
                                <i class="fab fa-instagram"></i>
                            </a>
                        <?php endif; ?>
                        <?php if (getSiteSetting('youtube_url')): ?>
                            <a href="<?php echo clean(getSiteSetting('youtube_url')); ?>" target="_blank" 
                               class="w-10 h-10 bg-red-600 hover:bg-red-700 rounded-full flex items-center justify-center transition">
                                <i class="fab fa-youtube"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div>
                        <a href="admin/login.php" class="text-xs text-gray-500 hover:text-blue-400 transition">
                            Admin Login
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm">
                <p>&copy; <?php echo date('Y'); ?> <?php echo clean(getSiteSetting('school_name', 'Anthem Public School')); ?>. All rights reserved.</p>
                <p class="mt-2 text-gray-500">Designed with <i class="fas fa-heart text-red-500"></i> for excellence in education</p>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button onclick="scrollToTop()" id="scrollTopBtn" 
            class="hidden fixed bottom-8 right-8 bg-blue-600 text-white w-12 h-12 rounded-full shadow-lg hover:bg-blue-700 transition z-40">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script>
        // Scroll to top functionality
        window.onscroll = function() {
            const btn = document.getElementById('scrollTopBtn');
            if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
                btn.classList.remove('hidden');
            } else {
                btn.classList.add('hidden');
            }
        };

        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    </script>
</body>
</html>

