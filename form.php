<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$full_name = $_SESSION['full_name'];
?>



<!-- form.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <div style="text-align: right; margin: 10px;">
    Logged in as <strong><?php echo $full_name; ?></strong>
    | <a href="logout.php" style="color: red; text-decoration: none;">Logout</a>
</div>

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Enter Your Resume Details</h2>
        <form action="generate.php" method="POST">
            <!-- Personal Information -->
            <label for="name">Full Name:</label>
            <input type="text" name="name" required>

            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="phone">Phone Number:</label>
            <input type="text" name="phone" required>

            <!-- Summary -->
            <label for="summary">Professional Summary:</label>
            <textarea name="summary" rows="4" placeholder="A short paragraph about yourself..." required></textarea>

            <!-- Education -->
            <label for="education">Education:</label>
            <textarea name="education" rows="4" placeholder="Your degrees, schools, years..." required></textarea>

            <!-- Work Experience -->
            <label for="experience">Work Experience:</label>
            <textarea name="experience" rows="4" placeholder="Job title, company, responsibilities..." required></textarea>

            <!-- Skills -->
            <label for="skills">Skills (comma-separated):</label>
            <input type="text" name="skills" placeholder="e.g. HTML, CSS, PHP, MySQL" required>

            <button type="submit" class="btn">Generate Resume</button>
        </form>
    </div>
</body>
</html>
