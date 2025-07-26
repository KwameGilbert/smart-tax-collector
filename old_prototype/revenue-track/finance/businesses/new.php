<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register New Business - Sefwi Tax Collection</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
    :root {
        --primary-color: #2c3e50;
        --secondary-color: #3498db;
    }

    .sidebar {
        background: var(--primary-color);
        min-height: 100vh;
        padding: 20px;
        color: white;
    }

    .sidebar .nav-link {
        color: rgba(255, 255, 255, 0.8);
        padding: 10px 15px;
        margin: 5px 0;
        border-radius: 5px;
    }

    .sidebar .nav-link:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
    }

    .sidebar .nav-link.active {
        background: var(--secondary-color);
        color: white;
    }

    .main-content {
        padding: 20px;
    }
    </style>
</head>

<body class="bg-light">
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar">
                <h4 class="mb-4">Finance Portal</h4>
                <nav class="nav flex-column">
                    <a class="nav-link" href="/finance/dashboard">
                        <i class='bx bxs-dashboard'></i> Dashboard
                    </a>
                    <a class="nav-link" href="/finance/taxes">
                        <i class='bx bxs-bank'></i> Tax Types
                    </a>
                    <a class="nav-link active" href="/finance/businesses">
                        <i class='bx bxs-business'></i> Businesses
                    </a>
                    <a class="nav-link" href="/finance/payments">
                        <i class='bx bxs-wallet'></i> Payments
                    </a>
                    <a class="nav-link" href="/finance/reports">
                        <i class='bx bxs-report'></i> Reports
                    </a>
                    <a class="nav-link" href="/finance/notifications">
                        <i class='bx bxs-bell'></i> Notifications
                    </a>
                    <a class="nav-link" href="/finance/settings">
                        <i class='bx bxs-cog'></i> Settings
                    </a>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Register New Business</h2>
                    <a href="/finance/businesses" class="btn btn-outline-secondary">
                        <i class='bx bx-arrow-back'></i> Back to Businesses
                    </a>
                </div>

                <div class="card">
                    <div class="card-body">
                        <form id="registerBusinessForm" class="needs-validation" novalidate>
                            <!-- Business Information -->
                            <h5 class="mb-3">Business Information</h5>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="businessName" class="form-label">Business Name</label>
                                    <input type="text" class="form-control" id="businessName" name="name" required>
                                    <div class="invalid-feedback">
                                        Please provide a business name.
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="registrationId" class="form-label">Registration ID/TIN</label>
                                    <input type="text" class="form-control" id="registrationId" name="registration_id"
                                        required>
                                    <div class="invalid-feedback">
                                        Please provide a registration ID.
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="category" class="form-label">Business Category</label>
                                    <select class="form-select" id="category" name="category" required>
                                        <option value="">Select category...</option>
                                        <option value="retail">Retail</option>
                                        <option value="service">Service</option>
                                        <option value="manufacturing">Manufacturing</option>
                                        <option value="other">Other</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a business category.
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="zone" class="form-label">Business Zone</label>
                                    <select class="form-select" id="zone" name="zone" required>
                                        <option value="">Select zone...</option>
                                        <option value="zone1">Zone 1</option>
                                        <option value="zone2">Zone 2</option>
                                        <option value="zone3">Zone 3</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a business zone.
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Information -->
                            <h5 class="mb-3">Contact Information</h5>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid phone number.
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                    <div class="invalid-feedback">
                                        Please provide a valid email address.
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="address" class="form-label">Business Address</label>
                                    <textarea class="form-control" id="address" name="address" rows="2"
                                        required></textarea>
                                    <div class="invalid-feedback">
                                        Please provide a business address.
                                    </div>
                                </div>
                            </div>

                            <!-- Owner Information -->
                            <h5 class="mb-3">Owner Information</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="ownerName" class="form-label">Owner's Full Name</label>
                                    <input type="text" class="form-control" id="ownerName" name="owner_name" required>
                                    <div class="invalid-feedback">
                                        Please provide the owner's name.
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="ownerPhone" class="form-label">Owner's Phone Number</label>
                                    <input type="tel" class="form-control" id="ownerPhone" name="owner_phone" required>
                                    <div class="invalid-feedback">
                                        Please provide the owner's phone number.
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="ownerAddress" class="form-label">Owner's Address</label>
                                    <textarea class="form-control" id="ownerAddress" name="owner_address" rows="2"
                                        required></textarea>
                                    <div class="invalid-feedback">
                                        Please provide the owner's address.
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class='bx bxs-save'></i> Register Business
                                </button>
                                <button type="reset" class="btn btn-outline-secondary ms-2">
                                    <i class='bx bx-reset'></i> Reset Form
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Form validation
    (function() {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms).forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()

    // Handle form submission
    document.getElementById('registerBusinessForm').addEventListener('submit', function(e) {
        e.preventDefault();
        // Here you would typically send the form data to your backend
        // For now, we'll just show a success message
        alert('Business registered successfully!');
        window.location.href = '/finance/businesses';
    });
    </script>
</body>

</html>