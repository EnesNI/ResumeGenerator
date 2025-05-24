<?php
require_once 'autoload.php';
use Smalot\PdfParser\Parser;

function extractTextFromResume($filePath, $fileType) {
    if ($fileType === 'pdf') {
        $parser = new Parser();
        $pdf = $parser->parseFile($filePath);
        return $pdf->getText();
    } elseif ($fileType === 'txt') {
        return file_get_contents($filePath);
    } else {
        return '';
    }
}

function calculateJobMatch($resumeText, $jobText) {
    $resumeWords = array_count_values(str_word_count(strtolower($resumeText), 1));
    $jobWords = array_unique(str_word_count(strtolower($jobText), 1));

    $matches = 0;
    foreach ($jobWords as $word) {
        if (isset($resumeWords[$word])) {
            $matches++;
        }
    }

    $score = ($matches / count($jobWords)) * 100;
    return round($score);
}

function detectAIContent($text) {
    $aiIndicators = [
        "passionate", "dedicated professional", "proven track record",
        "results-driven", "strong communication skills", "leveraged", 
        "utilized", "accomplished", "synergy", "empowered", "dynamic individual"
    ];

    $count = 0;
    foreach ($aiIndicators as $phrase) {
        if (stripos($text, $phrase) !== false) {
            $count++;
        }
    }

    $probability = min(100, $count * 10);
    return $probability; // return as percentage
}

function getSimilarityScore($resumeText, $jobDescription, $apiKey)
{
    $url = "https://api.cohere.ai/v1/embed";
    $headers = [
        "Authorization: Bearer $apiKey",
        "Content-Type: application/json",
        "Cohere-Version: 2022-12-06"
    ];

    $data = [
        "texts" => [$resumeText, $jobDescription],
        "model" => "embed-english-v3.0",
        "input_type" => "search_document"
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);

    if (!isset($result['embeddings']) || count($result['embeddings']) !== 2) {
        return null; // Error
    }

    // Cosine similarity calculation
    $a = $result['embeddings'][0];
    $b = $result['embeddings'][1];
    $dotProduct = 0;
    $normA = 0;
    $normB = 0;

    for ($i = 0; $i < count($a); $i++) {
        $dotProduct += $a[$i] * $b[$i];
        $normA += $a[$i] * $a[$i];
        $normB += $b[$i] * $b[$i];
    }

    $similarity = $dotProduct / (sqrt($normA) * sqrt($normB));
    return round($similarity * 100); // Return percentage
}

function analyzeWithAI($resumeText, $jobDescription) {
    $apiKey = 'fHtGUtc0nPqPdizte9rFayjFCQxZGqjrhkE4NQdh';

    $prompt = "Analyze the following resume and job description. Provide insights about skills, match quality, and suggestions.\n\nResume:\n$resumeText\n\nJob Description:\n$jobDescription";

    $data = [
        "model" => "command",  // or "command-xlarge-nightly" if available
        "prompt" => $prompt,
        "max_tokens" => 500,
        "temperature" => 0.7,
        "k" => 0,
        "stop_sequences" => ["--"],
        "return_likelihoods" => "NONE"
    ];

    $curl = curl_init("https://api.cohere.ai/v1/generate");
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $apiKey",
        "Content-Type: application/json",
        "Cohere-Version: 2022-12-06"
    ]);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        $error_msg = curl_error($curl);
        curl_close($curl);
        return "Curl error: $error_msg";
    }

    $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    if ($http_status !== 200) {
        return "API request failed with status $http_status. Response: $response";
    }

    $result = json_decode($response, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        return "Failed to parse JSON response. Raw response: $response";
    }

    if (isset($result['generations'][0]['text'])) {
        return trim($result['generations'][0]['text']);
    } else {
        return "AI analysis failed: Unexpected response structure. Raw response: " . $response;
    }
}
