<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$email = isset($data['email']) ? trim($data['email']) : '';

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid email']);
    exit;
}

$payload = json_encode([
    'email'               => $email,
    'reactivate_existing' => false,
    'send_welcome_email'  => true,
    'utm_source'          => 'website',
    'utm_medium'          => 'organic',
]);

$ch = curl_init('https://api.beehiiv.com/v2/publications/pub_b57e4531-01f4-4068-aaac-5dff55a7f0c8/subscriptions');
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => $payload,
    CURLOPT_HTTPHEADER     => [
        'Content-Type: application/json',
        'Authorization: Bearer DUv6Ho7EjGfKOGy6uccjKA9of5RZsQpkh3Sx2NUtfLQiJez7w4l7UrPjrHYTPnRJ',
    ],
]);

$response = curl_exec($ch);
$status   = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

http_response_code($status);
echo $response;
