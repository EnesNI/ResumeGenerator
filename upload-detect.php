<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AI Resume Analyzer</title>
  <link rel="stylesheet" href="detector.css" />
</head>
<body>
  <div class="container">
    <h1>AI Resume Analyzer</h1>
    <form action="analyze_resume.php" method="POST" enctype="multipart/form-data">
      <label for="resume_file">Upload Resume (PDF or TXT):</label>
      <input type="file" name="resume_file" id="resume_file" accept=".pdf,.txt" required />

      <label for="job_description">Paste Job Description:</label>
      <textarea name="job_description" id="job_description" rows="10" required></textarea>

      <button type="submit">Analyze</button>
    </form>
  </div>
</body>
</html>
