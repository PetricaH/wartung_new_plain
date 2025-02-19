<?php
require_once __DIR__ . '/../../includes/BrevoHandler.php';
require_once __DIR__ . '/../../includes/helpers/recaptcha_helper.php';
require_once __DIR__ . '/../../includes/configuration.php';

header('Content-Type: application/json');


try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Metodă invalidă');
    }

    // 1) Verify reCAPTCHA
    $token = $_POST['g-recaptcha-response'] ?? '';
    if (!$token) {
        throw new Exception('Lipsește tokenul reCAPTCHA');
    }

    $recaptchaResponse = verifyRecaptcha($token);
    if (empty($recaptchaResponse['success']) || $recaptchaResponse['success'] !== true) {
        throw new Exception('Verificarea reCAPTCHA a eșuat.');
    }

    // Validate required fields
    $required = ['productId', 'productName', 'email'];
    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            throw new Exception("Câmp obligatoriu lipsă: $field");
        }
    }

    // Prepare data for database
    $data = [
        'product_id' => intval($_POST['productId']),
        'product_name' => strip_tags($_POST['productName']),
        'email' => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
        'agreement_text' => $_POST['agreement_text'],
        'ip_address' => $_POST['ip_address'],
        'agreement_timestamp' => $_POST['agreement_timestamp']
    ];

    // Insert into database
    $query = "INSERT INTO admin_website_datasheet_requests 
              (product_id, product_name, email, agreement_text, ip_address, agreement_timestamp) 
              VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = $connection->prepare($query);
    $stmt->bind_param(
        "isssss",
        $data['product_id'],
        $data['product_name'],
        $data['email'],
        $data['agreement_text'],
        $data['ip_address'],
        $data['agreement_timestamp']
    );
    
    if (!$stmt->execute()) {
        throw new Exception('Database error: ' . $stmt->error);
    }

    // Add to Brevo pending list
    $brevo = new BrevoHandler();
    $success = $brevo->addContactPending(
        $data['email'],
        '', // No first name
        '', // No last name
        'datasheet',
        $data['product_name'],
        [] // No extra attributes
    );

    if (!$success) {
        throw new Exception('Eroare la înregistrarea solicitării');
    }

    echo json_encode(['success' => true]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}