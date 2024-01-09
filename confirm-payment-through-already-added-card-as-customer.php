<?php

$secretKey = 'sk_test_51C4xU'; // Replace with your actual secret key
$paymentIntentId = 'pi_3OWYC9'; // Replace with the actual PaymentIntent ID

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_intents/' . $paymentIntentId . '/confirm');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([])); // No additional parameters needed

$headers = [
    'Content-Type: application/x-www-form-urlencoded',
    'Authorization: Bearer ' . $secretKey,
];

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$response = curl_exec($ch);
curl_close($ch);

// Decode the JSON response
$confirmationResult = json_decode($response, true);

// Handle the confirmation result as needed
if (isset($confirmationResult['error'])) {
    // Handle error
    echo json_encode(['error' => $confirmationResult['error']]);
} else {
    // Handle success
    echo json_encode(['clientSecret' => $confirmationResult['client_secret']]);
}
?>
