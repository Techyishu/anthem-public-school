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
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover-lift">
                    <img src="assets/images/about-school.jpg" alt="Chairman" class="w-full h-80 object-cover">
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Sh. Satpal Chauhan</h3>
                        <p class="text-blue-600 font-semibold mb-3">Chairman</p>
                        <p class="text-gray-600 text-sm">Leading with vision and dedication to nurture future leaders</p>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover-lift">
                    <img src="assets/images/WhatsApp Image 2025-12-19 at 18.42.31.jpeg" alt="Director" class="w-full h-80 object-cover">
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Sh. Sompal Rana</h3>
                        <p class="text-green-600 font-semibold mb-3">Director</p>
                        <p class="text-gray-600 text-sm">Driving excellence and innovation in education</p>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover-lift">
                    <img src="assets/images/school-building.jpg" alt="Principal" class="w-full h-80 object-cover">
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Ms. Amita Chopra</h3>
                        <p class="text-purple-600 font-semibold mb-3">Principal</p>
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

        <!-- Chairman's Message -->
        <div class="bg-gradient-to-br from-red-600 to-red-800 rounded-2xl p-8 md:p-12 text-white mb-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-center">
                <div class="lg:col-span-1">
                    <img src="assets/images/about-school.jpg" alt="Chairman" class="w-48 h-48 rounded-full object-cover mx-auto border-4 border-white shadow-xl">
                </div>
                <div class="lg:col-span-2 space-y-4">
                    <h3 class="text-2xl font-bold">Chairman's Message</h3>
                    <p class="text-red-100 leading-relaxed">
                        Dear Parents, Students, Faculty, and Staff
                    </p>
                    <p class="text-red-100 leading-relaxed">
                        It is with great pleasure and pride that I address you as the Chairperson of our esteemed institution. As we reflect on the past academic year and look forward to the opportunities and challenges that lie ahead, I am filled with a profound sense of gratitude for the dedication and commitment demonstrated by each member of our school community.
                    </p>
                    <p class="text-red-100 leading-relaxed">
                        Our school's mission to nurture young minds, foster academic excellence, and instill values of integrity, empathy, and leadership has never been more relevant than it is today. In these uncertain times, the strength of our community and the resilience of our spirit have been truly remarkable.
                    </p>
                    <p class="text-red-100 leading-relaxed">
                        I would like to express my heartfelt appreciation to our exceptional faculty and staff for their unwavering dedication to the academic and personal growth of our students. Your passion, expertise, and tireless efforts are the foundation upon which our school's success is built.
                    </p>
                    <p class="text-red-100 leading-relaxed">
                        To our students, Your resilience serves as an inspiration to us all, and I have no doubt that you will continue to excel in all your endeavors.
                    </p>
                    <p class="text-red-100 leading-relaxed">
                        To our parents, thank you for your unwavering support, trust, and partnership. Your active involvement in your child's education is invaluable, and together, we will continue to provide a nurturing and empowering environment for our students to thrive.
                    </p>
                    <p class="text-red-100 leading-relaxed">
                        As we embark on the journey ahead, let us remain committed to our shared values of excellence, innovation, and inclusivity. Together, we will continue to inspire and empower the next generation of leaders, thinkers, and changemakers.
                    </p>
                    <p class="text-red-100 leading-relaxed">
                        Thank you for your continued support and dedication to our school.
                    </p>
                    <div class="pt-4">
                        <p class="font-bold text-xl">Warm regards,</p>
                        <p class="font-bold text-xl mt-2">Sh. Satpal Chauhan</p>
                        <p class="text-red-200">Chairman</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Director's Message -->
        <div class="bg-gradient-to-br from-green-600 to-green-800 rounded-2xl p-8 md:p-12 text-white mb-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-center">
                <div class="lg:col-span-1">
                    <img src="assets/images/WhatsApp Image 2025-12-19 at 18.42.31.jpeg" alt="Director" class="w-48 h-48 rounded-full object-cover mx-auto border-4 border-white shadow-xl">
                </div>
                <div class="lg:col-span-2 space-y-4">
                    <h3 class="text-2xl font-bold">Director's Message</h3>
                    <p class="text-green-100 leading-relaxed font-semibold">
                        Dear Members of Anthem Family
                    </p>
                    <p class="text-green-100 leading-relaxed">
                        It's a pleasure to welcome you to Anthem International School, a community committed to nurturing young minds and fostering excellence. Our CBSE curriculum is designed to encourage curiosity, creativity, and critical thinking, empowering students to become confident, compassionate, and responsible global citizens.
                    </p>
                    <p class="text-green-100 leading-relaxed">
                        As we embark on another academic journey, I invite you to partner with us in shaping the leaders of tomorrow. Let's work together to create a supportive and inclusive environment where curiosity thrives, creativity blooms, and dreams take flight.
                    </p>
                    <p class="text-green-100 leading-relaxed">
                        I am excited to share our focus areas for the upcoming year: academic excellence, innovation, sustainability, and community engagement. Our dedicated faculty, staff, and parents are committed to providing a holistic learning experience that prepares students for success in an ever-changing world.
                    </p>
                    <p class="text-green-100 leading-relaxed font-semibold">
                        Here's to a year of growth, discovery, and success!
                    </p>
                    <div class="pt-4">
                        <p class="font-bold text-xl">Warm regards,</p>
                        <p class="font-bold text-xl mt-2">Sh. Sompal Rana</p>
                        <p class="text-green-200">Director</p>
                    </div>
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
                    <p class="text-blue-100 leading-relaxed font-semibold">
                        Dear stakeholders!
                    </p>
                    <p class="text-blue-100 leading-relaxed">
                        As we navigate through these unprecedented times, I am filled with immense pride in witnessing the resilience and dedication of our school community. I believe in upholding high standards with an absolute commitment to strive to understand and improve the educational process, using team strategies, while wholly centering on student achievement.
                    </p>
                    <p class="text-blue-100 leading-relaxed">
                        Despite the obstacles presented by the ongoing global situation, our commitment to providing a safe, nurturing, and enriching environment for our students remains unwavering. Our dedicated faculty and staff are working tirelessly to adapt our curriculum and programs to ensure continuity in education while prioritizing the health and well-being of everyone.
                    </p>
                    <p class="text-blue-100 leading-relaxed">
                        I want to extend my heartfelt gratitude to our parents for their unwavering support and partnership in this journey. Your collaboration has been instrumental in fostering a positive and conducive learning environment for our students, both in the physical and virtual realms.
                    </p>
                    <p class="text-blue-100 leading-relaxed">
                        To our students, I commend your resilience, adaptability, and perseverance. Your continued dedication to learning and growth amidst challenging circumstances serves as a testament to your character and determination. Remember, your potential is limitless, and with determination and hard work, you can achieve anything you set your mind to.
                    </p>
                    <p class="text-blue-100 leading-relaxed">
                        As we look ahead to the future, let us remain united in our commitment to excellence, innovation, and inclusivity. Together, we will overcome any obstacles that come our way and emerge stronger and more resilient than ever before.
                    </p>
                    <p class="text-blue-100 leading-relaxed font-semibold">
                        Keep learning, keep growing, and keep striving for excellence.
                    </p>
                    <div class="pt-4">
                        <p class="font-bold text-xl">Warm regards,</p>
                        <p class="font-bold text-xl mt-2">Ms. Amita Chopra</p>
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

