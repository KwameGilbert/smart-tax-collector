<?php
// Initialize session and check login
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'finance') {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Unauthorized access']);
    exit;
}

// Include database connection
require_once __DIR__ . '/../../database/database.php';

// Get date range parameter
$range = $_GET['range'] ?? 'all';

// Initialize the date condition
$dateCondition = "";
$taxDateCondition = "";

// Build query conditions based on date range
switch ($range) {
    case 'today':
        $dateCondition = "WHERE DATE(p.paid_at) = CURDATE()";
        $taxDateCondition = "AND DATE(NOW()) BETWEEN bt.start_date AND IFNULL(bt.end_date, DATE_ADD(NOW(), INTERVAL 100 YEAR))";
        break;
        
    case 'yesterday':
        $dateCondition = "WHERE DATE(p.paid_at) = DATE_SUB(CURDATE(), INTERVAL 1 DAY)";
        $taxDateCondition = "AND DATE_SUB(CURDATE(), INTERVAL 1 DAY) BETWEEN bt.start_date AND IFNULL(bt.end_date, DATE_ADD(NOW(), INTERVAL 100 YEAR))";
        break;
        
    case 'week':
        $dateCondition = "WHERE p.paid_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)";
        $taxDateCondition = "AND bt.start_date <= NOW() AND (bt.end_date IS NULL OR bt.end_date >= DATE_SUB(NOW(), INTERVAL 7 DAY))";
        break;
        
    case 'month':
        $dateCondition = "WHERE YEAR(p.paid_at) = YEAR(CURRENT_DATE()) AND MONTH(p.paid_at) = MONTH(CURRENT_DATE())";
        $taxDateCondition = "AND bt.start_date <= NOW() AND (bt.end_date IS NULL OR bt.end_date >= DATE_SUB(NOW(), INTERVAL 1 MONTH))";
        break;
        
    case 'quarter':
        $dateCondition = "WHERE p.paid_at >= DATE_SUB(NOW(), INTERVAL 3 MONTH)";
        $taxDateCondition = "AND bt.start_date <= NOW() AND (bt.end_date IS NULL OR bt.end_date >= DATE_SUB(NOW(), INTERVAL 3 MONTH))";
        break;
        
    case 'half':
        $dateCondition = "WHERE p.paid_at >= DATE_SUB(NOW(), INTERVAL 6 MONTH)";
        $taxDateCondition = "AND bt.start_date <= NOW() AND (bt.end_date IS NULL OR bt.end_date >= DATE_SUB(NOW(), INTERVAL 6 MONTH))";
        break;
        
    case 'year':
        $dateCondition = "WHERE YEAR(p.paid_at) = YEAR(CURRENT_DATE())";
        $taxDateCondition = "AND bt.start_date <= NOW() AND (bt.end_date IS NULL OR bt.end_date >= DATE_SUB(NOW(), INTERVAL 1 YEAR))";
        break;
        
    default: // all time
        $dateCondition = "";
        $taxDateCondition = "";
}

$db = Database::getInstance();
$conn = $db->getConnection();
$response = [];

try {
    // Fetch total revenue with date filter
    $totalRevenueQuery = "SELECT SUM(amount_paid) as total_revenue FROM payments p $dateCondition";
    $totalRevenueResult = $conn->query($totalRevenueQuery);
    $totalRevenue = 0;
    if ($totalRevenueResult && $totalRevenueResult->num_rows > 0) {
        $row = $totalRevenueResult->fetch_assoc();
        $totalRevenue = $row["total_revenue"] ?? 0;
    }
    $response['totalRevenue'] = $totalRevenue;
    
    // Fetch taxpayer count with date filter
    $taxpayersQuery = "SELECT COUNT(DISTINCT b.id) as taxpayer_count 
                      FROM businesses b 
                      JOIN business_taxes bt ON b.id = bt.business_id 
                      WHERE bt.active = 1 $taxDateCondition";
    $taxpayersResult = $conn->query($taxpayersQuery);
    $taxpayerCount = 0;
    if ($taxpayersResult && $taxpayersResult->num_rows > 0) {
        $row = $taxpayersResult->fetch_assoc();
        $taxpayerCount = $row["taxpayer_count"] ?? 0;
    }
    $response['taxpayerCount'] = $taxpayerCount;
    
    // Calculate collection rate with date filter
    $collectionRateQuery = "SELECT 
                           (COUNT(DISTINCT p.business_tax_id) * 100 / 
                           (SELECT COUNT(*) FROM business_taxes WHERE active = 1 $taxDateCondition)) as collection_rate 
                           FROM payments p 
                           JOIN business_taxes bt ON p.business_tax_id = bt.id 
                           $dateCondition";
    $collectionRateResult = $conn->query($collectionRateQuery);
    $collectionRate = 0;
    if ($collectionRateResult && $collectionRateResult->num_rows > 0) {
        $row = $collectionRateResult->fetch_assoc();
        $collectionRate = $row["collection_rate"] ?? 0;
    }
    $response['collectionRate'] = $collectionRate;
    
    // Fetch overdue taxes with date filter
    $overdueQuery = "SELECT SUM(tt.amount) as overdue_amount
                    FROM business_taxes bt
                    JOIN tax_types tt ON bt.tax_type_id = tt.id
                    WHERE bt.active = 1 
                    $taxDateCondition
                    AND bt.id NOT IN (SELECT business_tax_id FROM payments p $dateCondition)";
    $overdueResult = $conn->query($overdueQuery);
    $overdueAmount = 0;
    if ($overdueResult && $overdueResult->num_rows > 0) {
        $row = $overdueResult->fetch_assoc();
        $overdueAmount = $row["overdue_amount"] ?? 0;
    }
    $response['overdueAmount'] = $overdueAmount;
    
    // Fetch monthly revenue data for chart with date filter
    $timePeriod = "6 MONTH"; // Default time period
    switch ($range) {
        case 'today':
        case 'yesterday':
            $timePeriod = "24 HOUR";
            $groupBy = "DATE_FORMAT(paid_at, '%H:00')";
            $labelFormat = 'H:00';
            break;
        case 'week':
            $timePeriod = "7 DAY";
            $groupBy = "DATE(paid_at)";
            $labelFormat = 'D, M d';
            break;
        case 'month':
            $timePeriod = "1 MONTH";
            $groupBy = "DATE(paid_at)";
            $labelFormat = 'M d';
            break;
        case 'quarter':
            $timePeriod = "3 MONTH";
            $groupBy = "WEEK(paid_at)";
            $labelFormat = 'Week %v';
            break;
        case 'half':
            $timePeriod = "6 MONTH";
            $groupBy = "DATE_FORMAT(paid_at, '%Y-%m')";
            $labelFormat = 'M Y';
            break;
        case 'year':
            $timePeriod = "12 MONTH";
            $groupBy = "DATE_FORMAT(paid_at, '%Y-%m')";
            $labelFormat = 'M Y';
            break;
        default:
            $timePeriod = "6 MONTH";
            $groupBy = "DATE_FORMAT(paid_at, '%Y-%m')";
            $labelFormat = 'M Y';
    }
    
    // Adjust query based on range
    if ($range === 'today' || $range === 'yesterday') {
        $dateSubClause = ($range === 'today') ? "WHERE DATE(paid_at) = CURDATE()" : "WHERE DATE(paid_at) = DATE_SUB(CURDATE(), INTERVAL 1 DAY)";
        $monthlyRevenueQuery = "SELECT 
                              DATE_FORMAT(paid_at, '%H:00') as period,
                              SUM(amount_paid) as period_revenue
                              FROM payments
                              $dateSubClause
                              GROUP BY period
                              ORDER BY period ASC";
    } else {
        $monthlyRevenueQuery = "SELECT 
                              $groupBy as period,
                              SUM(amount_paid) as period_revenue
                              FROM payments p
                              " . ($dateCondition ? $dateCondition : "WHERE p.paid_at >= DATE_SUB(NOW(), INTERVAL $timePeriod)") . "
                              GROUP BY period
                              ORDER BY period ASC";
    }
    
    $monthlyRevenueResult = $conn->query($monthlyRevenueQuery);
    $periodRevenue = [];
    $periodLabels = [];
    
    if ($monthlyRevenueResult && $monthlyRevenueResult->num_rows > 0) {
        while ($row = $monthlyRevenueResult->fetch_assoc()) {
            $periodLabels[] = ($range === 'today' || $range === 'yesterday') ? $row["period"] : date($labelFormat, strtotime($row["period"] . (strpos($row["period"], '-') !== false ? '-01' : '')));
            $periodRevenue[] = (float)$row["period_revenue"];
        }
    }
    $response['periodLabels'] = $periodLabels;
    $response['periodRevenue'] = $periodRevenue;
    
    // Fetch tax type distribution with date filter
    $taxDistributionQuery = "SELECT tt.name, 
                           (SUM(p.amount_paid) * 100 / (SELECT SUM(amount_paid) FROM payments p2 $dateCondition)) as percentage
                           FROM payments p
                           JOIN business_taxes bt ON p.business_tax_id = bt.id
                           JOIN tax_types tt ON bt.tax_type_id = tt.id
                           $dateCondition
                           GROUP BY tt.id
                           ORDER BY percentage DESC";
    $taxDistributionResult = $conn->query($taxDistributionQuery);
    $taxTypes = [];
    $taxPercentages = [];
    
    if ($taxDistributionResult && $taxDistributionResult->num_rows > 0) {
        while ($row = $taxDistributionResult->fetch_assoc()) {
            $taxTypes[] = $row["name"];
            $taxPercentages[] = (float)$row["percentage"];
        }
    }
    $response['taxTypes'] = $taxTypes;
    $response['taxPercentages'] = $taxPercentages;
    
    // Fetch recent payments with date filter
    $recentPaymentsQuery = "SELECT 
                          p.id,
                          b.name as business_name,
                          tt.name as tax_type,
                          p.paid_at as payment_date,
                          p.amount_paid,
                          p.payment_method
                        FROM 
                          payments p
                        JOIN 
                          business_taxes bt ON p.business_tax_id = bt.id
                        JOIN 
                          businesses b ON bt.business_id = b.id
                        JOIN 
                          tax_types tt ON bt.tax_type_id = tt.id
                        $dateCondition
                        ORDER BY 
                          p.paid_at DESC
                        LIMIT 5";
    
    $recentPaymentsResult = $conn->query($recentPaymentsQuery);
    $recentPayments = [];
    
    if ($recentPaymentsResult && $recentPaymentsResult->num_rows > 0) {
        while ($row = $recentPaymentsResult->fetch_assoc()) {
            $recentPayments[] = [
                'business_name' => $row['business_name'],
                'tax_type' => $row['tax_type'],
                'payment_date' => $row['payment_date'],
                'amount_paid' => $row['amount_paid'],
                'payment_method' => $row['payment_method']
            ];
        }
    }
    $response['recentPayments'] = $recentPayments;
    
    // Return success response
    $response['success'] = true;
    $response['rangeName'] = getRangeName($range);
    
} catch (Exception $e) {
    $response['success'] = false;
    $response['error'] = "Database error: " . $e->getMessage();
}

// Helper function to get human-readable range name
function getRangeName($range) {
    switch ($range) {
        case 'today': return 'Today';
        case 'yesterday': return 'Yesterday';
        case 'week': return 'Last 7 Days';
        case 'month': return 'This Month';
        case 'quarter': return 'This Quarter';
        case 'half': return 'Last 6 Months';
        case 'year': return 'This Year';
        default: return 'All Time';
    }
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>