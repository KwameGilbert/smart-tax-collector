<?php
/**
 * Sefwi Tax Collection System
 * Collector Login Page
 * 
 * This page allows tax collectors to log in to the system.
 * It includes form validation, password hashing, and session management.
 * 
 * @package SefwiTaxCollection
 * @version 1.0
 * @author Gilbert Elikplim Kukah
 * @license MIT
 */
/**
 * Sefwi Tax Collection System
 * Collector Login Page
 */

// Start session
session_start();

// Include database connection
require_once '../../database/database.php';

// Check if already logged in
if (isset($_SESSION['collector_id'])) {
    header('Location: ../dashboard/index.php');
    exit();
}

// Process login attempt
$login_error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $identifier = trim($_POST['identifier']); // This can be email or collector ID
    $password = trim($_POST['password']);
    
    if (empty($identifier) || empty($password)) {
        $login_error = 'Please enter both your Collector ID/Email and Password.';
    } else {
        // TEMPORARY HARDCODED LOGIN FOR TESTING
        // ----- START OF HARDCODED LOGIN -----
        if ($identifier === 'kwamegilbert1114@gmail.com' && $password === '1234') {
            // Set dummy session information
            session_regenerate_id();
            
            // Store dummy data in session variables
            $_SESSION['collector_id'] = 'COL-2023-001';
            $_SESSION['full_name'] = 'Gilbert Elikplim Kukah';
            $_SESSION['email'] = 'kwamegilbert1114@gmail.com';
            $_SESSION['user_type'] = 'collector';
            $_SESSION['last_activity'] = time();
            
            // Redirect to dashboard
            header('Location: ../dashboard/index.php');
            exit();
        } else {
            $login_error = 'Invalid credentials. Please try again.';
        }
        // ----- END OF HARDCODED LOGIN -----

        /*
        // ----- START OF ACTUAL DATABASE LOGIN LOGIC -----
        // Get database connection
        $db = Database::getInstance();
        $conn = $db->getConnection();
        
        // Prepare statement to search by either collector ID or email
        $sql = "SELECT collector_id, full_name, email, password_hash, status 
                FROM collectors 
                WHERE (email = ? OR collector_id = ?) AND status = 'active'";
        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ss", $identifier, $identifier);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows === 1) {
                $collector = $result->fetch_assoc();
                
                // Verify password
                if (password_verify($password, $collector['password_hash'])) {
                    // Password is correct, start a new session
                    session_regenerate_id();
                    
                    // Store data in session variables
                    $_SESSION['collector_id'] = $collector['collector_id'];
                    $_SESSION['full_name'] = $collector['full_name'];
                    $_SESSION['email'] = $collector['email'];
                    $_SESSION['user_type'] = 'collector';
                    $_SESSION['last_activity'] = time();
                    
                    // Log the login activity
                    $log_sql = "INSERT INTO activity_logs (user_id, user_type, activity_type, details, ip_address)
                                VALUES (?, 'collector', 'login', 'Successful login', ?)";
                    if ($log_stmt = $conn->prepare($log_sql)) {
                        $ip = $_SERVER['REMOTE_ADDR'];
                        $log_stmt->bind_param("ss", $collector['collector_id'], $ip);
                        $log_stmt->execute();
                        $log_stmt->close();
                    }
                    
                    // Redirect to dashboard
                    header('Location: ../dashboard/index.php');
                    exit();
                } else {
                    $login_error = 'The password you entered is incorrect.';
                }
            } else {
                $login_error = 'No account found with that Collector ID or Email.';
            }
            
            $stmt->close();
        } else {
            $login_error = 'Something went wrong. Please try again later.';
        }
        // ----- END OF ACTUAL DATABASE LOGIN LOGIC -----
        */
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tax Collector Login | Sefwi Tax Collection</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
    :root {
        --primary-color: #4E9F3D;
        --secondary-color: #1E5128;
        --accent-color: #D8E9A8;
        --dark-color: #191A19;
        --light-color: #F5F5F5;
    }

    body {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        padding: 20px;
    }

    .login-container {
        background-color: rgba(255, 255, 255, 0.95);
        border-radius: 15px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        width: 100%;
        max-width: 900px;
        display: flex;
    }

    .login-image {
        flex: 1;
        background-image: url('https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1936&q=80');
        background-size: cover;
        background-position: center;
        position: relative;
        display: none;
    }

    @media (min-width: 768px) {
        .login-image {
            display: block;
        }
    }

    .login-image::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(78, 159, 61, 0.7), rgba(30, 81, 40, 0.7));
    }

    .login-content {
        flex: 1;
        padding: 40px;
    }

    .login-header {
        margin-bottom: 30px;
        text-align: center;
    }

    .login-header h1 {
        color: var(--secondary-color);
        font-weight: 700;
        font-size: 2rem;
        margin-bottom: 10px;
    }

    .login-header p {
        color: #666;
    }

    .login-logo {
        max-width: 120px;
        margin-bottom: 20px;
    }

    .form-floating {
        margin-bottom: 20px;
    }

    .form-control {
        border-radius: 8px;
        padding: 12px;
        height: calc(3.5rem + 2px);
        border: 1px solid #ddd;
    }

    .form-floating label {
        padding: 1rem 1rem;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(78, 159, 61, 0.25);
    }

    .btn-login {
        background-color: var(--primary-color);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 12px 20px;
        font-weight: 600;
        width: 100%;
        margin-top: 10px;
        transition: all 0.3s ease;
    }

    .btn-login:hover {
        background-color: var(--secondary-color);
        transform: translateY(-2px);
    }

    .login-footer {
        text-align: center;
        margin-top: 30px;
        color: #666;
    }

    .login-footer a {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 500;
    }

    .login-footer a:hover {
        color: var(--secondary-color);
    }

    .alert {
        border-radius: 8px;
        font-size: 14px;
    }

    .input-group-text {
        background-color: transparent;
        cursor: pointer;
    }

    .watermark {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        color: white;
        font-weight: 600;
        z-index: 1;
        text-align: center;
        font-size: 1.2rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
    }

    .features {
        display: flex;
        justify-content: space-between;
        margin-top: 30px;
        margin-bottom: 20px;
    }

    .feature {
        display: flex;
        align-items: center;
        color: #666;
        font-size: 14px;
    }

    .feature i {
        color: var(--primary-color);
        margin-right: 5px;
    }

    .remember-me {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-image">
            <div class="watermark">Sefwi Tax Collection System</div>
        </div>
        <div class="login-content">
            <div class="login-header">
                <h1>Tax Collector Portal</h1>
                <p>Enter your credentials to access your account</p>
            </div>

            <?php if (!empty($login_error)): ?>
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i> <?php echo htmlspecialchars($login_error); ?>
            </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class="form-floating">
                    <input type="text" class="form-control" id="identifier" name="identifier"
                        placeholder="Collector ID or Email" required>
                    <label for="identifier"><i class="fas fa-user me-2"></i> Collector ID or Email</label>
                </div>

                <div class="form-floating">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                        required>
                    <label for="password"><i class="fas fa-lock me-2"></i> Password</label>
                </div>

                <div class="remember-me">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">
                            Remember me
                        </label>
                    </div>
                    <a href="forgot_password.php" class="ms-auto">Forgot Password?</a>
                </div>

                <div class="features">
                    <div class="feature">
                        <i class="fas fa-shield-alt"></i>
                        <span>Secure Login</span>
                    </div>
                    <div class="feature">
                        <i class="fas fa-database"></i>
                        <span>Data Protection</span>
                    </div>
                    <div class="feature">
                        <i class="fas fa-clock"></i>
                        <span>24/7 Support</span>
                    </div>
                </div>

                <button type="submit" name="login" class="btn btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i> Log In
                </button>
            </form>

            <div class="text-center py-2 text-xs text-gray-500">
                <span>Developed by</span>
                <a href="tel:+233541436414" class="mx-1 font-medium inline-flex items-center group">
                    <span class="text-collector group-hover:text-finance transition-colors">Gilbert Elikplim
                        Kukah</span>
                    <i class="ri-arrow-right-up-line ml-0.5 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                </a>
                <span class="px-1 text-gray-300">|</span>
                <a href="tel:+233541436414" class="hover:text-collector transition-colors">0541436414</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    // Password visibility toggle
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        const togglePassword = document.createElement('i');
        togglePassword.className = 'fas fa-eye-slash';
        togglePassword.style.position = 'absolute';
        togglePassword.style.right = '15px';
        togglePassword.style.top = '50%';
        togglePassword.style.transform = 'translateY(-50%)';
        togglePassword.style.cursor = 'pointer';
        togglePassword.style.color = '#999';
        togglePassword.style.zIndex = '10';

        passwordInput.parentElement.style.position = 'relative';
        passwordInput.parentElement.appendChild(togglePassword);

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.className = type === 'password' ? 'fas fa-eye-slash' : 'fas fa-eye';
        });
    });
    </script>
</body>

</html>