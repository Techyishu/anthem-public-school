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
$fees = $stmt->fetchAll();
?>

<!-- Page Header -->
<div class="bg-gradient-to-r from-blue-900 via-blue-800 to-blue-900 text-white py-12 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>
    <div class="container mx-auto px-4 relative">
        <div class="max-w-3xl mx-auto text-center">
            <div class="inline-block bg-white bg-opacity-10 backdrop-blur-sm px-6 py-3 rounded-full mb-6 border border-white border-opacity-20">
                <i class="fas fa-file-invoice-dollar text-yellow-400 mr-2"></i>
                <span class="text-yellow-400 font-semibold">Financial Information</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold mb-4 text-white">Fee Structure</h1>
            <p class="text-lg text-blue-100">
                Transparent and affordable fee structure for the academic year 2024-25
            </p>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        
        <!-- Fee Policy Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16 max-w-6xl mx-auto">
            <div class="bg-white p-8 rounded-2xl shadow-lg border-t-4 border-blue-900 text-center">
                <div class="w-16 h-16 bg-blue-50 text-blue-900 rounded-full flex items-center justify-center text-3xl mx-auto mb-6">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Quarterly Payment</h3>
                <p class="text-gray-600">Fees are to be paid quarterly by the 10th of the first month of every quarter.</p>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-lg border-t-4 border-yellow-400 text-center">
                <div class="w-16 h-16 bg-yellow-50 text-yellow-600 rounded-full flex items-center justify-center text-3xl mx-auto mb-6">
                    <i class="fas fa-credit-card"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Online Payment</h3>
                <p class="text-gray-600">Secure online payment gateway available through our school app and website.</p>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-lg border-t-4 border-green-600 text-center">
                <div class="w-16 h-16 bg-green-50 text-green-600 rounded-full flex items-center justify-center text-3xl mx-auto mb-6">
                    <i class="fas fa-percentage"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Sibling Discount</h3>
                <p class="text-gray-600">Special concession available for siblings studying in the school.</p>
            </div>
        </div>

        <!-- Class Selection & Filter -->
        <div class="max-w-5xl mx-auto mb-12">
            <div class="bg-white rounded-xl shadow-md p-6 flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center">
                    <div class="bg-blue-900 text-white p-3 rounded-lg mr-4">
                        <i class="fas fa-filter text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800">Filter Fee Structure</h3>
                        <p class="text-sm text-gray-500">Select class to view specific fees</p>
                    </div>
                </div>
                <div class="w-full md:w-64">
                    <select id="classFilter" class="w-full bg-gray-50 border border-gray-200 text-gray-700 py-3 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent">
                        <option value="all">View All Classes</option>
                        <option value="Pre-Primary">Pre-Primary (Nursery - KG)</option>
                        <option value="Primary">Primary (I - V)</option>
                        <option value="Middle">Middle (VI - VIII)</option>
                        <option value="Secondary">Secondary (IX - X)</option>
                        <option value="Senior Secondary">Senior Secondary (XI - XII)</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Fee Tables -->
        <div class="max-w-5xl mx-auto space-y-12" id="feeTablesContainer">
            
            <?php 
            // Group fees by category
            $groupedFees = [];
            foreach ($fees as $fee) {
                $category = $fee['class_name']; 
                $groupedFees[$category][] = $fee;
            }
            
            if (empty($groupedFees)): 
            ?>
                <div class="text-center py-12 bg-white rounded-xl shadow">
                    <i class="fas fa-info-circle text-gray-300 text-5xl mb-4"></i>
                    <p class="text-xl text-gray-500">Fee structure will be updated shortly.</p>
                </div>
            <?php else: ?>
                <?php foreach ($groupedFees as $category => $items): ?>
                    <div class="fee-group bg-white rounded-2xl shadow-xl overflow-hidden" data-category="<?php echo clean($category); ?>">
                        <div class="bg-blue-900 text-white p-6 border-b border-blue-800 flex justify-between items-center">
                            <h3 class="text-xl font-bold flex items-center">
                                <i class="fas fa-layer-group text-yellow-400 mr-3"></i>
                                <?php echo clean($category); ?>
                            </h3>
                            <span class="text-xs uppercase tracking-wider bg-blue-800 px-3 py-1 rounded-full text-blue-200">
                                2024-25 Session
                            </span>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-gray-50 text-gray-600 text-sm uppercase tracking-wider font-semibold border-b border-gray-200">
                                    <tr>
                                        <th class="px-6 py-4">Fee Head</th>
                                        <th class="px-6 py-4">Frequency</th>
                                        <th class="px-6 py-4 text-right">Amount (₹)</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    <?php 
                                    $total = 0;
                                    foreach ($items as $item): 
                                        $total += $item['amount'];
                                    ?>
                                        <tr class="hover:bg-blue-50 transition-colors">
                                            <td class="px-6 py-4 font-medium text-gray-800">
                                                <?php echo clean($item['fee_head']); ?>
                                                <?php if($item['description']): ?>
                                                    <span class="block text-xs text-gray-500 font-normal mt-1"><?php echo clean($item['description']); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-6 py-4 text-gray-600">
                                                <span class="inline-block px-2 py-1 bg-gray-100 rounded text-xs">
                                                    <?php echo clean($item['frequency']); ?>
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-right font-bold text-blue-900">
                                                ₹<?php echo number_format($item['amount'], 2); ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    
                                    <!-- Total Row -->
                                    <tr class="bg-gray-50 font-bold border-t-2 border-gray-200">
                                        <td class="px-6 py-4 text-gray-800">Total (Annual)</td>
                                        <td class="px-6 py-4 text-gray-600 text-sm font-normal">Approximate</td>
                                        <td class="px-6 py-4 text-right text-green-700 text-lg">
                                            ₹<?php echo number_format($total, 2); ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>

        <!-- Bank Details for Online Transfer -->
        <div class="max-w-5xl mx-auto mt-12 bg-gradient-to-br from-gray-900 to-blue-900 rounded-2xl shadow-2xl p-8 text-white relative overflow-hidden">
            <div class="absolute right-0 top-0 w-64 h-64 bg-white opacity-5 rounded-full -mr-16 -mt-16 blur-2xl"></div>
            
            <div class="md:flex justify-between items-start gap-12 relative z-10">
                <div class="flex-1">
                    <h3 class="text-2xl font-bold mb-6 flex items-center">
                        <i class="fas fa-university text-yellow-400 mr-3"></i>
                        Bank Details for NEFT/RTGS
                    </h3>
                    <div class="space-y-4 text-blue-100">
                        <div class="flex border-b border-blue-700 pb-2">
                            <span class="w-32 text-blue-300 font-medium">Account Name</span>
                            <span class="flex-1 font-mono font-bold tracking-wide text-white">ANTHEM PUBLIC SCHOOL</span>
                        </div>
                        <div class="flex border-b border-blue-700 pb-2">
                            <span class="w-32 text-blue-300 font-medium">Bank Name</span>
                            <span class="flex-1 font-mono text-white">HDFC BANK</span>
                        </div>
                        <div class="flex border-b border-blue-700 pb-2">
                            <span class="w-32 text-blue-300 font-medium">Account No</span>
                            <span class="flex-1 font-mono font-bold tracking-wide text-yellow-400 text-lg">50200023456789</span>
                        </div>
                        <div class="flex pb-2">
                            <span class="w-32 text-blue-300 font-medium">IFSC Code</span>
                            <span class="flex-1 font-mono font-bold tracking-wide text-white">HDFC0001234</span>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8 md:mt-0 md:w-1/3 bg-white p-4 rounded-xl text-center shadow-lg">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=upi://pay?pa=anthempublicschool@hdfcbank&pn=Anthem%20Public%20School" 
                         alt="UPI QR Code" class="w-40 h-40 mx-auto mb-3">
                    <p class="text-blue-900 font-bold text-sm">Scan to Pay via UPI</p>
                    <p class="text-xs text-gray-500 mt-1">GPay / PhonePe / Paytm</p>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    // Simple filter functionality
    document.getElementById('classFilter').addEventListener('change', function() {
        let selectedCategory = this.value;
        let groups = document.querySelectorAll('.fee-group');
        
        groups.forEach(group => {
            let category = group.getAttribute('data-category');
            if (selectedCategory === 'all' || category.includes(selectedCategory)) {
                group.style.display = 'block';
            } else {
                group.style.display = 'none';
            }
        });
    });
</script>

<?php require_once 'includes/footer.php'; ?>