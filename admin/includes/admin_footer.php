            </main>
        </div>
    </div>

    <!-- Mobile Sidebar Overlay -->
    <div id="mobileSidebarOverlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden" onclick="toggleMobileSidebar()"></div>
    
    <!-- Mobile Sidebar -->
    <aside id="mobileSidebar" class="fixed left-0 top-0 bottom-0 w-64 bg-gradient-to-b from-blue-600 to-indigo-700 text-white transform -translate-x-full transition-transform duration-300 z-50 md:hidden overflow-y-auto">
        <div class="p-6">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-xl"></i>
                    </div>
                    <div>
                        <h2 class="font-bold">Admin Panel</h2>
                        <p class="text-xs text-blue-200">Anthem School</p>
                    </div>
                </div>
                <button onclick="toggleMobileSidebar()" class="text-white">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <nav class="space-y-1">
                <a href="dashboard.php" class="sidebar-link flex items-center px-4 py-3 rounded">
                    <i class="fas fa-home w-6"></i>
                    <span>Dashboard</span>
                </a>
                <a href="toppers.php" class="sidebar-link flex items-center px-4 py-3 rounded">
                    <i class="fas fa-trophy w-6"></i>
                    <span>Toppers</span>
                </a>
                <a href="staff.php" class="sidebar-link flex items-center px-4 py-3 rounded">
                    <i class="fas fa-user-tie w-6"></i>
                    <span>Staff</span>
                </a>
                <a href="gallery.php" class="sidebar-link flex items-center px-4 py-3 rounded">
                    <i class="fas fa-images w-6"></i>
                    <span>Gallery</span>
                </a>
                <a href="announcements.php" class="sidebar-link flex items-center px-4 py-3 rounded">
                    <i class="fas fa-bullhorn w-6"></i>
                    <span>Announcements</span>
                </a>
                <a href="events.php" class="sidebar-link flex items-center px-4 py-3 rounded">
                    <i class="fas fa-calendar-alt w-6"></i>
                    <span>Events</span>
                </a>
                <a href="testimonials.php" class="sidebar-link flex items-center px-4 py-3 rounded">
                    <i class="fas fa-star w-6"></i>
                    <span>Testimonials</span>
                </a>
                <a href="admissions.php" class="sidebar-link flex items-center px-4 py-3 rounded">
                    <i class="fas fa-envelope w-6"></i>
                    <span>Admission Inquiries</span>
                </a>
                <a href="settings.php" class="sidebar-link flex items-center px-4 py-3 rounded">
                    <i class="fas fa-cog w-6"></i>
                    <span>Settings</span>
                </a>
            </nav>
        </div>
    </aside>

    <script>
        function toggleProfileMenu() {
            const menu = document.getElementById('profileMenu');
            menu.classList.toggle('hidden');
        }

        function toggleMobileSidebar() {
            const sidebar = document.getElementById('mobileSidebar');
            const overlay = document.getElementById('mobileSidebarOverlay');
            
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        // Close profile menu when clicking outside
        document.addEventListener('click', function(event) {
            const menu = document.getElementById('profileMenu');
            if (!event.target.closest('button[onclick="toggleProfileMenu()"]') && !menu.classList.contains('hidden')) {
                menu.classList.add('hidden');
            }
        });

        // Success/Error toast
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg text-white z-50 ${type === 'success' ? 'bg-green-500' : 'bg-red-500'}`;
            toast.innerHTML = `<i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} mr-2"></i>${message}`;
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transition = 'opacity 0.3s';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // Confirm delete
        function confirmDelete(message = 'Are you sure you want to delete this item?') {
            return confirm(message);
        }
    </script>
</body>
</html>

