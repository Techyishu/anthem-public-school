<?php
require_once 'includes/functions.php';

$pageTitle = 'Our Toppers';

// Get filter parameters
$filterYear = $_GET['year'] ?? null;

// Get all available years
$allToppers = getToppers();
$years = array_unique(array_column($allToppers, 'year'));
rsort($years);

// Get filtered toppers
$toppers = getToppers($filterYear);

include 'includes/header.php';
?>

<!-- Page Header -->
<section class="bg-gradient-to-r from-yellow-500 to-orange-500 text-white py-8 md:py-16">
    <div class="container mx-auto px-4">
        <nav class="text-xs md:text-sm mb-3 md:mb-4">
            <a href="index.php" class="hover:text-yellow-200">Home</a>
            <span class="mx-2">/</span>
            <span>Toppers</span>
        </nav>
        <h1 class="text-2xl md:text-4xl lg:text-5xl font-bold">Our Pride - Toppers</h1>
        <p class="text-sm md:text-xl text-yellow-100 mt-2 md:mt-4">Celebrating academic excellence</p>
    </div>
</section>

<!-- Filter Section -->
<section class="py-4 md:py-8 bg-white shadow-sm sticky top-16 z-40">
    <div class="container mx-auto px-4">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 md:gap-4">
            <h2 class="text-base md:text-xl font-bold text-gray-800">
                <i class="fas fa-trophy text-yellow-500 mr-2"></i>
                Filter by Year
            </h2>
            <div class="flex flex-wrap gap-2 overflow-x-auto pb-2 sm:pb-0">
                <a href="toppers.php" 
                   class="px-4 py-2 rounded-full <?php echo !$filterYear ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300'; ?> transition">
                    All Years
                </a>
                <?php foreach ($years as $year): ?>
                    <a href="toppers.php?year=<?php echo $year; ?>" 
                       class="px-4 py-2 rounded-full <?php echo $filterYear == $year ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300'; ?> transition">
                        <?php echo $year; ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- Toppers Grid -->
<section class="py-8 md:py-16 bg-gradient-to-br from-blue-50 to-indigo-50">
    <div class="container mx-auto px-4">
        <?php if (empty($toppers)): ?>
            <div class="text-center py-12 md:py-16">
                <i class="fas fa-search text-gray-400 text-4xl md:text-6xl mb-4"></i>
                <h3 class="text-xl md:text-2xl font-bold text-gray-600 mb-2">No Toppers Found</h3>
                <p class="text-sm md:text-base text-gray-500">Try selecting a different year</p>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-8">
                <?php foreach ($toppers as $topper): ?>
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover-lift">
                    <!-- Photo Section -->
                    <div class="relative h-72 bg-gradient-to-br from-yellow-400 via-orange-400 to-red-400">
                        <?php if ($topper['photo']): ?>
                            <img src="uploads/toppers/<?php echo clean($topper['photo']); ?>" 
                                 alt="<?php echo clean($topper['name']); ?>" 
                                 class="w-full h-full object-cover">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center">
                                <i class="fas fa-user-graduate text-white text-7xl"></i>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Trophy Badge -->
                        <div class="absolute top-4 right-4 bg-white text-yellow-600 px-4 py-2 rounded-full shadow-lg">
                            <i class="fas fa-trophy mr-1"></i>
                            <span class="font-bold"><?php echo clean($topper['percentage']); ?>%</span>
                        </div>
                        
                        <!-- Year Badge -->
                        <div class="absolute bottom-4 left-4 bg-black bg-opacity-70 text-white px-4 py-2 rounded-full">
                            <i class="fas fa-calendar mr-1"></i>
                            <?php echo clean($topper['year']); ?>
                        </div>
                    </div>
                    
                    <!-- Details Section -->
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-4"><?php echo clean($topper['name']); ?></h3>
                        
                        <div class="space-y-3 mb-4">
                            <div class="flex items-center text-gray-700">
                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-star text-blue-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Marks Obtained</p>
                                    <p class="font-bold"><?php echo clean($topper['marks']); ?></p>
                                </div>
                            </div>
                            
                            <div class="flex items-center text-gray-700">
                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-graduation-cap text-green-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Class</p>
                                    <p class="font-bold"><?php echo clean($topper['class']); ?></p>
                                </div>
                            </div>
                            
                            <div class="flex items-center text-gray-700">
                                <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-school text-purple-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Board</p>
                                    <p class="font-bold"><?php echo clean($topper['board']); ?></p>
                                </div>
                            </div>
                        </div>
                        
                        <?php if ($topper['achievement']): ?>
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-4 border-l-4 border-blue-600">
                            <p class="text-sm text-gray-600 mb-1"><i class="fas fa-award text-blue-600 mr-2"></i>Achievement</p>
                            <p class="font-semibold text-gray-800"><?php echo clean($topper['achievement']); ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Motivation Section -->
<section class="py-16 bg-gradient-to-r from-blue-600 to-indigo-600 text-white">
    <div class="container mx-auto px-4 text-center">
        <i class="fas fa-quote-left text-5xl text-blue-300 mb-6"></i>
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Success is the Sum of Small Efforts</h2>
        <p class="text-xl text-blue-100 mb-8 max-w-3xl mx-auto">
            Our toppers are the result of dedication, hard work, and excellent guidance from our faculty. 
            They inspire us to maintain our commitment to academic excellence.
        </p>
        <a href="admission.php" class="inline-flex items-center bg-white text-blue-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition shadow-lg">
            Join Our Success Story <i class="fas fa-arrow-right ml-2"></i>
        </a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

