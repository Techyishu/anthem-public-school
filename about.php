<?php
require_once 'includes/functions.php';

$pageTitle = 'About Us';
$settings = getAllSettings();

include 'includes/header.php';
?>

<!-- Page Header -->
<section class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-16">
    <div class="container mx-auto px-4">
        <nav class="text-sm mb-4">
            <a href="index.php" class="hover:text-blue-200">Home</a>
            <span class="mx-2">/</span>
            <span>About Us</span>
        </nav>
        <h1 class="text-4xl md:text-5xl font-bold">About Our School</h1>
        <p class="text-xl text-blue-100 mt-4">Discover our journey of excellence in education</p>
    </div>
</section>

<!-- About Content -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-16">
            <div>
                <img src="assets/images/school-building.jpg" 
                     alt="School Building" 
                     class="rounded-2xl shadow-2xl w-full"
                     onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'600\' height=\'400\'%3E%3Crect fill=\'%234F46E5\' width=\'600\' height=\'400\'/%3E%3Ctext fill=\'%23ffffff\' font-family=\'Arial\' font-size=\'24\' x=\'50%25\' y=\'50%25\' text-anchor=\'middle\' dy=\'.3em\'%3ESchool Campus%3C/text%3E%3C/svg%3E'">
            </div>
            <div class="space-y-6">
                <h2 class="text-3xl font-bold text-gray-800">Welcome to <?php echo clean($settings['school_name'] ?? 'Anthem Public School'); ?></h2>
                <p class="text-gray-600 leading-relaxed text-lg">
                    <?php echo clean($settings['about_text'] ?? 'Anthem Public School is a premier educational institution dedicated to providing quality education and holistic development of students. We believe in nurturing young minds to become responsible citizens and future leaders.'); ?>
                </p>
                <p class="text-gray-600 leading-relaxed">
                    Since our establishment <?php echo clean($settings['years_established'] ?? '25'); ?> years ago, we have been committed to academic excellence, character building, and overall personality development. Our mission is to provide a learning environment that encourages students to explore their potential and develop into well-rounded individuals.
                </p>
                <p class="text-gray-600 leading-relaxed">
                    With state-of-the-art infrastructure, experienced faculty, and a comprehensive curriculum, we ensure that our students receive the best education possible. We follow the CBSE curriculum and focus on both academic and co-curricular activities to ensure holistic development.
                </p>
            </div>
        </div>

        <!-- Leadership Section -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-8">Our Leadership</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover-lift">
                    <img src="assets/images/logo.jpg" alt="Principal" class="w-full h-80 object-cover">
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Dr. Rajesh Kumar</h3>
                        <p class="text-blue-600 font-semibold mb-3">Principal</p>
                        <p class="text-gray-600 text-sm">Leading with vision and dedication to nurture future leaders</p>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover-lift">
                    <img src="assets/images/about-school.jpg" alt="Vice Principal" class="w-full h-80 object-cover">
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Mrs. Sunita Verma</h3>
                        <p class="text-purple-600 font-semibold mb-3">Vice Principal</p>
                        <p class="text-gray-600 text-sm">Committed to academic excellence and student development</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mission & Vision -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-8">
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-bullseye text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Our Mission</h3>
                <p class="text-gray-600 leading-relaxed">
                    To provide quality education that empowers students to achieve their full potential, develop strong character, and become responsible global citizens who contribute positively to society.
                </p>
            </div>
            
            <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-8">
                <div class="w-16 h-16 bg-purple-600 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-eye text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Our Vision</h3>
                <p class="text-gray-600 leading-relaxed">
                    To be a leading institution that inspires excellence in education, fosters innovation, and nurtures future leaders who will make a positive impact on the world through their knowledge, skills, and values.
                </p>
            </div>
        </div>

        <!-- Core Values -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-12">Our Core Values</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="text-center p-6 hover-lift bg-white rounded-xl shadow-lg">
                    <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-heart text-red-600 text-3xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 mb-2">Integrity</h4>
                    <p class="text-gray-600 text-sm">Building character through honesty and strong moral principles</p>
                </div>
                
                <div class="text-center p-6 hover-lift bg-white rounded-xl shadow-lg">
                    <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-brain text-blue-600 text-3xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 mb-2">Excellence</h4>
                    <p class="text-gray-600 text-sm">Striving for the highest standards in all endeavors</p>
                </div>
                
                <div class="text-center p-6 hover-lift bg-white rounded-xl shadow-lg">
                    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-handshake text-green-600 text-3xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 mb-2">Respect</h4>
                    <p class="text-gray-600 text-sm">Valuing diversity and treating everyone with dignity</p>
                </div>
                
                <div class="text-center p-6 hover-lift bg-white rounded-xl shadow-lg">
                    <div class="w-20 h-20 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-lightbulb text-yellow-600 text-3xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 mb-2">Innovation</h4>
                    <p class="text-gray-600 text-sm">Encouraging creativity and forward-thinking approaches</p>
                </div>
            </div>
        </div>

        <!-- Principal's Message -->
        <div class="bg-gradient-to-br from-blue-600 to-indigo-600 rounded-2xl p-8 md:p-12 text-white">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-center">
                <div class="lg:col-span-1">
                    <img src="assets/images/school-building.jpg" alt="Principal" class="w-48 h-48 rounded-full object-cover mx-auto border-4 border-white shadow-xl">
                </div>
                <div class="lg:col-span-2 space-y-4">
                    <h3 class="text-2xl font-bold">Principal's Message</h3>
                    <p class="text-blue-100 leading-relaxed">
                        "<?php echo clean($settings['principal_message'] ?? 'Welcome to Anthem Public School, where we nurture young minds to become future leaders through excellence in education and holistic development.'); ?>"
                    </p>
                    <p class="text-blue-100 leading-relaxed">
                        It is my privilege to lead an institution that has been shaping young minds for over <?php echo clean($settings['years_established'] ?? '25'); ?> years. At Anthem Public School, we believe that education is not just about academic excellence, but about creating well-rounded individuals who are equipped to face the challenges of tomorrow.
                    </p>
                    <p class="text-blue-100 leading-relaxed">
                        Our dedicated faculty, modern facilities, and comprehensive curriculum ensure that every student receives the best possible education. We encourage our students to dream big, work hard, and make a positive impact on the world.
                    </p>
                    <div class="pt-4">
                        <p class="font-bold text-xl">Dr. Rajesh Kumar</p>
                        <p class="text-blue-200">Principal</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Facilities Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-gray-800 text-center mb-12">Our Facilities</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white rounded-xl shadow-lg p-6 hover-lift">
                <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-flask text-blue-600 text-2xl"></i>
                </div>
                <h4 class="font-bold text-gray-800 mb-2">Science Laboratories</h4>
                <p class="text-gray-600 text-sm">Well-equipped labs for Physics, Chemistry, and Biology with modern equipment</p>
            </div>
            
            <div class="bg-white rounded-xl shadow-lg p-6 hover-lift">
                <div class="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-desktop text-green-600 text-2xl"></i>
                </div>
                <h4 class="font-bold text-gray-800 mb-2">Computer Labs</h4>
                <p class="text-gray-600 text-sm">State-of-the-art computer labs with high-speed internet connectivity</p>
            </div>
            
            <div class="bg-white rounded-xl shadow-lg p-6 hover-lift">
                <div class="w-16 h-16 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-book text-purple-600 text-2xl"></i>
                </div>
                <h4 class="font-bold text-gray-800 mb-2">Library</h4>
                <p class="text-gray-600 text-sm">Extensive collection of books, journals, and digital resources</p>
            </div>
            
            <div class="bg-white rounded-xl shadow-lg p-6 hover-lift">
                <div class="w-16 h-16 bg-red-100 rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-running text-red-600 text-2xl"></i>
                </div>
                <h4 class="font-bold text-gray-800 mb-2">Sports Complex</h4>
                <p class="text-gray-600 text-sm">Indoor and outdoor sports facilities for various games</p>
            </div>
            
            <div class="bg-white rounded-xl shadow-lg p-6 hover-lift">
                <div class="w-16 h-16 bg-yellow-100 rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-theater-masks text-yellow-600 text-2xl"></i>
                </div>
                <h4 class="font-bold text-gray-800 mb-2">Auditorium</h4>
                <p class="text-gray-600 text-sm">Modern auditorium for cultural events and assemblies</p>
            </div>
            
            <div class="bg-white rounded-xl shadow-lg p-6 hover-lift">
                <div class="w-16 h-16 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-bus text-indigo-600 text-2xl"></i>
                </div>
                <h4 class="font-bold text-gray-800 mb-2">Transportation</h4>
                <p class="text-gray-600 text-sm">Safe and reliable transportation covering all major routes</p>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

