<?php
$pageTitle = 'Sports';
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once 'includes/header.php';

// Fetch active sports
$stmt = $pdo->prepare("
    SELECT * FROM sports 
    WHERE status = 'active' 
    ORDER BY display_order ASC, created_at DESC
");
$stmt->execute();
$sports = $stmt->fetchAll();

// Group sports by category
$sportsByCategory = [];
foreach ($sports as $sport) {
    $sportsByCategory[$sport['category']][] = $sport;
}

$categoryIcons = [
    'outdoor' => 'fa-running',
    'indoor' => 'fa-table-tennis',
    'athletic' => 'fa-medal',
    'water' => 'fa-swimming-pool',
    'other' => 'fa-trophy'
];

$categoryLabels = [
    'outdoor' => 'Outdoor Sports',
    'indoor' => 'Indoor Sports',
    'athletic' => 'Athletics',
    'water' => 'Water Sports',
    'other' => 'Other Sports'
];
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
                <i class="fas fa-running text-yellow-400 mr-2"></i>
                <span class="text-yellow-400 font-semibold">Excellence in Sports</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold mb-4 text-white">Sports & Athletics</h1>
            <p class="text-lg text-blue-100">
                Nurturing champions through comprehensive sports programs and world-class facilities
            </p>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto">

            <!-- Sports Philosophy -->
            <div class="mb-16">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden md:flex">
                    <div class="md:w-1/2 relative bg-gray-200 min-h-[300px]">
                        <img src="assets/images/sports-hero.jpg" alt="Anthem School Sports"
                            class="absolute inset-0 w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-900 to-transparent opacity-60"></div>
                        <div class="absolute bottom-8 left-8 text-white">
                            <h3 class="text-3xl font-bold mb-2">Building Character</h3>
                            <p class="text-blue-100">Through discipline and teamwork</p>
                        </div>
                    </div>
                    <div class="md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
                        <div
                            class="inline-block bg-blue-100 text-blue-900 px-4 py-2 rounded-full text-sm font-bold mb-6 self-start">
                            Our Philosophy
                        </div>
                        <h2 class="text-3xl font-bold text-gray-800 mb-6">More Than Just a Game</h2>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            At Anthem International School, we believe that sports are integral to holistic education.
                            Our sports curriculum is designed to instill values of discipline, leadership, teamwork, and
                            resilience. We provide professional coaching and state-of-the-art infrastructure to help
                            every student discover their potential.
                        </p>
                        <div class="grid grid-cols-3 gap-6 text-center">
                            <div class="bg-blue-50 p-4 rounded-xl">
                                <div class="text-3xl font-bold text-blue-900 mb-1">15+</div>
                                <div class="text-xs text-gray-600 uppercase font-semibold">Sports</div>
                            </div>
                            <div class="bg-blue-50 p-4 rounded-xl">
                                <div class="text-3xl font-bold text-blue-900 mb-1">50+</div>
                                <div class="text-xs text-gray-600 uppercase font-semibold">Awards</div>
                            </div>
                            <div class="bg-blue-50 p-4 rounded-xl">
                                <div class="text-3xl font-bold text-blue-900 mb-1">10+</div>
                                <div class="text-xs text-gray-600 uppercase font-semibold">Coaches</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (empty($sports)): ?>
                <!-- No Sports Data -->
                <div class="text-center py-16">
                    <i class="fas fa-trophy text-gray-300 text-6xl mb-6"></i>
                    <h3 class="text-2xl font-bold text-gray-700 mb-3">Sports Information Coming Soon</h3>
                    <p class="text-gray-500">Details about our sports programs will be updated shortly.</p>
                </div>
            <?php else: ?>
                <!-- Sports Categories -->
                <?php foreach ($sportsByCategory as $category => $categoryPorts): ?>
                    <div class="mb-16 last:mb-0">
                        <!-- Category Header -->
                        <div class="flex items-center mb-8">
                            <div
                                class="inline-block bg-gradient-to-br from-blue-900 to-blue-700 text-white p-12 rounded-full shadow-2xl">
                                <span
                                    class="text-blue-900 text-xl font-bold px-4 py-2 bg-yellow-400 rounded-lg transform -rotate-2 inline-block">
                                    <?php echo clean(ucfirst($category)); ?> Sports
                                </span>
                            </div>
                            <div class="flex-1 border-b-2 border-gray-200 ml-6"></div>
                        </div>

                        <!-- Sports Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            <?php foreach ($categoryPorts as $sport): ?>
                                <div
                                    class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group hover-lift">
                                    <!-- Sport Image/Icon -->
                                    <div class="relative h-48 bg-gradient-to-br from-blue-900 to-blue-700 overflow-hidden">
                                        <?php if ($sport['image']): ?>
                                            <img src="uploads/sports/<?php echo clean($sport['image']); ?>"
                                                alt="<?php echo clean($sport['name']); ?>"
                                                class="w-full h-full object-cover opacity-90 group-hover:scale-110 transition duration-500">
                                            <div class="absolute inset-0 bg-blue-900 opacity-20 group-hover:opacity-0 transition"></div>
                                        <?php else: ?>
                                            <div class="absolute inset-0 flex items-center justify-center">
                                                <i class="fas fa-medal text-6xl text-white opacity-20"></i>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Sport Name Badge -->
                                        <div
                                            class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black to-transparent p-6 pt-12">
                                            <h3 class="text-2xl font-bold text-white"><?php echo clean($sport['name']); ?></h3>
                                        </div>
                                    </div>

                                    <!-- Content -->
                                    <div class="p-6">
                                        <div class="mb-4">
                                            <p class="text-gray-600 line-clamp-3 text-sm">
                                                <?php echo clean($sport['description']); ?>
                                            </p>
                                        </div>

                                        <!-- Details -->
                                        <div class="space-y-3 mb-6">
                                            <?php if ($sport['coach_name']): ?>
                                                <div class="flex items-center text-sm text-gray-700">
                                                    <i class="fas fa-user-tie text-blue-900 text-lg mr-3 w-5"></i>
                                                    <div>
                                                        <span class="block text-xs text-gray-500 font-semibold uppercase">Head
                                                            Coach</span>
                                                        <span class="font-medium"><?php echo clean($sport['coach_name']); ?></span>
                                                    </div>
                                                </div>
                                            <?php endif; ?>

                                            <?php if ($sport['facilities']): ?>
                                                <div class="flex items-center text-sm text-gray-700">
                                                    <i class="fas fa-building text-blue-900 text-lg mr-3 w-5"></i>
                                                    <div>
                                                        <span
                                                            class="block text-xs text-gray-500 font-semibold uppercase">Facilities</span>
                                                        <span class="font-medium"><?php echo clean($sport['facilities']); ?></span>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Achievement Badge (if valid) -->
                                        <?php if ($sport['achievements']): ?>
                                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 mb-4">
                                                <div class="flex items-start">
                                                    <i class="fas fa-trophy text-yellow-600 mt-1 mr-2"></i>
                                                    <p class="text-xs text-gray-700 italic">
                                                        "<?php echo clean($sport['achievements']); ?>"
                                                    </p>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Schedule Button -->
                                        <button
                                            onclick="document.getElementById('schedule-modal-<?php echo $sport['id']; ?>').showModal()"
                                            class="w-full bg-gray-50 hover:bg-blue-50 text-blue-900 font-semibold py-3 px-4 rounded-lg border border-gray-200 hover:border-blue-200 transition flex items-center justify-center group/btn">
                                            <i class="far fa-clock text-blue-900 mr-2 group-hover/btn:animate-bounce"></i>
                                            View Schedule
                                        </button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <!-- Call to Action -->
            <div
                class="mt-16 bg-gradient-to-r from-blue-900 to-blue-800 rounded-3xl p-8 md:p-12 text-center relative overflow-hidden">
                <div class="absolute inset-0 opacity-10"
                    style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\' fill=\'%23ffffff\' fill-rule=\'evenodd\'/%3E%3C/svg%3E');">
                </div>

                <div class="relative z-10">
                    <div class="inline-block bg-white bg-opacity-10 backdrop-blur-sm p-4 rounded-full mb-6">
                        <i class="fas fa-running text-yellow-400 text-4xl"></i>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold mb-4 text-white">Ready to Join Our Sports Program?</h2>
                    <p class="text-blue-100 text-lg mb-8 max-w-2xl mx-auto">
                        Discover your potential and become part of our winning tradition.
                        Excellence in sports starts here!
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="admission.php"
                            class="inline-block bg-yellow-400 text-blue-900 px-8 py-4 rounded-full hover:bg-yellow-300 transition font-bold shadow-xl hover:shadow-2xl">
                            <i class="fas fa-graduation-cap mr-2"></i>
                            Apply for Admission
                        </a>
                        <a href="contact.php"
                            class="inline-block bg-transparent border-2 border-white text-white px-8 py-4 rounded-full hover:bg-white hover:text-blue-900 transition font-bold">
                            <i class="fas fa-phone-alt mr-2"></i>
                            Contact Us
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<?php require_once 'includes/footer.php'; ?>