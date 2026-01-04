<?php
$pageTitle = 'Fee Structure';
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once 'includes/header.php';

// Fetch active fee structure
$academicYear = isset($_GET['year']) ? $_GET['year'] : '2024-2025';

$stmt = $pdo->prepare("
    SELECT DISTINCT academic_year FROM fee_structure 
    WHERE status = 'active' 
    ORDER BY academic_year DESC
");
$stmt->execute();
$availableYears = $stmt->fetchAll(PDO::FETCH_COLUMN);

$stmt = $pdo->prepare("
    SELECT * FROM fee_structure 
    WHERE status = 'active' AND academic_year = ? 
    ORDER BY display_order ASC, class_name ASC
");
$stmt->execute([$academicYear]);
$feeStructure = $stmt->fetchAll();
?>

<!-- Page Header -->
<div class="bg-gradient-to-r from-navy-dark via-navy to-blue-800 text-white py-12 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0"
            style="background-image: url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'28\' height=\'49\' viewBox=\'0 0 28 49\'%3E%3Cg fill-rule=\'evenodd\'%3E%3Cg id=\'hexagons\' fill=\'%23ffffff\' fill-opacity=\'1\' fill-rule=\'nonzero\'%3E%3Cpath d=\'M13.99 9.25l13 7.5v15l-13 7.5L1 31.75v-15l12.99-7.5zM3 17.9v12.7l10.99 6.34 11-6.35V17.9l-11-6.34L3 17.9zM0 15l12.98-7.5V0h-2v6.35L0 12.69v2.3zm0 18.5L12.98 41v8h-2v-6.85L0 35.81v-2.3zM15 0v7.5L27.99 15H28v-2.31h-.01L17 6.35V0h-2zm0 49v-8l12.99-7.5H28v2.31h-.01L17 42.15V49h-2z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
        </div>
    </div>
    <div class="container mx-auto px-4 relative">
        <div class="max-w-3xl mx-auto text-center">
            <div
                class="inline-block bg-white bg-opacity-10 backdrop-blur-sm px-6 py-3 rounded-full mb-6 border border-white border-opacity-20">
                <i class="fas fa-rupee-sign text-gold mr-2"></i>
                <span class="text-gold font-semibold">Transparent Pricing</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Fee Structure</h1>
            <p class="text-lg text-blue-100">
                Academic Year
                <?php echo clean($academicYear); ?>
            </p>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto">

            <!-- Year Selector -->
            <?php if (count($availableYears) > 1): ?>
                <div class="mb-12 text-center">
                    <div class="inline-flex bg-white rounded-xl shadow-lg p-2 gap-2">
                        <?php foreach ($availableYears as $year): ?>
                            <a href="?year=<?php echo urlencode($year); ?>"
                                class="px-6 py-3 rounded-lg font-semibold transition <?php echo $year === $academicYear ? 'bg-navy text-white' : 'text-gray-700 hover:bg-gray-100'; ?>">
                                <?php echo clean($year); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (empty($feeStructure)): ?>
                <!-- No Fee Structure -->
                <div class="text-center py-16">
                    <i class="fas fa-file-invoice-dollar text-gray-300 text-6xl mb-6"></i>
                    <h3 class="text-2xl font-bold text-gray-700 mb-3">Fee Structure Information Coming Soon</h3>
                    <p class="text-gray-500">Fee details for this academic year will be available here soon.</p>
                </div>
            <?php else: ?>
                <!-- Fee Structure Cards -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
                    <?php foreach ($feeStructure as $fee): ?>
                        <div
                            class="bg-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 overflow-hidden hover-lift">
                            <!-- Class Header -->
                            <div class="bg-gradient-to-r from-maroon to-red-700 text-white p-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-3xl font-bold mb-1">
                                            <?php echo clean($fee['class_name']); ?>
                                        </h3>
                                        <p class="text-red-100">Academic Year:
                                            <?php echo clean($fee['academic_year']); ?>
                                        </p>
                                    </div>
                                    <div class="text-right bg-white bg-opacity-20 backdrop-blur-sm px-6 py-4 rounded-xl">
                                        <div class="text-yellow-300 text-xs font-semibold mb-1">Total Annual Fee</div>
                                        <div class="text-white text-3xl font-bold">₹
                                            <?php echo number_format($fee['total_annual_fee'], 0); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Fee Breakdown -->
                            <div class="p-6">
                                <h4 class="font-bold text-gray-800 mb-4 flex items-center text-lg">
                                    <i class="fas fa-list-ul text-navy mr-3"></i>
                                    Fee Breakdown
                                </h4>

                                <div class="space-y-2 mb-6">
                                    <?php
                                    $feeComponents = [
                                        'tuition_fee' => ['label' => 'Tuition Fee', 'icon' => 'fa-book'],
                                        'admission_fee' => ['label' => 'Admission Fee', 'icon' => 'fa-user-plus'],
                                        'annual_charges' => ['label' => 'Annual Charges', 'icon' => 'fa-calendar'],
                                        'computer_fee' => ['label' => 'Computer Fee', 'icon' => 'fa-laptop'],
                                        'library_fee' => ['label' => 'Library Fee', 'icon' => 'fa-book-reader'],
                                        'sports_fee' => ['label' => 'Sports Fee', 'icon' => 'fa-futbol'],
                                        'lab_fee' => ['label' => 'Laboratory Fee', 'icon' => 'fa-flask'],
                                        'exam_fee' => ['label' => 'Examination Fee', 'icon' => 'fa-file-alt'],
                                        'development_fee' => ['label' => 'Development Fee', 'icon' => 'fa-building'],
                                        'other_charges' => ['label' => 'Other Charges', 'icon' => 'fa-plus-circle']
                                    ];

                                    foreach ($feeComponents as $key => $component):
                                        if ($fee[$key] > 0):
                                            ?>
                                            <div
                                                class="flex items-center justify-between py-2 px-4 hover:bg-gray-50 rounded-lg transition">
                                                <span class="text-gray-700 flex items-center">
                                                    <i class="fas <?php echo $component['icon']; ?> text-navy text-sm mr-3 w-5"></i>
                                                    <?php echo $component['label']; ?>
                                                </span>
                                                <span class="font-bold text-gray-800">₹
                                                    <?php echo number_format($fee[$key], 0); ?>
                                                </span>
                                            </div>
                                        <?php
                                        endif;
                                    endforeach;
                                    ?>

                                    <!-- Transport Fee Note -->
                                    <?php if ($fee['transport_fee'] > 0): ?>
                                        <div class="bg-blue-50 border border-blue-200 p-3 rounded-lg mt-4">
                                            <div class="flex items-center justify-between">
                                                <span class="text-gray-700 flex items-center font-semibold">
                                                    <i class="fas fa-bus text-blue-600 mr-3"></i>
                                                    Transport Fee (Optional)
                                                </span>
                                                <span class="font-bold text-blue-700">₹
                                                    <?php echo number_format($fee['transport_fee'], 0); ?>
                                                </span>
                                            </div>
                                            <p class="text-xs text-gray-600 mt-1 ml-8">Varies by route - Check bus routes page</p>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Payment Terms -->
                                <?php if ($fee['payment_terms']): ?>
                                    <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded mb-4">
                                        <h5 class="font-bold text-gray-800 mb-2 flex items-center text-sm">
                                            <i class="fas fa-credit-card text-green-600 mr-2"></i>
                                            Payment Terms
                                        </h5>
                                        <p class="text-gray-700 text-sm">
                                            <?php echo clean($fee['payment_terms']); ?>
                                        </p>
                                    </div>
                                <?php endif; ?>

                                <!-- Discount Info -->
                                <?php if ($fee['discount_info']): ?>
                                    <div class="bg-gradient-to-r from-yellow-50 to-orange-50 border border-yellow-300 p-4 rounded">
                                        <h5 class="font-bold text-gray-800 mb-2 flex items-center text-sm">
                                            <i class="fas fa-tag text-orange-500 mr-2"></i>
                                            Discounts & Scholarships
                                        </h5>
                                        <p class="text-gray-700 text-sm">
                                            <?php echo clean($fee['discount_info']); ?>
                                        </p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Important Notes -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                    <!-- Payment Methods -->
                    <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-navy">
                        <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-money-check-alt text-navy text-2xl mr-3"></i>
                            Payment Methods
                        </h3>
                        <ul class="space-y-3 text-gray-700">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mr-3 mt-1"></i>
                                <span>Online payment through school portal</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mr-3 mt-1"></i>
                                <span>Bank transfer/NEFT/RTGS</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mr-3 mt-1"></i>
                                <span>Cheque/Demand Draft</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mr-3 mt-1"></i>
                                <span>Cash payment at accounts office</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Important Information -->
                    <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-maroon">
                        <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-info-circle text-maroon text-2xl mr-3"></i>
                            Important Information
                        </h3>
                        <ul class="space-y-3 text-gray-700 text-sm">
                            <li class="flex items-start">
                                <i class="fas fa-angle-right text-maroon mr-2 mt-1"></i>
                                <span>Fees once paid are non-refundable</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-angle-right text-maroon mr-2 mt-1"></i>
                                <span>Late payment will attract a fine of ₹10 per day</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-angle-right text-maroon mr-2 mt-1"></i>
                                <span>Fee receipts must be preserved for future reference</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-angle-right text-maroon mr-2 mt-1"></i>
                                <span>For fee-related queries, contact accounts office</span>
                            </li>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Call to Action -->
            <div
                class="bg-gradient-to-r from-navy-dark via-navy to-blue-800 rounded-2xl shadow-2xl p-8 md:p-12 text-white text-center">
                <i class="fas fa-question-circle text-gold text-5xl mb-4"></i>
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Have Questions About Fees?</h2>
                <p class="text-blue-100 text-lg mb-8 max-w-2xl mx-auto">
                    Our accounts department is here to help with any fee-related queries or concerns.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="tel:9896421785"
                        class="inline-block bg-gold text-navy px-8 py-4 rounded-full hover:bg-yellow-400 transition font-bold shadow-xl hover:shadow-2xl">
                        <i class="fas fa-phone-alt mr-2"></i>
                        Call: 9896421785
                    </a>
                    <a href="contact.php"
                        class="inline-block bg-white bg-opacity-10 backdrop-blur-sm border-2 border-white text-white px-8 py-4 rounded-full hover:bg-white hover:text-navy transition font-bold">
                        <i class="fas fa-envelope mr-2"></i>
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>