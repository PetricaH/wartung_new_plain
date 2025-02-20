<?php
// confirm.php
require_once __DIR__ . '/vendor/autoload.php';

use Brevo\Client\Api\ContactsApi;
use Brevo\Client\Configuration;
use Brevo\Client\Model\UpdateContact;

function confirmContactInBrevo($email) {
    $config = Configuration::getDefaultConfiguration()
        ->setApiKey('api-key', 'deleted-for-github');
    
    $contactsApi = new ContactsApi(
        new GuzzleHttp\Client(),
        $config
    );
    
    // We'll set CONFIRMED=true
    $updateData = new UpdateContact([
        'attributes' => [
            'CONFIRMED' => true
        ]
    ]);

    try {
        // We call updateContact($identifier, $updateContact)
        // $identifier can be the contact's email or ID
        $result = $contactsApi->updateContact($email, $updateData);
        return true;
    } catch (\Exception $e) {
        echo 'Exception when updating contact: ', $e->getMessage(), PHP_EOL;
        return false;
    }
}

// 1) Get email from query param
$email = $_GET['email'] ?? '';

if ($email && confirmContactInBrevo($email)) {
    echo "<h1>Thank you! Your subscription is confirmed.</h1>";
    // Optionally redirect or display a nicer "thank you" page
} else {
    echo "<h1>Error confirming subscription. Please contact support.</h1>";
}
