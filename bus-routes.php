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
<div class="bg-gradient-to-r from-blue-900 via-blue-800 to-blue-900 text-white py-12 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0"
            style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
        </div>
    </div>
    <div class="container mx-auto px-4 relative">
        <div class="max-w-3xl mx-auto text-center">
            <div
                class="inline-block bg-white bg-opacity-10 backdrop-blur-sm px-6 py-3 rounded-full mb-6 border border-white border-opacity-20">
                <i class="fas fa-bus-alt text-yellow-400 mr-2"></i>
                <span class="text-yellow-400 font-semibold">Transport Services</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold mb-4 text-white">Bus Routes & Transport</h1>
            <p class="text-lg text-blue-100">
                Safe, reliable, and comfortable transport facilities covering major routes
            </p>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto">

            <!-- Safety Features -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <div
                    class="bg-white p-8 rounded-2xl shadow-lg border-b-4 border-blue-900 hover:-translate-y-2 transition-transform duration-300">
                    <div
                        class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center text-blue-900 text-3xl mb-6">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Safety First</h3>
                    <p class="text-gray-600">All buses equipped with GPS tracking, CCTV cameras, and first-aid kits.</p>
                </div>
                <div
                    class="bg-white p-8 rounded-2xl shadow-lg border-b-4 border-yellow-400 hover:-translate-y-2 transition-transform duration-300">
                    <div
                        class="w-16 h-16 bg-yellow-50 rounded-full flex items-center justify-center text-yellow-600 text-3xl mb-6">
                        <i class="fas fa-user-clock"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Punctuality</h3>
                    <p class="text-gray-600">Strict adherence to timings with real-time updates for parents.</p>
                </div>
                <div
                    class="bg-white p-8 rounded-2xl shadow-lg border-b-4 border-red-800 hover:-translate-y-2 transition-transform duration-300">
                    <div
                        class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center text-red-800 text-3xl mb-6">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Trained Staff</h3>
                    <p class="text-gray-600">Experienced drivers and female attendants on every bus route.</p>
                </div>
            </div>

            <!-- Route Search -->
            <div
                class="bg-white rounded-xl shadow-md p-6 mb-12 flex flex-col md:flex-row gap-4 items-center justify-between border border-gray-100">
                <div class="flex items-center">
                    <i class="fas fa-map-marked-alt text-blue-900 text-2xl mr-4"></i>
                    <h2 class="text-xl font-bold text-gray-800">Find Your Route</h2>
                </div>
                <div class="relative w-full md:w-96">
                    <input type="text" id="routeSearch" placeholder="Search by area, pickup point, or route no..."
                        class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent bg-gray-50 focus:bg-white transition-all">
                    <i class="fas fa-search absolute left-5 top-3.5 text-gray-400"></i>
                </div>
            </div>

            <!-- Routes Grid -->
            <?php if (empty($busRoutes)): ?>
                <!-- No Routes -->
                <div class="text-center py-16">
                    <i class="fas fa-bus text-gray-300 text-6xl mb-6"></i>
                    <h3 class="text-2xl font-bold text-gray-700 mb-3">No Routes Found</h3>
                    <p class="text-gray-500">Bus route information will be updated shortly.</p>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8" id="routesGrid">
                    <?php foreach ($busRoutes as $route): ?>
                        <div
                            class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 custom-card hover:shadow-xl transition-all duration-300 route-card">
                            <!-- Route Header -->
                            <div class="bg-blue-900 p-6 flex justify-between items-center text-white">
                                <div>
                                    <span
                                        class="bg-yellow-400 text-blue-900 text-xs font-bold px-2 py-1 rounded uppercase tracking-wider mb-1 inline-block">Route
                                        No</span>
                                    <h3 class="text-2xl font-bold"><?php echo clean($route['route_number']); ?></h3>
                                </div>
                                <div class="text-right">
                                    <div class="flex items-center justify-end text-blue-200 text-sm mb-1">
                                        <i class="fas fa-bus mr-2"></i> Vehicle No
                                    </div>
                                    <div class="font-mono font-bold"><?php echo clean($route['bus_number']); ?></div>
                                </div>
                            </div>

                            <!-- Route Details -->
                            <div class="p-6">
                                <div class="mb-6">
                                    <h4 class="text-gray-500 text-sm font-semibold uppercase tracking-wider mb-3">Route Coverage
                                    </h4>
                                    <div class="flex items-start">
                                        <i class="fas fa-map-marker-alt text-red-800 mt-1 mr-3"></i>
                                        <p class="text-gray-800 text-lg font-medium leading-relaxed">
                                            <?php echo clean($route['route_name']); ?>
                                        </p>
                                    </div>
                                    <?php if ($route['areas_covered']): ?>
                                        <p class="text-gray-600 mt-2 text-sm ml-7">
                                            <?php echo clean($route['areas_covered']); ?>
                                        </p>
                                    <?php endif; ?>
                                </div>

                                <!-- Pickup Points -->
                                <div class="bg-gray-50 rounded-xl p-5 mb-6">
                                    <h4 class="text-blue-900 text-sm font-bold uppercase mb-3 flex items-center">
                                        <i class="fas fa-location-arrow mr-2"></i> Major Stops
                                    </h4>
                                    <div class="flex flex-wrap gap-2">
                                        <?php
                                        $stops = explode(',', $route['pickup_points']);
                                        foreach ($stops as $stop):
                                            ?>
                                            <span
                                                class="bg-white border border-gray-200 px-3 py-1 rounded-full text-sm text-gray-700 shadow-sm">
                                                <?php echo clean(trim($stop)); ?>
                                            </span>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <!-- Detailed Info -->
                                <div class="grid grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <div class="text-gray-500 mb-1">Driver Name</div>
                                        <div class="font-semibold text-gray-800 flex items-center">
                                            <i class="fas fa-id-card text-blue-900 mr-2"></i>
                                            <?php echo clean($route['driver_name']); ?>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-gray-500 mb-1">Contact No</div>
                                        <div class="font-semibold text-gray-800 flex items-center">
                                            <i class="fas fa-phone text-blue-900 mr-2"></i>
                                            <?php echo clean($route['driver_contact']); ?>
                                        </div>
                                    </div>
                                    <?php if ($route['conductor_name']): ?>
                                        <div>
                                            <div class="text-gray-500 mb-1">Attendant</div>
                                            <div class="font-semibold text-gray-800 flex items-center">
                                                <i class="fas fa-user-nurse text-blue-900 mr-2"></i>
                                                <?php echo clean($route['conductor_name']); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>


                                    <!-- Capacity -->
                                    <?php if ($route['capacity']): ?>
                                        <div
                                            class="mt-4 text-center bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-lg p-3">
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
                <div
                    class="mt-12 bg-gradient-to-r from-blue-900 via-blue-800 to-blue-900 rounded-2xl shadow-2xl p-8 md:p-12 text-white">
                    <div class="md:flex items-center justify-between gap-8 text-center md:text-left">
                        <div class="mb-6 md:mb-0 flex-1">
                            <h3 class="text-3xl font-bold mb-4 flex items-center justify-center md:justify-start">
                                <i class="fas fa-headset text-yellow-500 mr-3"></i>
                                Need Transportation Assistance?
                            </h3>
                            <p class="text-blue-100 leading-relaxed">
                                For bus route inquiries, new registrations, or any transport-related questions,
                                please contact our transport coordinator.
                            </p>
                            <div class="mt-6 space-y-3 flex flex-col md:items-start items-center">
                                <a href="tel:9896421785"
                                    class="flex items-center text-white hover:text-yellow-400 transition">
                                    <i class="fas fa-phone-alt mr-3"></i>
                                    <span class="font-semibold">9896421785 / 8950081785</span>
                                </a>
                                <a href="mailto:anthemschool55@gmail.com"
                                    class="flex items-center text-white hover:text-yellow-400 transition">
                                    <i class="fas fa-envelope mr-3"></i>
                                    <span class="font-semibold">anthemschool55@gmail.com</span>
                                </a>
                            </div>
                        </div>
                        <a href="contact.php"
                            class="inline-block bg-yellow-400 text-blue-900 px-8 py-4 rounded-full hover:bg-yellow-300 transition font-bold shadow-xl hover:shadow-2xl whitespace-nowrap">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Contact Us
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once 'includes/footer.php'; ?>