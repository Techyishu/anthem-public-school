<?php
require_once 'includes/functions.php';

$pageTitle = 'Home';

// Fetch data for homepage
$settings = getAllSettings();
$toppers = getToppers(null, 6);
$announcements = getAnnouncements(3);
$events = getEvents(3);
$testimonials = getTestimonials(true, 3);
$galleryImages = getGalleryImages(null, 8);

include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-blue-900 via-blue-800 to-indigo-900 text-white overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>
    
    <div class="container mx-auto px-4 py-12 md:py-24 lg:py-32 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
            <div class="space-y-4 md:space-y-6 text-center lg:text-left">
                <h1 class="text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold leading-tight">
                    Welcome to <br>
                    <span class="text-yellow-400"><?php echo clean($settings['school_name'] ?? 'Anthem Public School'); ?></span>
                </h1>
                <p class="text-base md:text-lg lg:text-xl text-blue-100 leading-relaxed">
                    <?php echo clean($settings['principal_message'] ?? 'Nurturing young minds to become future leaders through excellence in education and holistic development.'); ?>
                </p>
                <div class="flex flex-col sm:flex-row gap-3 md:gap-4 pt-4 justify-center lg:justify-start">
                    <a href="admission.php" class="bg-yellow-500 hover:bg-yellow-600 text-blue-900 font-semibold px-6 md:px-8 py-3 rounded-full transition transform hover:scale-105 shadow-lg text-center">
                        Apply Now
                    </a>
                    <a href="about.php" class="bg-white bg-opacity-20 hover:bg-opacity-30 backdrop-blur text-white font-semibold px-6 md:px-8 py-3 rounded-full transition border border-white border-opacity-30 text-center">
                        Learn More
                    </a>
                </div>
            </div>
            
            <div class="hidden lg:block">
                <div class="relative">
                    <div class="absolute -top-4 -left-4 w-72 h-72 bg-blue-500 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-float"></div>
                    <div class="absolute -bottom-4 -right-4 w-72 h-72 bg-indigo-500 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-float" style="animation-delay: 1s;"></div>
                    <div class="relative bg-white bg-opacity-10 backdrop-blur-lg rounded-3xl p-8 border border-white border-opacity-20">
                        <img src="assets/images/hero-education.svg" alt="Education" class="w-full" onerror="this.style.display='none'">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <i class="fas fa-graduation-cap text-white text-9xl opacity-20"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="#F9FAFB"/>
        </svg>
    </div>
</section>

<!-- Stats Section -->
<section class="py-8 md:py-16 -mt-8 md:-mt-16 relative z-10">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-6">
            <div class="bg-white rounded-xl md:rounded-2xl shadow-xl p-4 md:p-6 text-center hover-lift">
                <div class="text-2xl md:text-4xl font-bold gradient-text mb-1 md:mb-2"><?php echo clean($settings['students_count'] ?? '2500'); ?>+</div>
                <div class="text-gray-600 font-medium text-xs md:text-base">Students</div>
            </div>
            <div class="bg-white rounded-xl md:rounded-2xl shadow-xl p-4 md:p-6 text-center hover-lift">
                <div class="text-2xl md:text-4xl font-bold gradient-text mb-1 md:mb-2"><?php echo clean($settings['faculty_count'] ?? '150'); ?>+</div>
                <div class="text-gray-600 font-medium text-xs md:text-base">Faculty</div>
            </div>
            <div class="bg-white rounded-xl md:rounded-2xl shadow-xl p-4 md:p-6 text-center hover-lift">
                <div class="text-2xl md:text-4xl font-bold gradient-text mb-1 md:mb-2"><?php echo clean($settings['years_established'] ?? '25'); ?>+</div>
                <div class="text-gray-600 font-medium text-xs md:text-base">Years</div>
            </div>
            <div class="bg-white rounded-xl md:rounded-2xl shadow-xl p-4 md:p-6 text-center hover-lift">
                <div class="text-2xl md:text-4xl font-bold gradient-text mb-1 md:mb-2"><?php echo clean($settings['awards_count'] ?? '50'); ?>+</div>
                <div class="text-gray-600 font-medium text-xs md:text-base">Awards</div>
            </div>
        </div>
    </div>
</section>

<!-- About Preview Section -->
<section class="py-8 md:py-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
            <div class="relative order-2 lg:order-1">
                <div class="grid grid-cols-2 gap-2 md:gap-4">
                    <img src="assets/images/logo.jpg" alt="School Leadership" class="rounded-lg md:rounded-xl shadow-lg w-full h-32 md:h-48 object-cover">
                    <img src="assets/images/about-school.jpg" alt="School Staff" class="rounded-lg md:rounded-xl shadow-lg w-full h-32 md:h-48 object-cover">
                    <img src="assets/images/school-building.jpg" alt="School Event" class="rounded-lg md:rounded-xl shadow-lg w-full h-32 md:h-48 object-cover col-span-2">
                </div>
                <div class="absolute -bottom-4 md:-bottom-6 -right-4 md:-right-6 bg-gradient-to-br from-blue-600 to-indigo-600 text-white p-4 md:p-6 rounded-xl md:rounded-2xl shadow-xl">
                    <div class="text-2xl md:text-3xl font-bold"><?php echo clean($settings['years_established'] ?? '25'); ?>+</div>
                    <div class="text-xs md:text-sm">Years of Legacy</div>
                </div>
            </div>
            
            <div class="space-y-4 md:space-y-6 order-1 lg:order-2">
                <div class="inline-block bg-blue-100 text-blue-600 px-3 md:px-4 py-1.5 md:py-2 rounded-full text-xs md:text-sm font-semibold">
                    About Our School
                </div>
                <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-800 leading-tight">
                    Building Tomorrow's Leaders <span class="gradient-text">Today</span>
                </h2>
                <p class="text-gray-600 leading-relaxed text-lg">
                    <?php echo clean($settings['about_text'] ?? 'Anthem Public School is a premier educational institution dedicated to providing quality education and holistic development of students. We believe in nurturing young minds to become responsible citizens and future leaders.'); ?>
                </p>
                <div class="space-y-3">
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-check text-green-600 text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Quality Education</h4>
                            <p class="text-gray-600 text-sm">Comprehensive curriculum following CBSE guidelines</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-check text-green-600 text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Experienced Faculty</h4>
                            <p class="text-gray-600 text-sm">Dedicated teachers with years of expertise</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-check text-green-600 text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Modern Infrastructure</h4>
                            <p class="text-gray-600 text-sm">State-of-the-art facilities for overall development</p>
                        </div>
                    </div>
                </div>
                <a href="about.php" class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-700 transition">
                    Read More <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Toppers Section -->
<?php if (!empty($toppers)): ?>
<section class="py-8 md:py-16 bg-gradient-to-br from-blue-50 to-indigo-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-8 md:mb-12">
            <div class="inline-block bg-yellow-100 text-yellow-700 px-3 md:px-4 py-1.5 md:py-2 rounded-full text-xs md:text-sm font-semibold mb-3 md:mb-4">
                Our Pride
            </div>
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-800 mb-3 md:mb-4 px-4">
                Meet Our <span class="gradient-text">Toppers</span>
            </h2>
            <p class="text-sm md:text-base text-gray-600 max-w-2xl mx-auto px-4">
                Celebrating the outstanding achievements of our brilliant students
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-8">
            <?php foreach ($toppers as $topper): ?>
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover-lift">
                <div class="relative h-64 bg-gradient-to-br from-blue-400 to-indigo-500">
                    <?php if ($topper['photo']): ?>
                        <img src="uploads/toppers/<?php echo clean($topper['photo']); ?>" 
                             alt="<?php echo clean($topper['name']); ?>" 
                             class="w-full h-full object-cover">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center">
                            <i class="fas fa-user-graduate text-white text-6xl"></i>
                        </div>
                    <?php endif; ?>
                    <div class="absolute top-4 right-4 bg-yellow-400 text-blue-900 px-3 py-1 rounded-full text-sm font-bold">
                        <i class="fas fa-trophy mr-1"></i> <?php echo clean($topper['percentage']); ?>%
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2"><?php echo clean($topper['name']); ?></h3>
                    <div class="space-y-2 text-sm text-gray-600">
                        <p><i class="fas fa-star text-yellow-500 mr-2"></i><strong><?php echo clean($topper['marks']); ?></strong></p>
                        <p><i class="fas fa-graduation-cap text-blue-500 mr-2"></i><?php echo clean($topper['class']); ?></p>
                        <p><i class="fas fa-calendar text-green-500 mr-2"></i><?php echo clean($topper['board'] . ' ' . $topper['year']); ?></p>
                        <?php if ($topper['achievement']): ?>
                        <p class="text-blue-600 font-medium mt-3"><?php echo clean($topper['achievement']); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-12">
            <a href="toppers.php" class="inline-flex items-center bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 py-3 rounded-full font-semibold hover:from-blue-700 hover:to-indigo-700 transition shadow-lg">
                View All Toppers <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Events & Announcements Section -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Announcements -->
            <div>
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">
                        <i class="fas fa-bullhorn text-blue-600 mr-2"></i>
                        Latest Announcements
                    </h3>
                </div>
                <div class="space-y-4" id="announcements">
                    <?php if (!empty($announcements)): ?>
                        <?php foreach ($announcements as $announcement): ?>
                        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 <?php echo $announcement['priority'] === 'high' ? 'border-red-500' : ($announcement['priority'] === 'medium' ? 'border-yellow-500' : 'border-blue-500'); ?> hover-lift">
                            <div class="flex justify-between items-start mb-2">
                                <h4 class="font-bold text-gray-800 text-lg"><?php echo clean($announcement['title']); ?></h4>
                                <?php if ($announcement['priority'] === 'high'): ?>
                                <span class="bg-red-100 text-red-600 text-xs px-2 py-1 rounded-full">Important</span>
                                <?php endif; ?>
                            </div>
                            <p class="text-gray-600 mb-3"><?php echo clean($announcement['content']); ?></p>
                            <div class="text-sm text-gray-500">
                                <i class="fas fa-calendar mr-1"></i>
                                <?php echo formatDate($announcement['date']); ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-gray-500 text-center py-8">No announcements at the moment</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Events -->
            <div>
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">
                        <i class="fas fa-calendar-alt text-indigo-600 mr-2"></i>
                        Upcoming Events
                    </h3>
                </div>
                <div class="space-y-4">
                    <?php if (!empty($events)): ?>
                        <?php foreach ($events as $event): ?>
                        <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl p-6 hover-lift">
                            <h4 class="font-bold text-gray-800 text-lg mb-2"><?php echo clean($event['title']); ?></h4>
                            <?php if ($event['description']): ?>
                            <p class="text-gray-600 mb-3"><?php echo clean($event['description']); ?></p>
                            <?php endif; ?>
                            <div class="flex flex-wrap gap-4 text-sm">
                                <div class="flex items-center text-gray-700">
                                    <i class="fas fa-calendar text-indigo-600 mr-2"></i>
                                    <?php echo formatDate($event['event_date']); ?>
                                </div>
                                <?php if ($event['event_time']): ?>
                                <div class="flex items-center text-gray-700">
                                    <i class="fas fa-clock text-indigo-600 mr-2"></i>
                                    <?php echo date('g:i A', strtotime($event['event_time'])); ?>
                                </div>
                                <?php endif; ?>
                                <?php if ($event['location']): ?>
                                <div class="flex items-center text-gray-700">
                                    <i class="fas fa-map-marker-alt text-indigo-600 mr-2"></i>
                                    <?php echo clean($event['location']); ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-gray-500 text-center py-8">No upcoming events</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Preview -->
<?php if (!empty($galleryImages)): ?>
<section class="py-16 bg-gray-100">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <div class="inline-block bg-purple-100 text-purple-600 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                Our Gallery
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                Capturing <span class="gradient-text">Memorable Moments</span>
            </h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <?php foreach ($galleryImages as $image): ?>
            <div class="relative group overflow-hidden rounded-xl aspect-square hover-lift">
                <img src="uploads/gallery/<?php echo clean($image['image']); ?>" 
                     alt="<?php echo clean($image['title']); ?>" 
                     class="w-full h-full object-cover transition duration-300 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300">
                    <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                        <p class="font-semibold"><?php echo clean($image['title']); ?></p>
                        <p class="text-xs"><?php echo clean($image['category']); ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-12">
            <a href="gallery.php" class="inline-flex items-center bg-purple-600 text-white px-8 py-3 rounded-full font-semibold hover:bg-purple-700 transition shadow-lg">
                View Full Gallery <i class="fas fa-images ml-2"></i>
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Testimonials Section -->
<?php if (!empty($testimonials)): ?>
<section class="py-8 md:py-16">
    <div class="container mx-auto px-4">
        <div class="text-center mb-8 md:mb-12">
            <div class="inline-block bg-green-100 text-green-600 px-3 md:px-4 py-1.5 md:py-2 rounded-full text-xs md:text-sm font-semibold mb-3 md:mb-4">
                Testimonials
            </div>
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-800 mb-3 md:mb-4 px-4">
                What People <span class="gradient-text">Say About Us</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-8">
            <?php foreach ($testimonials as $testimonial): ?>
            <div class="bg-white rounded-2xl shadow-lg p-8 relative hover-lift">
                <div class="absolute -top-4 left-8 bg-blue-600 text-white w-12 h-12 rounded-full flex items-center justify-center text-2xl">
                    <i class="fas fa-quote-left"></i>
                </div>
                <div class="flex items-center mb-4 mt-4">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <i class="fas fa-star <?php echo $i <= $testimonial['rating'] ? 'text-yellow-400' : 'text-gray-300'; ?>"></i>
                    <?php endfor; ?>
                </div>
                <p class="text-gray-600 mb-6 leading-relaxed"><?php echo clean($testimonial['content']); ?></p>
                <div class="flex items-center">
                    <?php if ($testimonial['photo']): ?>
                        <img src="uploads/testimonials/<?php echo clean($testimonial['photo']); ?>" 
                             alt="<?php echo clean($testimonial['name']); ?>" 
                             class="w-12 h-12 rounded-full object-cover mr-4">
                    <?php else: ?>
                        <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center mr-4">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                    <?php endif; ?>
                    <div>
                        <h4 class="font-bold text-gray-800"><?php echo clean($testimonial['name']); ?></h4>
                        <p class="text-sm text-gray-600"><?php echo clean($testimonial['role']); ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA Section -->
<section class="py-8 md:py-16 bg-gradient-to-r from-blue-600 to-indigo-600 text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-3 md:mb-4 px-4">Ready to Join Our School Family?</h2>
        <p class="text-base md:text-xl text-blue-100 mb-6 md:mb-8 max-w-2xl mx-auto px-4">
            Take the first step towards a brighter future. Apply for admission today!
        </p>
        <a href="admission.php" class="inline-flex items-center justify-center bg-white text-blue-600 px-6 md:px-8 py-3 md:py-4 rounded-full font-bold text-base md:text-lg hover:bg-gray-100 transition shadow-xl transform hover:scale-105 w-full sm:w-auto max-w-sm mx-auto">
            Apply for Admission <i class="fas fa-arrow-right ml-2"></i>
        </a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

