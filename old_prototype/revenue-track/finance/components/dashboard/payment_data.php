<?php
/**
 * Recent Payments Data Provider
 * Functions to retrieve recent payment data from the database
 */

require_once __DIR__ . '/../../../database/database.php';

/**
 * Gets the most recent tax payments
 * 
 * @param int $limit Maximum number of records to return
 * @return array Array of recent payment records
 */
function getRecentPayments($limit = 5) {
    $db = Database::getInstance();
    $conn = $db->getConnection();
    
    $result = [];
    
    // SQL to fetch recent payments with business name and tax type
    $query = "SELECT 
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
              ORDER BY 
                p.paid_at DESC
              LIMIT ?";
    
    // Prepare and execute the statement
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        
        while ($row = $stmt_result->fetch_assoc()) {
            $result[] = $row;
        }
        
        $stmt->close();
    }
    
    return $result;
}
?>