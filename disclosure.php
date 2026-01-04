<?php
$pageTitle = 'Disclosure';
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once 'includes/header.php';

// Fetch disclosure documents
$stmt = $pdo->prepare("
    SELECT * FROM disclosure_documents 
    WHERE status = 'active' 
    ORDER BY display_order ASC, created_at DESC
");
$stmt->execute();
$documents = $stmt->fetchAll();

// Group documents by type
$documentsByType = [];
foreach ($documents as $doc) {
    $documentsByType[$doc['document_type']][] = $doc;
}

$typeIcons = [
    'mandatory' => 'fa-file-contract',
    'general' => 'fa-file-alt',
    'cbse' => 'fa-graduation-cap',
    'financial' => 'fa-file-invoice-dollar',
    'other' => 'fa-folder-open'
];

$typeLabels = [
    'mandatory' => 'Mandatory Documents',
    'general' => 'General Information',
    'cbse' => 'CBSE Related',
    'financial' => 'Financial Documents',
    'other' => 'Other Documents'
];
?>

<!-- Page Header -->
<div class="bg-gradient-to-r from-navy-dark via-navy to-blue-800 text-white py-12 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>
    <div class="container mx-auto px-4 relative">
        <div class="max-w-3xl mx-auto text-center">
            <div class="inline-block bg-white bg-opacity-10 backdrop-blur-sm px-6 py-3 rounded-full mb-6 border border-white border-opacity-20">
                <i class="fas fa-file-alt text-gold mr-2"></i>
                <span class="text-gold font-semibold">Official Documents</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold mb-4">School Disclosure</h1>
            <p class="text-lg text-blue-100">
                Access all mandatory and important school documents as per CBSE guidelines
            </p>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            
            <!-- Info Banner -->
            <div class="bg-blue-50 border-l-4 border-navy rounded-lg p-6 mb-12 shadow-sm">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-navy text-2xl mt-1 mr-4"></i>
                    <div>
                        <h3 class="text-navy font-bold text-lg mb-2">Transparency & Compliance</h3>
                        <p class="text-gray-700">
                            As per CBSE guidelines, all mandatory documents are made available to parents, students, and the general public for transparency. 
                            Click on any document below to view or download.
                        </p>
                    </div>
                </div>
            </div>

            <?php if (empty($documents)): ?>
                <!-- No Documents -->
                <div class="text-center py-16">
                    <i class="fas fa-folder-open text-gray-300 text-6xl mb-6"></i>
                    <h3 class="text-2xl font-bold text-gray-700 mb-3">No Documents Available</h3>
                    <p class="text-gray-500">Documents will be available here soon.</p>
                </div>
            <?php else: ?>
                <!-- Documents by Type -->
                <?php foreach ($documentsByType as $type => $docs): ?>
                    <div class="mb-12 last:mb-0">
                        <!-- Type Header -->
                        <div class="flex items-center mb-6" >
                            <div class="bg-gradient-to-r from-navy to-blue-700 text-white px-6 py-3 rounded-lg flex items-center shadow-lg">
                                <i class="fas <?php echo $typeIcons[$type]; ?> text-gold text-xl mr-3"></i>
                                <h2 class="text-xl font-bold"><?php echo clean($typeLabels[$type]); ?></h2>
                            </div>
                            <div class="flex-1 h-1 bg-gradient-to-r from-blue-700 to-transparent ml-4"></div>
                        </div>

                        <!-- Documents Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <?php foreach ($docs as $doc): ?>
                                <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 hover-lift group">
                                    <!-- Document Icon Header -->
                                    <div class="bg-gradient-to-br from-navy to-blue-700 p-6 text-center text-white relative overflow-hidden">
                                        <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity"></div>
                                        <i class="fas <?php echo $typeIcons[$type]; ?> text-5xl text-gold mb-3 relative z-10"></i>
                                        <p class="text-sm text-blue-200 font-medium relative z-10">
                                            <?php echo clean($typeLabels[$type]); ?>
                                        </p>
                                    </div>

                                    <!-- Document Details -->
                                    <div class="p-6">
                                        <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2">
                                            <?php echo clean($doc['title']); ?>
                                        </h3>
                                        
                                        <?php if ($doc['description']): ?>
                                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                                <?php echo clean($doc['description']); ?>
                                            </p>
                                        <?php endif; ?>

                                        <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                            <span class="flex items-center">
                                                <i class="far fa-calendar mr-2"></i>
                                                <?php echo date('M d, Y', strtotime($doc['updated_at'])); ?>
                                            </span>
                                            <?php if ($doc['file_size']): ?>
                                                <span class="flex items-center">
                                                    <i class="far fa-file mr-2"></i>
                                                    <?php echo clean($doc['file_size']); ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>

                                        <?php if ($doc['document_file']): ?>
                                            <a href="uploads/disclosure/<?php echo clean($doc['document_file']); ?>" 
                                               target="_blank"
                                               class="block bg-gradient-to-r from-navy to-blue-700 text-white text-center py-3 px-6 rounded-lg hover:from-blue-700 hover:to-navy transition font-semibold shadow-md group-hover:shadow-lg">
                                                <i class="fas fa-download mr-2"></i>
                                                Download Document
                                            </a>
                                        <?php else: ?>
                                            <button class="block w-full bg-gray-100 text-gray-500 text-center py-3 px-6 rounded-lg cursor-not-allowed font-semibold" disabled>
                                                <i class="fas fa-hourglass-half mr-2"></i>
                                                Coming Soon
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <!-- Contact Section -->
            <div class="mt-16 bg-white rounded-2xl shadow-lg p-8 border-t-4 border-navy">
                <div class="md:flex items-center justify-between">
                    <div class="mb-6 md:mb-0">
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">
                            <i class="fas fa-question-circle text-navy mr-2"></i>
                            Need More Information?
                        </h3>
                        <p class="text-gray-600">
                            For any queries regarding these documents, please feel free to contact our administration office.
                        </p>
                    </div>
                    <a href="contact.php" 
                       class="inline-block bg-gradient-to-r from-maroon to-red-700 text-white px-8 py-4 rounded-full hover:from-red-700 hover:to-maroon transition font-semibold shadow-lg hover:shadow-xl whitespace-nowrap">
                        <i class="fas fa-phone-alt mr-2"></i>
                        Contact Us
                    </a>
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
