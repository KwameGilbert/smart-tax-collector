<?php
// Include the database connection class
require_once __DIR__ . '/../../database/database.php';

// Check authentication
require_once __DIR__ . '/../login/authcheck.php';

// Get database connection
$db = Database::getInstance();
$conn = $db->getConnection();

// Process delete request if present
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $taxId = intval($_GET['delete']);
    
    // Check if the tax is in use before deletion
    $checkQuery = "SELECT COUNT(*) as count FROM business_taxes WHERE tax_type_id = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("i", $taxId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    if ($row['count'] > 0) {
        $deleteError = "Cannot delete this tax type as it's currently assigned to businesses.";
    } else {
        $deleteQuery = "DELETE FROM tax_types WHERE id = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("i", $taxId);
        
        if ($stmt->execute()) {
            $deleteSuccess = "Tax type deleted successfully.";
        } else {
            $deleteError = "Error deleting tax type: " . $conn->error;
        }
    }
}

// Fetch all tax types
$query = "SELECT 
            tt.id, 
            tt.name, 
            tt.description, 
            tt.amount,
            tt.frequency
          FROM 
            tax_types tt
          ORDER BY 
            tt.name ASC";

$result = $conn->query($query);
$taxTypes = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $taxTypes[] = $row;
    }
}

// Include components
require_once __DIR__ . '/../components/layout/header.php';
require_once __DIR__ . '/../components/layout/sidebar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tax Configuration - Sefwi Tax Collection</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="/../finance/components/shared/app.js"></script>
    <style>
    /* Fixed header styles */
    .overflow-y-auto {
        height: calc(100vh - 5rem);
        padding-top: 0.5rem;
    }

    /* Ensure sidebar is above everything except header */
    #sidebar {
        z-index: 30;
    }

    /* Prevent content from going under header */
    .md\:ml-64 {
        padding-top: 0;
    }

    /* Loading overlay */
    #loading-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(255, 255, 255, 0.7);
        z-index: 9999;
    }

    .spinner {
        border-radius: 50%;
        width: 40px;
        height: 40px;
        border: 4px solid rgba(59, 130, 246, 0.3);
        border-top-color: #3B82F6;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
    </style>
</head>

<body class="min-h-screen bg-white" id="main-body">
    <!-- Loading Overlay -->
    <div id="loading-overlay" class="flex items-center justify-center">
        <div class="spinner"></div>
    </div>

    <div class="md:ml-64 flex flex-col min-h-screen transition-all duration-300">
        <?php renderSidebar('taxes', false); ?>

        <!-- Header -->
        <?php renderHeader('Tax Configuration', false); ?>

        <!-- Main Content -->
        <div class="p-4 md:p-8 bg-gray-100 flex-grow overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Tax Configuration</h1>
                <a href="add.php"
                    class="flex items-center gap-2 bg-blue-900 hover:bg-blue-800 text-white px-4 py-2 rounded-md shadow-sm">
                    <i class="ri-add-line"></i>
                    Add New Tax Type
                </a>
            </div>

            <?php if (isset($deleteSuccess)): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <span><?php echo $deleteSuccess; ?></span>
            </div>
            <?php endif; ?>

            <?php if (isset($deleteError)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <span><?php echo $deleteError; ?></span>
            </div>
            <?php endif; ?>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="mb-4">
                    <h2 class="text-xl font-semibold">Configured Tax Types</h2>
                    <p class="text-gray-500 text-sm">Manage all tax types that can be assigned to taxpayers</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tax Name</th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Purpose</th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Amount (GHS)</th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Frequency</th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if (empty($taxTypes)): ?>
                            <tr>
                                <td colspan="5" class="px-4 py-4 text-center text-gray-500">No tax types found. Click
                                    "Add New Tax Type" to create one.</td>
                            </tr>
                            <?php else: ?>
                            <?php foreach ($taxTypes as $tax): ?>
                            <tr>
                                <td class="px-4 py-4 whitespace-nowrap font-medium">
                                    <?php echo htmlspecialchars($tax['name']); ?></td>
                                <td class="px-4 py-4"><?php echo htmlspecialchars($tax['description']); ?></td>
                                <td class="px-4 py-4 whitespace-nowrap"><?php echo number_format($tax['amount'], 2); ?>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                        <?php 
                                                    $frequencies = [
                                                        'daily' => 'Daily',
                                                        'weekly' => 'Weekly',
                                                        'monthly' => 'Monthly',
                                                        'quarterly' => 'Quarterly',
                                                        'annually' => 'Annually'
                                                    ];
                                                    echo $frequencies[$tax['frequency']] ?? ucfirst($tax['frequency']);
                                                ?>
                                    </span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm">
                                    <div class="flex space-x-3">
                                        <a href="edit.php?id=<?php echo $tax['id']; ?>"
                                            class="text-blue-600 hover:text-blue-900">
                                            <i class="ri-pencil-line text-lg"></i>
                                        </a>
                                        <button
                                            onclick="confirmDelete(<?php echo $tax['id']; ?>, '<?php echo addslashes($tax['name']); ?>')"
                                            class="text-red-600 hover:text-red-900">
                                            <i class="ri-delete-bin-line text-lg"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Confirm Deletion</h3>
                <p class="text-gray-600 mb-6">Are you sure you want to delete the tax type: <span id="taxTypeToDelete"
                        class="font-semibold"></span>?</p>
                <p class="text-sm text-red-600 mb-6">This action cannot be undone if the tax type is not in use.</p>
                <div class="flex justify-end gap-3">
                    <button id="cancelDelete"
                        class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-md">Cancel</button>
                    <a id="confirmDeleteBtn" href="#"
                        class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <script>
    function confirmDelete(id, name) {
        // Set the tax name in the modal
        document.getElementById('taxTypeToDelete').textContent = name;

        // Set the delete link
        document.getElementById('confirmDeleteBtn').href = `index.php?delete=${id}`;

        // Show the modal
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    document.getElementById('cancelDelete').addEventListener('click', function() {
        document.getElementById('deleteModal').classList.add('hidden');
    });

    // Close modal when clicking outside
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
        }
    });
    </script>

    <?php require_once __DIR__ . '/../components/layout/footer.php'; ?>
</body>

</html>