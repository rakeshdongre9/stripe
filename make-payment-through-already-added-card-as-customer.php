<?php

// Set your Stripe secret key
$secretKey = 'sk_test_51C4xU2J';
$customerID = 'cus_PLDk'; // Replace with the actual customer ID
$cardID = 'card_1OWXKpJ'; // Replace with the actual card ID

// Create a PaymentIntent on your server
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_intents');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    'amount' => 1000, // Replace with the actual amount in cents
    'currency' => 'usd',
    'customer' => $customerID,
    'payment_method' => $cardID,
]));

$headers = [
    'Content-Type: application/x-www-form-urlencoded',
    'Authorization: Bearer ' . $secretKey,
];

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$response = curl_exec($ch);
curl_close($ch);

// Decode the JSON response
$paymentIntent = json_decode($response, true);

// Handle the paymentIntent object as needed
if (isset($paymentIntent['client_secret'])) {
    echo json_encode(['clientSecret' => $paymentIntent['client_secret']]);
} else {
    echo json_encode(['error' => $paymentIntent]);
}
