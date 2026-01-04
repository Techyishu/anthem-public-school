<?php
$pageTitle = 'School Leaving Certificate';
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once 'includes/header.php';
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
                <i class="fas fa-certificate text-yellow-400 mr-2"></i>
                <span class="text-yellow-400 font-semibold">Student Services</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold mb-4 text-white">School Leaving Certificate</h1>
            <p class="text-lg text-blue-100">
                Process and status for School Leaving / Transfer Certificates
            </p>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">

            <!-- Process Overview -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-12">
                <div class="bg-blue-900 text-white p-6">
                    <h2 class="text-2xl font-bold flex items-center">
                        <i class="fas fa-clipboard-list mr-3 text-yellow-400"></i>
                        Application Process
                    </h2>
                </div>
                <div class="p-8">
                    <div class="grid md:grid-cols-3 gap-8 relative">
                        <!-- Connecting Line (Desktop) -->
                        <div
                            class="hidden md:block absolute top-1/2 left-0 w-full h-1 bg-gray-200 -z-10 transform -translate-y-1/2">
                        </div>

                        <!-- Step 1 -->
                        <div class="text-center bg-white">
                            <div
                                class="w-16 h-16 bg-blue-100 text-blue-900 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4 border-4 border-white shadow-lg">
                                1</div>
                            <h3 class="font-bold text-gray-800 mb-2">Submit Request</h3>
                            <p class="text-sm text-gray-600">Submit formal application to the Principal</p>
                        </div>

                        <!-- Step 2 -->
                        <div class="text-center bg-white">
                            <div
                                class="w-16 h-16 bg-blue-100 text-blue-900 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4 border-4 border-white shadow-lg">
                                2</div>
                            <h3 class="font-bold text-gray-800 mb-2">Clear Dues</h3>
                            <p class="text-sm text-gray-600">Clear all pending library and fee dues</p>
                        </div>

                        <!-- Step 3 -->
                        <div class="text-center bg-white">
                            <div
                                class="w-16 h-16 bg-blue-100 text-blue-900 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4 border-4 border-white shadow-lg">
                                3</div>
                            <h3 class="font-bold text-gray-800 mb-2">Collect SLC</h3>
                            <p class="text-sm text-gray-600">Collect certificate after 7 working days</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Issued Certificates List -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-12">
                <div
                    class="bg-white p-6 border-b border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
                    <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-file-contract text-blue-900 mr-3"></i>
                        Recently Issued Certificates
                    </h2>

                    <!-- Search Box -->
                    <div class="relative w-full md:w-64">
                        <input type="text" id="slcSearch" placeholder="Search by name or admin no..."
                            class="w-full pl-10 pr-4 py-2 border border-blue-200 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent">
                        <i class="fas fa-search absolute left-4 top-3 text-gray-400"></i>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 font-semibold text-gray-700">Student Name</th>
                                <th class="px-6 py-4 font-semibold text-gray-700">Admission No.</th>
                                <th class="px-6 py-4 font-semibold text-gray-700">Class</th>
                                <th class="px-6 py-4 font-semibold text-gray-700">Issue Date</th>
                                <th class="px-6 py-4 font-semibold text-gray-700">Status</th>
                                <th class="px-6 py-4 font-semibold text-gray-700 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php if (empty($certificates)): ?>
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                        <i class="fas fa-folder-open text-4xl mb-3 text-gray-300"></i>
                                        <p>No certificates found.</p>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($certificates as $cert): ?>
                                    <tr class="hover:bg-blue-50 transition-colors duration-200">
                                        <td class="px-6 py-4 font-medium text-gray-900">
                                            <?php echo clean($cert['student_name']); ?>
                                        </td>
                                        <td class="px-6 py-4 text-gray-600">
                                            <span class="bg-gray-100 px-2 py-1 rounded text-sm text-gray-700 font-mono">
                                                <?php echo clean($cert['admission_number']); ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-gray-600">
                                            <?php echo clean($cert['class']); ?>
                                        </td>
                                        <td class="px-6 py-4 text-gray-600">
                                            <div class="flex items-center">
                                                <i class="far fa-calendar-alt mr-2 text-gray-400 text-xs"></i>
                                                <?php echo date('d M, Y', strtotime($cert['issue_date'])); ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check-circle mr-1"></i> Issued
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <?php if ($cert['certificate_file']): ?>
                                                <a href="uploads/slc/<?php echo clean($cert['certificate_file']); ?>"
                                                    target="_blank" class="text-blue-900 hover:text-blue-700 transition"
                                                    title="Download Certificate">
                                                    <i class="fas fa-download text-lg"></i>
                                                </a>
                                            <?php else: ?>
                                                <span class="text-gray-300 cursor-not-allowed" title="Not available online">
                                                    <i class="fas fa-eye-slash"></i>
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination (Placeholder) -->
                <?php if (count($certificates) > 0): ?>
                    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex justify-center">
                        <nav class="flex space-x-2">
                            <button
                                class="px-3 py-1 rounded border border-gray-300 bg-white text-gray-600 hover:bg-gray-50 disabled:opacity-50">Previous</button>
                            <button class="px-3 py-1 rounded bg-blue-900 text-white hover:bg-blue-800">1</button>
                            <button
                                class="px-3 py-1 rounded border border-gray-300 bg-white text-gray-600 hover:bg-gray-50">2</button>
                            <button
                                class="px-3 py-1 rounded border border-gray-300 bg-white text-gray-600 hover:bg-gray-50">3</button>
                            <button
                                class="px-3 py-1 rounded border border-gray-300 bg-white text-gray-600 hover:bg-gray-50">Next</button>
                        </nav>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Download Application Form -->
            <div
                class="bg-gradient-to-r from-blue-900 to-blue-700 rounded-2xl shadow-lg p-8 text-white relative overflow-hidden">
                <div class="absolute right-0 top-0 h-full w-1/3 bg-white opacity-5 transform skew-x-12 translate-x-10">
                </div>
                <div class="md:flex items-center justify-between relative z-10">
                    <div class="mb-6 md:mb-0">
                        <h3 class="text-2xl font-bold mb-2">Need an SLC?</h3>
                        <p class="text-blue-100">Download the official application form to initiate the process.</p>
                    </div>
                    <a href="#"
                        class="inline-flex items-center bg-yellow-400 text-blue-900 px-6 py-3 rounded-lg font-bold hover:bg-yellow-300 transition shadow-lg">
                        <i class="fas fa-file-pdf mr-2"></i>
                        Application Form
                    </a>
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