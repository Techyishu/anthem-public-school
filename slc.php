<?php
$pageTitle = 'School Leaving Certificate';
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once 'includes/header.php';
?>

<!-- Page Header -->
<div class="bg-gradient-to-r from-navy-dark via-navy to-blue-800 text-white py-12 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0"
            style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
        </div>
    </div>
    <div class="container mx-auto px-4 relative">
        <div class="max-w-3xl mx-auto text-center">
            <div
                class="inline-block bg-white bg-opacity-10 backdrop-blur-sm px-6 py-3 rounded-full mb-6 border border-white border-opacity-20">
                <i class="fas fa-certificate text-gold mr-2"></i>
                <span class="text-gold font-semibold">Official Certificate</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold mb-4">School Leaving Certificate</h1>
            <p class="text-lg text-blue-100">
                Information and process for obtaining School Leaving Certificate (TC)
            </p>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">

            <!-- Introduction -->
            <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 mb-12 border-t-4 border-navy">
                <div class="md:flex items-start gap-8">
                    <div class="md:w-1/4 mb-6 md:mb-0 text-center">
                        <div
                            class="inline-block bg-gradient-to-br from-navy to-blue-700 text-white p-10 rounded-full shadow-2xl">
                            <i class="fas fa-scroll text-gold text-5xl"></i>
                        </div>
                    </div>
                    <div class="md:w-3/4">
                        <h2 class="text-3xl font-bold text-gray-800 mb-4">What is a Transfer Certificate?</h2>
                        <p class="text-gray-700 leading-relaxed mb-4">
                            A School Leaving Certificate (also known as Transfer Certificate or TC) is an official
                            document issued by the
                            school when a student leaves the institution. It contains important details about the
                            student's academic record,
                            conduct, and reason for leaving.
                        </p>
                        <p class="text-gray-700 leading-relaxed">
                            This certificate is mandatory for admission to any other educational institution and serves
                            as proof of the
                            student's previous academic history.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Required Documents -->
            <div class="mb-12">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-file-alt text-maroon mr-3"></i>
                    Documents Required
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php
                    $documents = [
                        ['title' => 'Written Application', 'desc' => 'Application from parent/guardian requesting TC', 'icon' => 'fa-edit'],
                        ['title' => 'Fee Clearance', 'desc' => 'All pending fees must be cleared', 'icon' => 'fa-money-bill-wave'],
                        ['title' => 'Library Clearance', 'desc' => 'Return all library books and clear dues', 'icon' => 'fa-book'],
                        ['title' => 'School ID Card', 'desc' => 'Submit original school ID card', 'icon' => 'fa-id-card'],
                        ['title' => 'School Diary', 'desc' => 'Return school diary/handbook', 'icon' => 'fa-book-open'],
                        ['title' => 'Transfer Reason', 'desc' => 'Valid reason for leaving the school', 'icon' => 'fa-question-circle']
                    ];

                    foreach ($documents as $doc):
                        ?>
                        <div
                            class="bg-white rounded-xl shadow-md hover:shadow-lg transition p-6 border border-gray-100 hover-lift">
                            <div class="flex items-start">
                                <div class="bg-navy text-gold p-4 rounded-lg mr-4">
                                    <i class="fas <?php echo $doc['icon']; ?> text-2xl"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-800 mb-2">
                                        <?php echo $doc['title']; ?>
                                    </h3>
                                    <p class="text-gray-600 text-sm">
                                        <?php echo $doc['desc']; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Process Steps -->
            <div class="mb-12">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-tasks text-navy mr-3"></i>
                    TC Issuance Process
                </h2>
                <div class="space-y-4">
                    <?php
                    $steps = [
                        ['step' => 1, 'title' => 'Submit Application', 'desc' => 'Submit written application to the school office with valid reason for leaving'],
                        ['step' => 2, 'title' => 'Clear All Dues', 'desc' => 'Clear all pending fees and library dues. Obtain clearance certificates'],
                        ['step' => 3, 'title' => 'Return School Property', 'desc' => 'Return school ID card, diary, library books, and any other school property'],
                        ['step' => 4, 'title' => 'Processing', 'desc' => 'School office will process your application within 3-5 working days'],
                        ['step' => 5, 'title' => 'Collect TC', 'desc' => 'Collect the Transfer Certificate from the school office after notification']
                    ];

                    foreach ($steps as $step):
                        ?>
                        <div class="bg-white rounded-xl shadow-md p-6 flex items-start hover-lift">
                            <div
                                class="bg-gradient-to-br from-maroon to-red-700 text-white font-bold text-2xl w-16 h-16 rounded-full flex items-center justify-center mr-6 flex-shrink-0 shadow-lg">
                                <?php echo $step['step']; ?>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-800 text-xl mb-2">
                                    <?php echo $step['title']; ?>
                                </h3>
                                <p class="text-gray-600">
                                    <?php echo $step['desc']; ?>
                                </p>
                            </div>
                            <?php if ($step['step'] < count($steps)): ?>
                                <i class="fas fa-arrow-down text-gray-300 text-2xl ml-4 hidden md:block"></i>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Important Information -->
            <div class="bg-yellow-50 border-l-4 border-yellow-500 rounded-lg p-8 mb-12 shadow-md">
                <h3 class="text-yellow-900 font-bold text-xl mb-4 flex items-center">
                    <i class="fas fa-exclamation-triangle mr-3 text-2xl"></i>
                    Important Points to Remember
                </h3>
                <ul class="space-y-3 text-gray-700">
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-yellow-600 mr-3 mt-1"></i>
                        <span>Transfer Certificate will only be issued after clearing all dues</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-yellow-600 mr-3 mt-1"></i>
                        <span>TC processing time is 3-5 working days from the date of application</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-yellow-600 mr-3 mt-1"></i>
                        <span>Original documents will be issued only once. Keep them safe</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-yellow-600 mr-3 mt-1"></i>
                        <span>Duplicate TC can be issued on payment of prescribed fees</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-yellow-600 mr-3 mt-1"></i>
                        <span>TC is valid for admission in other schools as per their requirements</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-yellow-600 mr-3 mt-1"></i>
                        <span>Character certificate will be issued along with the Transfer Certificate</span>
                    </li>
                </ul>
            </div>

            <!-- Contact Information -->
            <div
                class="bg-gradient-to-r from-navy-dark via-navy to-blue-800 rounded-2xl shadow-2xl p-8 md:p-12 text-white">
                <div class="text-center">
                    <i class="fas fa-phone-alt text-gold text-5xl mb-6"></i>
                    <h2 class="text-3xl font-bold mb-4">Need Assistance with TC?</h2>
                    <p class="text-blue-100 text-lg mb-8">
                        For any queries regarding Transfer Certificate, please contact our administration office
                    </p>
                    <div class="space-y-4 mb-8">
                        <a href="tel:9896421785"
                            class="flex items-center justify-center text-white hover:text-gold transition text-lg">
                            <i class="fas fa-phone mr-3"></i>
                            <span class="font-semibold">9896421785 / 8950081785</span>
                        </a>
                        <a href="mailto:anthemschool55@gmail.com"
                            class="flex items-center justify-center text-white hover:text-gold transition text-lg">
                            <i class="fas fa-envelope mr-3"></i>
                            <span class="font-semibold">anthemschool55@gmail.com</span>
                        </a>
                    </div>
                    <a href="contact.php"
                        class="inline-block bg-gold text-navy px-8 py-4 rounded-full hover:bg-yellow-400 transition font-bold shadow-xl hover:shadow-2xl">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Contact Administration
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>