<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Brevo\Client\Api\ContactsApi;
use Brevo\Client\Configuration;
use Brevo\Client\Model\CreateContact;
use Brevo\Client\Model\UpdateContact;

class BrevoHandler {
    private $apiKey = 'apikey-deleted-bcs-of-github';
    private $pendingListId = 208;
    private $confirmedListId = 209;

    /**
     * Add a contact to the pending list
     * 
     * @param string $email
     * @param string $name Full name that will be split into first and last name
     * @param string $company
     * @param string $type
     * @param string $productName
     * @param array $attributes Additional attributes
     * @return bool
     */
    public function addContactPending($email, $name, $company, $type, $productName, $attributes = [])
    {
        try {
            // Split full name into first and last name
            $nameParts = explode(' ', $name, 2);
            $firstName = $nameParts[0];
            $lastName = isset($nameParts[1]) ? $nameParts[1] : '';

            // Initialize API configuration
            $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', $this->apiKey);
            $contactsApi = new ContactsApi(new \GuzzleHttp\Client(), $config);

            // Prepare base attributes
            $contactAttributes = [
                'FIRSTNAME' => $firstName,
                'LASTNAME' => $lastName,
                'COMPANY' => $company,
                'REQUEST_TYPE' => $type,
                'PRODUCT_NAME' => $productName,
                'SIGNUP_DATE' => date('Y-m-d')
            ];

            // Merge additional attributes, ensuring keys are uppercase
            foreach ($attributes as $key => $value) {
                $contactAttributes[strtoupper($key)] = $value;
            }

            // Create contact data
            $contactData = new CreateContact([
                'email' => $email,
                'listIds' => [$this->pendingListId],
                'updateEnabled' => true,
                'attributes' => $contactAttributes
            ]);

            // Attempt to create/update contact
            $result = $contactsApi->createContact($contactData);
            
            // Log success
            error_log("Contact successfully added to Brevo: " . $email);
            return true;

        } catch (\Brevo\Client\ApiException $e) {
            // Log detailed API error
            error_log("Brevo API Error: " . $e->getMessage());
            error_log("Error Response: " . $e->getResponseBody());
            error_log("Error Code: " . $e->getCode());
            return false;

        } catch (\Exception $e) {
            // Log general errors
            error_log("Brevo General Error: " . $e->getMessage());
            error_log("Error details: " . json_encode([
                'email' => $email,
                'name' => $name,
                'company' => $company,
                'type' => $type,
                'product' => $productName
            ]));
            return false;
        }
    }

    /**
     * Move a contact from pending to confirmed list
     * 
     * @param string $email
     * @return bool
     */
    public function confirmContact($email)
    {
        try {
            // Initialize API configuration
            $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', $this->apiKey);
            $contactsApi = new ContactsApi(new \GuzzleHttp\Client(), $config);

            // Prepare update data
            $updateData = new UpdateContact([
                'listIds' => [$this->confirmedListId],
                'unlinkListIds' => [$this->pendingListId]
            ]);

            // Update the contact
            $contactsApi->updateContact($email, $updateData);
            
            // Log success
            error_log("Contact successfully confirmed in Brevo: " . $email);
            return true;

        } catch (\Brevo\Client\ApiException $e) {
            // Log detailed API error
            error_log("Brevo Confirmation API Error: " . $e->getMessage());
            error_log("Error Response: " . $e->getResponseBody());
            error_log("Error Code: " . $e->getCode());
            return false;

        } catch (\Exception $e) {
            // Log general errors
            error_log("Brevo Confirmation Error: " . $e->getMessage());
            return false;
        }
    }
}