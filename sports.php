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
<div class="bg-gradient-to-r from-navy-dark via-navy to-blue-800 text-white py-12 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0"
            style="background-image: url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'100\' height=\'100\' viewBox=\'0 0 100 100\'%3E%3Cg fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath opacity=\'.5\' d=\'M96 95h4v1h-4v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9zm-1 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
        </div>
    </div>
    <div class="container mx-auto px-4 relative">
        <div class="max-w-3xl mx-auto text-center">
            <div
                class="inline-block bg-white bg-opacity-10 backdrop-blur-sm px-6 py-3 rounded-full mb-6 border border-white border-opacity-20">
                <i class="fas fa-trophy text-gold mr-2"></i>
                <span class="text-gold font-semibold">Excellence in Sports</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Sports & Athletics</h1>
            <p class="text-lg text-blue-100">
                Where champions are made and excellence is our tradition
            </p>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto">

            <!-- Sports Philosophy -->
            <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 mb-16 border-t-4 border-gold">
                <div class="md:flex items-center gap-8">
                    <div class="md:w-1/3 mb-6 md:mb-0 text-center">
                        <div
                            class="inline-block bg-gradient-to-br from-navy to-blue-700 text-white p-12 rounded-full shadow-2xl">
                            <i class="fas fa-medal text-gold text-6xl"></i>
                        </div>
                    </div>
                    <div class="md:w-2/3">
                        <h2 class="text-3xl font-bold text-gray-800 mb-4">
                            <span class="text-navy">Building Champions,</span>
                            <span class="text-maroon"> Shaping Lives</span>
                        </h2>
                        <p class="text-gray-700 text-lg leading-relaxed mb-4">
                            At Anthem International School, we believe sports are essential for the overall development
                            of students.
                            Our state-of-the-art facilities and expert coaching staff ensure that every student gets the
                            opportunity
                            to excel in their chosen sport.
                        </p>
                        <div class="grid grid-cols-3 gap-4 mt-6">
                            <div class="text-center p-4 bg-blue-50 rounded-lg">
                                <div class="text-3xl font-bold text-navy mb-1">15+</div>
                                <div class="text-sm text-gray-600">Sports Offered</div>
                            </div>
                            <div class="text-center p-4 bg-red-50 rounded-lg">
                                <div class="text-3xl font-bold text-maroon mb-1">20+</div>
                                <div class="text-sm text-gray-600">Trophies Won</div>
                            </div>
                            <div class="text-center p-4 bg-yellow-50 rounded-lg">
                                <div class="text-3xl font-bold text-gold mb-1">10+</div>
                                <div class="text-sm text-gray-600">Expert Coaches</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (empty($sports)): ?>
                <!-- No Sports -->
                <div class="text-center py-16">
                    <i class="fas fa-trophy text-gray-300 text-6xl mb-6"></i>
                    <h3 class="text-2xl font-bold text-gray-700 mb-3">Sports Information Coming Soon</h3>
                    <p class="text-gray-500">Our sports programs will be listed here soon.</p>
                </div>
            <?php else: ?>
                <!-- Sports by Category -->
                <?php foreach ($sportsByCategory as $category => $categoryPorts): ?>
                    <div class="mb-16 last:mb-0">
                        <!-- Category Header -->
                        <div class="flex items-center mb-8">
                            <div
                                class="bg-gradient-to-r from-maroon to-red-700 text-white px-8 py-4 rounded-lg flex items-center shadow-lg">
                                <i class="fas <?php echo $categoryIcons[$category]; ?> text-gold text-2xl mr-4"></i>
                                <h2 class="text-2xl font-bold"><?php echo clean($categoryLabels[$category]); ?></h2>
                            </div>
                            <div class="flex-1 h-1 bg-gradient-to-r from-red-700 to-transparent ml-4"></div>
                        </div>

                        <!-- Sports Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            <?php foreach ($categoryPorts as $sport): ?>
                                <div
                                    class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group hover-lift">
                                    <!-- Sport Image/Icon -->
                                    <div class="relative h-48 bg-gradient-to-br from-navy to-blue-700 overflow-hidden">
                                        <?php if ($sport['image']): ?>
                                            <img src="uploads/sports/<?php echo clean($sport['image']); ?>"
                                                alt="<?php echo clean($sport['sport_name']); ?>"
                                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                        <?php else: ?>
                                            <div class="absolute inset-0 flex items-center justify-center">
                                                <i
                                                    class="fas <?php echo $categoryIcons[$category]; ?> text-gold text-7xl opacity-50"></i>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Sport Badge -->
                                        <div
                                            class="absolute top-4 right-4 bg-gold text-navy px-4 py-2 rounded-full font-bold text-sm shadow-lg">
                                            <i class="fas fa-star mr-1"></i>
                                            <?php echo strtoupper($category); ?>
                                        </div>
                                    </div>

                                    <!-- Sport Details -->
                                    <div class="p-6">
                                        <h3 class="text-2xl font-bold text-gray-800 mb-3 flex items-center">
                                            <i class="fas fa-award text-gold mr-3"></i>
                                            <?php echo clean($sport['sport_name']); ?>
                                        </h3>

                                        <?php if ($sport['description']): ?>
                                            <p class="text-gray-600 mb-4 line-clamp-3">
                                                <?php echo clean($sport['description']); ?>
                                            </p>
                                        <?php endif; ?>

                                        <!-- Coach Info -->
                                        <?php if ($sport['coach_name']): ?>
                                            <div class="bg-blue-50 rounded-lg p-4 mb-4">
                                                <div class="flex items-center text-sm">
                                                    <i class="fas fa-user-tie text-navy text-lg mr-3"></i>
                                                    <div>
                                                        <div class="text-gray-500 text-xs">Coach</div>
                                                        <div class="font-semibold text-gray-800">
                                                            <?php echo clean($sport['coach_name']); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Facilities -->
                                        <?php if ($sport['facilities']): ?>
                                            <div class="mb-4">
                                                <h4 class="font-bold text-gray-800 mb-2 flex items-center text-sm">
                                                    <i class="fas fa-building text-maroon mr-2"></i>
                                                    Facilities
                                                </h4>
                                                <p class="text-gray-600 text-sm line-clamp-2">
                                                    <?php echo clean($sport['facilities']); ?>
                                                </p>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Achievements -->
                                        <?php if ($sport['achievements']): ?>
                                            <div
                                                class="bg-gradient-to-r from-gold/10 to-transparent border-l-4 border-gold p-4 rounded">
                                                <div class="flex items-start">
                                                    <i class="fas fa-trophy text-gold text-xl mr-3 mt-1"></i>
                                                    <div>
                                                        <h4 class="font-bold text-gray-800 mb-1 text-sm">Recent Achievements</h4>
                                                        <p class="text-gray-700 text-sm">
                                                            <?php echo clean($sport['achievements']); ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Schedule -->
                                        <?php if ($sport['schedule']): ?>
                                            <div class="mt-4 pt-4 border-t border-gray-200">
                                                <div class="flex items-center text-sm text-gray-600">
                                                    <i class="far fa-clock text-navy mr-2"></i>
                                                    <span class="font-medium"><?php echo clean($sport['schedule']); ?></span>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <!-- Call to Action -->
            <div
                class="mt-16 bg-gradient-to-r from-navy-dark via-navy to-blue-800 rounded-2xl shadow-2xl p-12 text-white text-center relative overflow-hidden">
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute inset-0"
                        style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
                    </div>
                </div>
                <div class="relative z-10">
                    <i class="fas fa-running text-gold text-5xl mb-4"></i>
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">Ready to Join Our Sports Program?</h2>
                    <p class="text-blue-100 text-lg mb-8 max-w-2xl mx-auto">
                        Discover your potential and become part of our winning tradition.
                        Excellence in sports starts here!
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="admission.php"
                            class="inline-block bg-gold text-navy px-8 py-4 rounded-full hover:bg-yellow-400 transition font-bold shadow-xl hover:shadow-2xl">
                            <i class="fas fa-graduation-cap mr-2"></i>
                            Apply for Admission
                        </a>
                        <a href="contact.php"
                            class="inline-block bg-white bg-opacity-10 backdrop-blur-sm border-2 border-white text-white px-8 py-4 rounded-full hover:bg-white hover:text-navy transition font-bold">
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