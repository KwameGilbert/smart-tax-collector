<?php
// Include the database connection class
require_once __DIR__ . '/../../database/database.php';

// Check authentication
require_once __DIR__ . '/../login/authcheck.php';

// Get database connection
$db = Database::getInstance();
$conn = $db->getConnection();

// Initialize variables
$name = '';
$description = '';
$amount = '';
$frequency = 'monthly';
$applicable_to = '';
$errors = [];
$success = false;

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $amount = floatval($_POST['amount'] ?? 0);
    $frequency = trim($_POST['frequency'] ?? '');
    $applicable_to = trim($_POST['applicable_to'] ?? '');

    // Validation
    if (empty($name)) {
        $errors['name'] = 'Tax name is required';
    }

    if (empty($description)) {
        $errors['description'] = 'Purpose is required';
    }

    if ($amount <= 0) {
        $errors['amount'] = 'Amount must be greater than zero';
    }

    if (empty($frequency)) {
        $errors['frequency'] = 'Frequency is required';
    }

    if (empty($applicable_to)) {
        $errors['applicable_to'] = 'Please specify who this tax applies to';
    }

    // If no errors, insert the new tax type
    if (empty($errors)) {
        $query = "INSERT INTO tax_types (name, description, amount, frequency, applicable_to) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssdss", $name, $description, $amount, $frequency, $applicable_to);
        
        if ($stmt->execute()) {
            $success = true;
            
            // Reset form fields after successful submission
            $name = '';
            $description = '';
            $amount = '';
            $frequency = 'monthly';
            $applicable_to = '';
        } else {
            $errors['db'] = "Database error: " . $conn->error;
        }
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
    <title>Add New Tax Type - Sefwi Tax Collection</title>
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
    </style>
</head>

<body class="min-h-screen bg-white" id="main-body">
    <div class="md:ml-64 flex flex-col min-h-screen transition-all duration-300">
        <?php renderSidebar('taxes', false); ?>

        <!-- Header -->
        <?php renderHeader('Add New Tax Type', false); ?>

        <!-- Main Content -->
        <div class="p-4 md:p-8 bg-gray-100 flex-grow overflow-y-auto">
            <div class="flex items-center mb-6">
                <a href="index.php" class="mr-4 text-blue-600 hover:text-blue-800">
                    <i class="ri-arrow-left-line text-xl"></i>
                </a>
                <h1 class="text-2xl font-bold">Add New Tax Type</h1>
            </div>

            <?php if ($success): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                <div class="flex">
                    <div class="py-1 mr-3">
                        <i class="ri-check-line text-xl"></i>
                    </div>
                    <div>
                        <p class="font-bold">Success!</p>
                        <p class="text-sm">The tax type has been added successfully.</p>
                        <a href="index.php" class="text-green-700 font-medium underline">Return to tax configuration</a>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if (isset($errors['db'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <span><?php echo $errors['db']; ?></span>
            </div>
            <?php endif; ?>

            <div class="bg-white rounded-lg shadow p-6">
                <form method="POST" action="">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Tax Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Tax Name *</label>
                            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2 border <?php echo isset($errors['name']) ? 'border-red-500' : ''; ?>"
                                placeholder="e.g., Business Operating Permit">
                            <?php if (isset($errors['name'])): ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo $errors['name']; ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- Amount -->
                        <div>
                            <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Amount (GHS)
                                *</label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">GHS</span>
                                </div>
                                <input type="number" step="0.01" id="amount" name="amount"
                                    value="<?php echo htmlspecialchars($amount); ?>"
                                    class="block w-full rounded-md border-gray-300 pl-12 focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2 border <?php echo isset($errors['amount']) ? 'border-red-500' : ''; ?>"
                                    placeholder="0.00">
                            </div>
                            <?php if (isset($errors['amount'])): ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo $errors['amount']; ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- Purpose -->
                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Purpose
                                *</label>
                            <textarea id="description" name="description" rows="3"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2 border <?php echo isset($errors['description']) ? 'border-red-500' : ''; ?>"
                                placeholder="Describe the purpose of this tax"><?php echo htmlspecialchars($description); ?></textarea>
                            <?php if (isset($errors['description'])): ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo $errors['description']; ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- Frequency -->
                        <div>
                            <label for="frequency" class="block text-sm font-medium text-gray-700 mb-1">Frequency
                                *</label>
                            <select id="frequency" name="frequency"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2 border <?php echo isset($errors['frequency']) ? 'border-red-500' : ''; ?>">
                                <option value="daily" <?php echo $frequency == 'daily' ? 'selected' : ''; ?>>Daily
                                </option>
                                <option value="weekly" <?php echo $frequency == 'weekly' ? 'selected' : ''; ?>>Weekly
                                </option>
                                <option value="monthly" <?php echo $frequency == 'monthly' ? 'selected' : ''; ?>>Monthly
                                </option>
                                <option value="quarterly" <?php echo $frequency == 'quarterly' ? 'selected' : ''; ?>>
                                    Quarterly</option>
                                <option value="annually" <?php echo $frequency == 'annually' ? 'selected' : ''; ?>>
                                    Annually</option>
                            </select>
                            <?php if (isset($errors['frequency'])): ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo $errors['frequency']; ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- Applicable To -->
                        <div>
                            <label for="applicable_to" class="block text-sm font-medium text-gray-700 mb-1">Applicable
                                To *</label>
                            <input type="text" id="applicable_to" name="applicable_to"
                                value="<?php echo htmlspecialchars($applicable_to); ?>"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2 border <?php echo isset($errors['applicable_to']) ? 'border-red-500' : ''; ?>"
                                placeholder="e.g., All businesses, Property owners">
                            <?php if (isset($errors['applicable_to'])): ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo $errors['applicable_to']; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end">
                        <a href="index.php"
                            class="mr-3 px-4 py-2 border border-gray-300 bg-white text-gray-700 rounded-md shadow-sm hover:bg-gray-50">
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Save Tax Type
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require_once __DIR__ . '/../components/layout/footer.php'; ?>
</body>

</html>