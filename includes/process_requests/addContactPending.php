<?php
require_once __DIR__ . '/vendor/autoload.php';

use Brevo\Client\Api\ContactsApi;
use Brevo\Client\Configuration;
use Brevo\Client\Model\CreateContact;

/**
 * Add or update a contact in Brevo with CONFIRMED=false
 * to trigger the double opt-in workflow.
 */
function addContactToBrevoPending($email, $firstName, $lastName) {
    // 1) Configure your Brevo API key
    $config = Configuration::getDefaultConfiguration()
        ->setApiKey('api-key', 'deleted-for-github');

    // 2) Instantiate the Contacts API client
    $contactsApi = new ContactsApi(
        new GuzzleHttp\Client(),
        $config
    );

    // 3) Build the contact data
    $contactData = new CreateContact([
        'email' => $email,
        'attributes' => [
            'FIRSTNAME' => $firstName,
            'LASTNAME'  => $lastName,
            'CONFIRMED' => false // custom attribute
        ],
        'updateEnabled' => true // if contact exists, update it
    ]);

    // 4) Call the API to create or update the contact
    try {
        $result = $contactsApi->createContact($contactData);
        // If successful, Brevo returns a 201 response
        return true;
    } catch (\Exception $e) {
        // If the contact already exists, Brevo might return 400 or 409.
        // But "updateEnabled" should handle that.
        echo 'Exception when creating contact: ', $e->getMessage(), PHP_EOL;
        return false;
    }
}

// Example usage: form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $name  = $_POST['name'] ?? '';

    // You can parse firstName/lastName if you want
    $firstName = $name;
    $lastName  = '';

    if (addContactToBrevoPending($email, $firstName, $lastName)) {
        echo "Thanks! Check your inbox for a confirmation link.";
    } else {
        echo "Error adding you to the list. Please try again.";
    }
}
