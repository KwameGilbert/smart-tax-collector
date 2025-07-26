<?php
/**
 * Page template for consistent layout across finance module
 * This file serves as a standardized template for all finance module pages
 * 
 * @param string $title Page title to display
 * @param string $activeItem Current active sidebar item
 * @param callable $contentFunction Function that renders the main content
 */

// Include required components
require_once __DIR__ . '/../components/layout/header.php';
require_once __DIR__ . '/../components/layout/sidebar.php';
require_once __DIR__ . '/../components/layout/footer.php';

function renderPage($title, $activeItem, $contentFunction) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> - Sefwi Tax Collection</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="/../finance/components/shared/app.js"></script>
    <style>
    /* Sidebar styles */
    #main-body.sidebar-open {
        overflow: hidden;
    }

    @media (max-width: 768px) {
        #main-body.sidebar-open {
            margin-left: 0;
        }
    }

    /* Enable scrolling for main content while keeping sidebar fixed */
    .overflow-y-auto {
        height: calc(100vh - 5rem);
        /* Account for header height */
        overflow-y: auto;
        scrollbar-width: thin;
        padding-top: 0.5rem;
    }

    /* Ensure proper layout on all screen sizes */
    @media (min-width: 768px) {
        #sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 16rem;
            z-index: 30;
        }

        .md\:ml-64 {
            margin-left: 16rem;
            padding-top: 0;
        }
    }

    /* Fixed header styles */
    .sticky {
        position: sticky;
        top: 0;
        background-color: white;
        z-index: 40;
    }
    </style>
</head>

<body class="min-h-screen bg-white" id="main-body">
    <?php renderSidebar($activeItem, false); ?>
    <!-- Main Content -->
    <div class="md:ml-64 flex flex-col min-h-screen transition-all duration-300 w-full">
        <!-- Fixed Header -->
        <?php renderHeader($title); ?>

        <!-- Scrollable Content -->
        <div class="p-4 md:p-8 bg-gray-100 flex-grow overflow-y-auto">
            <?php $contentFunction(); ?>
        </div>
    </div>
    <?php require_once __DIR__ . '/../components/layout/footer.php'; ?>
</body>

</html>
<?php
}
?>