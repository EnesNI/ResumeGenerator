<?php
$apiKey = 'fHtGUtc0nPqPdizte9rFayjFCQxZGqjrhkE4NQdh';

$name = $_POST['name'];
$title = $_POST['title'];
$experience = $_POST['experience'];
$education = $_POST['education'];
$skills = $_POST['skills'];

$prompt = "Generate a professional resume in text format for:\n
Name: $name\n
Title: $title\n
Experience: $experience\n
Education: $education\n
Skills: $skills\n
Make it clean and ready to paste into an A4 layout.";

$uploadDir = 'uploads/';
$photoPath = '';
if ($_FILES['photo']['tmp_name']) {
    $filename = uniqid() . '_' . basename($_FILES['photo']['name']);
    $photoPath = $uploadDir . $filename;
    move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath);
}

$payload = json_encode([
  "model" => "command",
  "prompt" => $prompt,
  "max_tokens" => 600,
  "temperature" => 0.6,
]);

$ch = curl_init("https://api.cohere.ai/v1/generate");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  "Authorization: Bearer $apiKey",
  "Content-Type: application/json"
]);

$response = curl_exec($ch);
curl_close($ch);
$data = json_decode($response, true);

$resumeText = $data['generations'][0]['text'] ?? 'Error generating resume.';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Generated Resume</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 220px;
            height: 100vh;
            background: linear-gradient(to bottom, #1c1c1c, #2c2c2c);
            color: #fff;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .sidebar-button {
            margin: 10px 0;
            padding: 10px 15px;
            background: #333;
            border-radius: 8px;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .sidebar-button:hover {
            background: #555;
        }
        .main-content {
            margin-left: 240px;
            padding: 30px;
            color: #111;
        }
        .resume-box {
            background: #f4f4f4;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            white-space: pre-wrap;
        }
        .photo-preview {
            max-width: 150px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div>
        <a href="form.php" class="sidebar-button">＋ Create</a>
        <a href="dashboard.php" class="sidebar-button">🏠 Home</a>
        <a href="#" class="sidebar-button">📁 Projects</a>
        <a href="select_template.php" class="sidebar-button">📄 Templates</a>
    </div>
    <div>
        <p style="font-size: 0.9rem; color: #bbb;">SmartResume Builder</p>
    </div>
</div>

<div class="main-content">
    <h1>Generated Resume</h1>

    <?php if ($photoPath): ?>
        <img src="<?= htmlspecialchars($photoPath) ?>" alt="Uploaded Photo" class="photo-preview">
    <?php endif; ?>

    <div class="resume-box">
        <?= nl2br(htmlspecialchars($resumeText)) ?>
    </div>
</div>

</body>
</html>
