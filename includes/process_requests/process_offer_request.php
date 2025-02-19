<?php
require_once __DIR__ . '/../../includes/BrevoHandler.php';
require_once __DIR__ . '/../../includes/helpers/recaptcha_helper.php';
require_once __DIR__ . '/../../includes/configuration.php';

header('Content-Type: application/json');

function validateInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

try {
    // Initialize database connection
    if (!isset($connection)) {
        throw new Exception('Database connection not established');
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Metodă invalidă');
    }

    // Verify reCAPTCHA with error logging
    $token = $_POST['g-recaptcha-response'] ?? '';
    if (!$token) {
        throw new Exception('Lipsește tokenul reCAPTCHA');
    }

    $recaptchaResponse = verifyRecaptcha($token);
    if (empty($recaptchaResponse['success'])) {
        error_log('reCAPTCHA verification failed: ' . json_encode($recaptchaResponse));
        throw new Exception('Verificarea reCAPTCHA a eșuat.');
    }

    // Validate and sanitize all inputs
    $data = [
        'product_id' => filter_var($_POST['productId'], FILTER_VALIDATE_INT),
        'product_name' => validateInput($_POST['productName']),
        'company' => validateInput($_POST['company']),
        'cui' => validateInput($_POST['cui']),
        'name' => validateInput($_POST['name']),
        'email' => filter_var($_POST['email'], FILTER_VALIDATE_EMAIL),
        'phone' => validateInput($_POST['phone']),
        'message' => validateInput($_POST['message'] ?? ''),
        'agreement_text' => validateInput($_POST['agreement_text']),
        'ip_address' => filter_var($_POST['ip_address'], FILTER_VALIDATE_IP),
        'agreement_timestamp' => validateInput($_POST['agreement_timestamp'])
    ];

    // Validate required fields
    foreach ($data as $key => $value) {
        if ($value === false || $value === null || $value === '') {
            throw new Exception("Invalid or missing field: $key");
        }
    }

    // Prepare and execute database query with error handling
    $query = "INSERT INTO admin_website_offer_requests 
              (product_id, product_name, company, cui, name, email, phone, message, 
               agreement_text, ip_address, agreement_timestamp) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $connection->prepare($query);
    if (!$stmt) {
        throw new Exception('Database preparation error: ' . $connection->error);
    }

    $stmt->bind_param(
        "issssssssss",
        $data['product_id'],
        $data['product_name'],
        $data['company'],
        $data['cui'],
        $data['name'],
        $data['email'],
        $data['phone'],
        $data['message'],
        $data['agreement_text'],
        $data['ip_address'],
        $data['agreement_timestamp']
    );
    
    if (!$stmt->execute()) {
        throw new Exception('Database execution error: ' . $stmt->error);
    }

    // Add to Brevo with error handling
    $brevo = new BrevoHandler();
    $success = $brevo->addContactPending(
        $data['email'],
        $data['name'],
        $data['company'],
        'offer',
        $data['product_name'],
        [
            'COMPANY' => $data['company'],
            'CUI' => $data['cui'],
            'PHONE' => $data['phone'],
            'MESSAGE' => $data['message']
        ]
    );

    if (!$success) {
        error_log('Brevo integration failed for email: ' . $data['email']);
        throw new Exception('Eroare la înregistrarea solicitării în sistemul de newsletter');
    }

    echo json_encode(['success' => true]);

} catch (Exception $e) {
    error_log('Offer request error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}