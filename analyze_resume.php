<?php
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jobDescription = $_POST['job_description'] ?? '';
    if (!$jobDescription) {
        die("Job description is required.");
    }

    if (!isset($_FILES['resume_file']) || $_FILES['resume_file']['error'] !== UPLOAD_ERR_OK) {
        die("Resume upload failed.");
    }

    $file = $_FILES['resume_file'];
    $filename = $file['name'];
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $allowed = ['pdf', 'txt'];

    if (!in_array($ext, $allowed)) {
        die("Only PDF or TXT files are allowed.");
    }

    $uploadPath = 'uploads/' . basename($filename);
    if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
        die("Failed to move uploaded file.");
    }

    $resumeText = extractTextFromResume($uploadPath, $ext);

    if (empty(trim($resumeText))) {
        die("Failed to extract text from resume.");
    }

    // Your Cohere API key
    $cohereApiKey = 'fHtGUtc0nPqPdizte9rFayjFCQxZGqjrhkE4NQdh';  // Replace with your key

    // Calculate similarity score using embeddings
    $matchScore = getSimilarityScore($resumeText, $jobDescription, $cohereApiKey);
    if ($matchScore === null) {
        $matchScore = "Unavailable (embedding API error)";
    }

    // Simple AI content detection
    $aiScore = detectAIContent($resumeText);

    // Get detailed AI-powered resume analysis using Cohere generation
    $aiAnalysis = analyzeWithAI($resumeText, $jobDescription);
} else {
    die("Please submit the form.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="detector.css">
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Resume AI Analyzer</title>

</head>
<body>
  <div class="container">
    <h1>Resume Analysis Result</h1>

    <p><strong>Job Match Score (embedding similarity):</strong> <?= htmlspecialchars($matchScore) ?>%</p>
    <p><strong>AI-Writing Probability:</strong> <?= htmlspecialchars($aiScore) ?>%</p>

    <?php
    // Show missing keywords (basic)
    $resumeWords = array_count_values(str_word_count(strtolower($resumeText), 1));
    $jobWords = array_unique(str_word_count(strtolower($jobDescription), 1));
    
    foreach ($jobWords as $word) {
        if (!isset($resumeWords[$word])) {
            $missing[] = $word;
        }
    }
    ?>
    <p><strong>Missing Keywords:</strong> <?= htmlspecialchars(implode(', ', array_slice($missing, 0, 10))) ?></p>

    <h2>AI-Powered Resume Insights</h2>
    <p><?= nl2br(htmlspecialchars($aiAnalysis)) ?></p>


    <p><a href="index.php">← Go Back</a></p>
  </div>
</body>
</html>
