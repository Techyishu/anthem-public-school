<?php
$pageTitle = 'Bus Routes';
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once 'includes/header.php';

// Fetch active bus routes
$stmt = $pdo->prepare("
    SELECT * FROM bus_routes 
    WHERE status = 'active' 
    ORDER BY display_order ASC, route_number ASC
");
$stmt->execute();
$busRoutes = $stmt->fetchAll();
?>

<!-- Page Header -->
<div class="bg-gradient-to-r from-navy-dark via-navy to-blue-800 text-white py-12 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'52\' height=\'26\' viewBox=\'0 0 52 26\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M10 10c0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6h2c0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4v2c-3.314 0-6-2.686-6-6 0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6zm25.464-1.95l8.486 8.486-1.414 1.414-8.486-8.486 1.414-1.414z\' /%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>
    <div class="container mx-auto px-4 relative">
        <div class="max-w-3xl mx-auto text-center">
            <div class="inline-block bg-white bg-opacity-10 backdrop-blur-sm px-6 py-3 rounded-full mb-6 border border-white border-opacity-20">
                <i class="fas fa-bus text-gold mr-2"></i>
                <span class="text-gold font-semibold">Safe & Reliable Transportation</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold mb-4">School Bus Routes</h1>
            <p class="text-lg text-blue-100">
                Comprehensive bus service covering major areas with experienced staff
            </p>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto">
            
            <!-- Info Banner -->
            <div class="bg-gradient-to-r from-blue-50 to-white border-l-4 border-navy rounded-xl p-8 mb-12 shadow-lg">
                <div class="md:flex items-center gap-8">
                    <div class="mb-4 md:mb-0">
                        <div class="inline-block bg-navy text-white p-6 rounded-full">
                            <i class="fas fa-shield-alt text-gold text-4xl"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-navy font-bold text-2xl mb-3">Safe & Secure Transport</h3>
                        <p class="text-gray-700 leading-relaxed">
                            Our school buses are equipped with GPS tracking, CCTV cameras, and first aid kits. 
                            Each bus has an experienced driver and a dedicated conductor to ensure student safety. 
                            All buses undergo regular maintenance and safety checks.
                        </p>
                    </div>
                </div>
            </div>

            <?php if (empty($busRoutes)): ?>
                <!-- No Routes -->
                <div class="text-center py-16">
                    <i class="fas fa-bus text-gray-300 text-6xl mb-6"></i>
                    <h3 class="text-2xl font-bold text-gray-700 mb-3">Bus Routes Information Coming Soon</h3>
                    <p class="text-gray-500">Bus route details will be available here soon.</p>
                </div>
            <?php else: ?>
                <!-- Routes Grid -->
                <div class="grid grid-cols- md:grid-cols-2 gap-8">
                    <?php foreach ($busRoutes as $route): ?>
                        <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden hover-lift">
                            <!-- Route Header -->
                            <div class="bg-gradient-to-r from-navy to-blue-700 text-white p-6">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center">
                                        <div class="bg-gold text-navy font-bold text-2xl px-6 py-3 rounded-lg mr-4 shadow-lg">
                                            <?php echo clean($route['route_number']); ?>
                                        </div>
                                        <div>
                                            <h3 class="text-2xl font-bold"><?php echo clean($route['route_name']); ?></h3>
                                            <p class="text-blue-200 text-sm">Bus: <?php echo clean($route['bus_number']); ?></p>
                                        </div>
                                    </div>
                                    <?php if ($route['monthly_fee']): ?>
                                        <div class="text-right">
                                            <div class="text-gold text-xs font-semibold">Monthly Fee</div>
                                            <div class="text-white text-2xl font-bold">₹<?php echo number_format($route['monthly_fee'], 0); ?></div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Route Details -->
                            <div class="p-6">
                                <!-- Areas Covered -->
                                <div class="mb-6">
                                    <h4 class="font-bold text-gray-800 mb-3 flex items-center">
                                        <i class="fas fa-map-marked-alt text-maroon text-lg mr-3"></i>
                                        Areas Covered
                                    </h4>
                                    <p class="text-gray-700 leading-relaxed">
                                        <?php echo clean($route['areas_covered']); ?>
                                    </p>
                                </div>

                                <!-- Pickup Points -->
                                <div class="bg-blue-50 rounded-lg p-4 mb-6">
                                    <h4 class="font-bold text-gray-800 mb-3 flex items-center">
                                        <i class="fas fa-map-pin text-navy text-lg mr-3"></i>
                                        Pickup Points
                                    </h4>
                                    <p class="text-gray-700 text-sm leading-relaxed">
                                        <?php echo clean($route['pickup_points']); ?>
                                    </p>
                                </div>

                                <!-- Timings -->
                                <div class="grid grid-cols-2 gap-4 mb-6">
                                    <?php if ($route['timing_morning']): ?>
                                        <div class="bg-gradient-to-br from-yellow-50 to-orange-50 border border-yellow-200 rounded-lg p-4">
                                            <div class="flex items-center mb-2">
                                                <i class="fas fa-sun text-orange-500 mr-2"></i>
                                                <span class="font-bold text-gray-800 text-sm">Morning</span>
                                            </div>
                                            <p class="text-gray-700 font-semibold"><?php echo clean($route['timing_morning']); ?></p>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if ($route['timing_afternoon']): ?>
                                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-200 rounded-lg p-4">
                                            <div class="flex items-center mb-2">
                                                <i class="fas fa-moon text-indigo-500 mr-2"></i>
                                                <span class="font-bold text-gray-800 text-sm">Afternoon</span>
                                            </div>
                                            <p class="text-gray-700 font-semibold"><?php echo clean($route['timing_afternoon']); ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Staff Details -->
                                <div class="border-t border-gray-200 pt-4">
                                    <h4 class="font-bold text-gray-800 mb-3 text-sm">Transport Staff</h4>
                                    <div class="grid grid-cols-2 gap-4">
                                        <?php if ($route['driver_name']): ?>
                                            <div class="bg-gray-50 rounded-lg p-3">
                                                <div class="flex items-center mb-2">
                                                    <i class="fas fa-id-card text-navy mr-2 text-sm"></i>
                                                    <span class="text-gray-600 text-xs font-semibold">Driver</span>
                                                </div>
                                                <p class="font-bold text-gray-800 text-sm"><?php echo clean($route['driver_name']); ?></p>
                                                <?php if ($route['driver_contact']): ?>
                                                    <a href="tel:<?php echo clean($route['driver_contact']); ?>" 
                                                       class="text-navy text-xs hover:underline flex items-center mt-1">
                                                        <i class="fas fa-phone text-xs mr-1"></i>
                                                        <?php echo clean($route['driver_contact']); ?>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($route['conductor_name']): ?>
                                            <div class="bg-gray-50 rounded-lg p-3">
                                                <div class="flex items-center mb-2">
                                                    <i class="fas fa-user text-maroon mr-2 text-sm"></i>
                                                    <span class="text-gray-600 text-xs font-semibold">Conductor</span>
                                                </div>
                                                <p class="font-bold text-gray-800 text-sm"><?php echo clean($route['conductor_name']); ?></p>
                                                <?php if ($route['conductor_contact']): ?>
                                                    <a href="tel:<?php echo clean($route['conductor_contact']); ?>" 
                                                       class="text-maroon text-xs hover:underline flex items-center mt-1">
                                                        <i class="fas fa-phone text-xs mr-1"></i>
                                                        <?php echo clean($route['conductor_contact']); ?>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Capacity -->
                                <?php if ($route['capacity']): ?>
                                    <div class="mt-4 text-center bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-lg p-3">
                                        <i class="fas fa-users text-green-600 mr-2"></i>
                                        <span class="text-gray-700 text-sm">
                                            <span class="font-bold text-green-700">Capacity:</span> 
                                            <?php echo clean($route['capacity']); ?> Students
                                        </span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Important Note -->
                <div class="mt-12 bg-yellow-50 border-l-4 border-yellow-500 rounded-lg p-6 shadow-md">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-triangle text-yellow-600 text-2xl mt-1 mr-4"></i>
                        <div>
                            <h3 class="text-yellow-900 font-bold text-lg mb-2">Important Information</h3>
                            <ul class="text-gray-700 space-y-2 text-sm list-disc list-inside">
                                <li>Bus timings may vary slightly depending on traffic conditions</li>
                                <li>Students must reach pickup points 5 minutes before scheduled time</li>
                                <li>Bus fees are to be paid quarterly in advance</li>
                                <li>GPS tracking details will be shared with registered parents</li>
                                <li>For route changes or new registrations, please contact the transport office</li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Contact Section -->
            <div class="mt-12 bg-gradient-to-r from-navy-dark via-navy to-blue-800 rounded-2xl shadow-2xl p-8 md:p-12 text-white">
                <div class="md:flex items-center justify-between gap-8">
                    <div class="mb-6 md:mb-0 flex-1">
                        <h3 class="text-3xl font-bold mb-4 flex items-center">
                            <i class="fas fa-headset text-gold mr-3"></i>
                            Need Transportation Assistance?
                        </h3>
                        <p class="text-blue-100 leading-relaxed">
                            For bus route inquiries, new registrations, or any transport-related questions, 
                            please contact our transport coordinator.
                        </p>
                        <div class="mt-6 space-y-3">
                            <a href="tel:9896421785" class="flex items-center text-white hover:text-gold transition">
                                <i class="fas fa-phone-alt mr-3"></i>
                                <span class="font-semibold">9896421785 / 8950081785</span>
                            </a>
                            <a href="mailto:anthemschool55@gmail.com" class="flex items-center text-white hover:text-gold transition">
                                <i class="fas fa-envelope mr-3"></i>
                                <span class="font-semibold">anthemschool55@gmail.com</span>
                            </a>
                        </div>
                    </div>
                    <a href="contact.php" 
                       class="inline-block bg-gold text-navy px-8 py-4 rounded-full hover:bg-yellow-400 transition font-bold shadow-xl hover:shadow-2xl whitespace-nowrap">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
