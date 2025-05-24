<?php
session_start();
include 'db.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$resume_id = $_GET['resume_id'] ?? 0;

// Fetch the resume
$stmt = $conn->prepare("SELECT * FROM resumes WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $resume_id, $user_id);
$stmt->execute();
$resume = $stmt->get_result()->fetch_assoc();

if (!$resume) {
    die("Resume not found or access denied.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Resume</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Edit Resume</h2>
    <form action="update_resume.php" method="POST">
        <input type="hidden" name="resume_id" value="<?= $resume_id ?>">
        <label>Full Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($resume['name']) ?>" required>
        
        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($resume['email']) ?>" required>
        
        <label>Phone:</label>
        <input type="text" name="phone" value="<?= htmlspecialchars($resume['phone']) ?>" required>
        
        <label>Summary:</label>
        <textarea name="summary" required><?= $resume['summary'] ?></textarea>
        
        <label>Education:</label>
        <textarea name="education" required><?= $resume['education'] ?></textarea>
        
        <label>Experience:</label>
        <textarea name="experience" required><?= $resume['experience'] ?></textarea>
        
        <label>Skills:</label>
        <input type="text" name="skills" value="<?= htmlspecialchars($resume['skills']) ?>" required>
        
        <button type="submit" class="btn">Save Changes</button>
    </form>
</div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
