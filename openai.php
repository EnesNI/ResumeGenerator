<?php
function analyzeWithAI($resumeText, $jobDescription)
{
    $apiKey = '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'; // Replace with your OpenAI API key
    $url = 'https://api.openai.com/v1/chat/completions';

    $data = [
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            ['role' => 'system', 'content' => 'You are a resume expert helping match resumes to job descriptions.'],
            ['role' => 'user', 'content' => "Resume:\n$resumeText\n\nJob Description:\n$jobDescription\n\nAnalyze how well this resume matches the job and suggest improvements."]
        ],
        'temperature' => 0.7,
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $apiKey",
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        return 'AI analysis failed: ' . curl_error($ch);
    }

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode !== 200) {
        return 'AI analysis failed. HTTP code: ' . $httpCode . ' Response: ' . $response;
    }

    $responseData = json_decode($response, true);
    return $responseData['choices'][0]['message']['content'] ?? 'AI analysis failed.';
}
