<?php
require_once 'includes/functions.php';

$pageTitle = 'Our Faculty';

// Get filter parameter
$filterDept = $_GET['dept'] ?? null;

// Get all staff
$allStaff = getStaff();
$departments = array_unique(array_column($allStaff, 'department'));
sort($departments);

// Get filtered staff
$staff = getStaff($filterDept);

include 'includes/header.php';
?>

<!-- Page Header -->
<section class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-16">
    <div class="container mx-auto px-4">
        <nav class="text-sm mb-4">
            <a href="index.php" class="hover:text-purple-200">Home</a>
            <span class="mx-2">/</span>
            <span>Faculty</span>
        </nav>
        <h1 class="text-4xl md:text-5xl font-bold">Our Dedicated Faculty</h1>
        <p class="text-xl text-purple-100 mt-4">Meet the passionate educators shaping future leaders</p>
    </div>
</section>

<!-- Filter Section -->
<section class="py-8 bg-white shadow-sm sticky top-16 z-40">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <h2 class="text-xl font-bold text-gray-800">
                <i class="fas fa-filter text-purple-600 mr-2"></i>
                Filter by Department
            </h2>
            <div class="flex flex-wrap gap-2">
                <a href="staff.php" 
                   class="px-4 py-2 rounded-full <?php echo !$filterDept ? 'bg-purple-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300'; ?> transition">
                    All Departments
                </a>
                <?php foreach ($departments as $dept): ?>
                    <a href="staff.php?dept=<?php echo urlencode($dept); ?>" 
                       class="px-4 py-2 rounded-full <?php echo $filterDept == $dept ? 'bg-purple-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300'; ?> transition">
                        <?php echo clean($dept); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- Staff Grid -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <?php if (empty($staff)): ?>
            <div class="text-center py-16">
                <i class="fas fa-user-slash text-gray-400 text-6xl mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-600 mb-2">No Staff Members Found</h3>
                <p class="text-gray-500">Try selecting a different department</p>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                <?php foreach ($staff as $member): ?>
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover-lift">
                    <!-- Photo Section -->
                    <div class="relative h-64 bg-gradient-to-br from-purple-400 to-indigo-500">
                        <?php if ($member['photo']): ?>
                            <img src="uploads/staff/<?php echo clean($member['photo']); ?>" 
                                 alt="<?php echo clean($member['name']); ?>" 
                                 class="w-full h-full object-cover">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center">
                                <i class="fas fa-user-tie text-white text-6xl"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Details Section -->
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-1"><?php echo clean($member['name']); ?></h3>
                        <p class="text-purple-600 font-semibold mb-2"><?php echo clean($member['designation']); ?></p>
                        <p class="text-sm text-gray-600 mb-4">
                            <i class="fas fa-building text-indigo-600 mr-2"></i>
                            <?php echo clean($member['department']); ?>
                        </p>
                        
                        <?php if ($member['qualification']): ?>
                        <div class="mb-3">
                            <p class="text-xs text-gray-500 mb-1">Qualification</p>
                            <p class="text-sm text-gray-700"><?php echo clean($member['qualification']); ?></p>
                        </div>
                        <?php endif; ?>
                        
                        <?php if ($member['experience']): ?>
                        <div class="mb-3">
                            <p class="text-xs text-gray-500 mb-1">Experience</p>
                            <p class="text-sm font-semibold text-gray-700">
                                <i class="fas fa-briefcase text-green-600 mr-1"></i>
                                <?php echo clean($member['experience']); ?>
                            </p>
                        </div>
                        <?php endif; ?>
                        
                        <?php if ($member['specialization']): ?>
                        <div class="bg-purple-50 rounded-lg p-3 mb-3">
                            <p class="text-xs text-purple-600 font-semibold mb-1">Specialization</p>
                            <p class="text-sm text-gray-700"><?php echo clean($member['specialization']); ?></p>
                        </div>
                        <?php endif; ?>
                        
                        <?php if ($member['email'] || $member['phone']): ?>
                        <div class="border-t pt-3 space-y-2">
                            <?php if ($member['email']): ?>
                            <a href="mailto:<?php echo clean($member['email']); ?>" 
                               class="flex items-center text-sm text-gray-600 hover:text-purple-600 transition">
                                <i class="fas fa-envelope mr-2"></i>
                                <?php echo clean($member['email']); ?>
                            </a>
                            <?php endif; ?>
                            
                            <?php if ($member['phone']): ?>
                            <a href="tel:<?php echo clean($member['phone']); ?>" 
                               class="flex items-center text-sm text-gray-600 hover:text-purple-600 transition">
                                <i class="fas fa-phone mr-2"></i>
                                <?php echo clean($member['phone']); ?>
                            </a>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-gradient-to-r from-purple-600 to-indigo-600 text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Join Our Team of Excellence</h2>
        <p class="text-xl text-purple-100 mb-8 max-w-2xl mx-auto">
            We are always looking for passionate educators to join our family
        </p>
        <a href="contact.php" class="inline-flex items-center bg-white text-purple-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition shadow-lg">
            Contact Us <i class="fas fa-arrow-right ml-2"></i>
        </a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

