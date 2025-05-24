<?php
$apiKey = 'YOUR_COHERE_API_KEY'; // Replace with real one

$payload = json_encode([
    "model" => "command",
    "prompt" => "Write a short professional resume for a software developer with 3 years of experience in React, JavaScript, and PHP.",
    "max_tokens" => 300,
    "temperature" => 0.7
]);

$ch = curl_init("https://api.cohere.ai/v1/generate");
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $payload,
    CURLOPT_HTTPHEADER => [
        "Authorization: Bearer $apiKey",
        "Content-Type: application/json",
        "Cohere-Version: 2022-12-06"
    ]
]);

$response = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

header('Content-Type: application/json');
echo json_encode([
    "status" => $httpcode,
    "response" => json_decode($response, true)
]);
