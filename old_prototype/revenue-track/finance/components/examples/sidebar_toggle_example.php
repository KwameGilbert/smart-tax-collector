<?php
/**
 * Example implementation of the page template
 * This file shows how to use the page template to build a consistent page
 */

// Require the page template
require_once __DIR__ . '/../components/layout/page_template.php';

/**
 * This function renders the main content of the page
 * It will be passed to the page template
 */
function renderPageContent() {
?>
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <h2 class="text-xl font-semibold mb-4">Using the Global Sidebar Toggle</h2>
    <p class="mb-4">This page demonstrates how to use the global sidebar toggle functionality.</p>

    <div class="mb-4">
        <button onclick="toggleSidebar()"
            class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
            Toggle Sidebar
        </button>
        <p class="text-sm text-gray-600 mt-2">
            Click the button above to toggle the sidebar using the global function.
        </p>
    </div>

    <div class="mt-8 text-sm text-gray-600">
        <h3 class="font-semibold mb-2">Implementation Details:</h3>
        <ol class="list-decimal ml-5 space-y-2">
            <li>The global <code>toggleSidebar()</code> function is available on all pages.</li>
            <li>The sidebar overlay is automatically initialized on page load.</li>
            <li>No custom CSS is required - everything uses Tailwind classes.</li>
            <li>The function works on both mobile and desktop layouts.</li>
        </ol>
    </div>
</div>
<?php 
}

// Render the page using the template
renderPage('Example Page', 'example', 'renderPageContent');
?>