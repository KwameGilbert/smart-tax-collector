<?php
/**
 * Database Connection Class
 * 
 * This file provides a reusable database connection for all parts of the Sefwi Tax Collection System
 */

class Database {
    private static $instance = null;
    private $conn;
    
    private $host = 'sql307.infinityfree.com';
    private $user = 'if0_36702081';
    private $pass = '9h7DhdmRJq';
    private $name = 'if0_36702081_sefwi_tax_collection';
    
    private function __construct() {
        try {
            $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->name);
            
            if ($this->conn->connect_error) {
                throw new Exception("Connection failed: " . $this->conn->connect_error);
            }
            
            // Set UTF-8 encoding
            $this->conn->set_charset("utf8mb4");
            
        } catch (Exception $e) {
            // Log error rather than displaying it directly in a production environment
            error_log("Database Connection Error: " . $e->getMessage());
            die("A database connection error occurred. Please try again later.");
        }
    }
    
    /**
     * Gets the singleton instance of the Database class
     * 
     * @return Database The singleton instance
     */
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    
    /**
     * Get the mysqli connection object
     * 
     * @return mysqli The connection object
     */
    public function getConnection() {
        return $this->conn;
    }
    
    /**
     * Prepares a statement with the given SQL query
     * 
     * @param string $sql The SQL query
     * @return mysqli_stmt The prepared statement
     */
    public function prepare($sql) {
        return $this->conn->prepare($sql);
    }
    
    /**
     * Executes a simple query
     * 
     * @param string $sql The SQL query
     * @return mysqli_result|bool Result set or boolean
     */
    public function query($sql) {
        return $this->conn->query($sql);
    }
    
    /**
     * Get the last inserted ID
     * 
     * @return int The last inserted ID
     */
    public function lastInsertId() {
        return $this->conn->insert_id;
    }
    
    /**
     * Begin a transaction
     */
    public function beginTransaction() {
        $this->conn->begin_transaction();
    }
    
    /**
     * Commit a transaction
     */
    public function commit() {
        $this->conn->commit();
    }
    
    /**
     * Rollback a transaction
     */
    public function rollback() {
        $this->conn->rollback();
    }
    
    /**
     * Close the database connection
     */
    public function close() {
        if ($this->conn) {
            $this->conn->close();
            self::$instance = null;
        }
    }
}

// Get database connection
$db = Database::getInstance();
$conn = $db->getConnection();
?>