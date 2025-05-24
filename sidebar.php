<?php
if (!isset($_SESSION)) session_start();
$full_name = $_SESSION['full_name'] ?? 'User';
?>

<div class="sidebar">
    <div class="top-section">
        <a href="generate_resume.html" class="sidebar-button">
            <span class="icon">＋</span>
            <span class="label">Create</span>
        </a>
        <a href="dashboard.php" class="sidebar-button">
            <span class="icon">🏠</span>
            <span class="label">Home</span>
        </a>
        <a href="#" class="sidebar-button">
            <span class="icon">📁</span>
            <span class="label">Projects</span>
        </a>
        <a href="select_template.php" class="sidebar-button">
            <span class="icon">📄</span>
            <span class="label">Templates</span>
        </a>
    </div>
    <div class="bottom-section">
        <img src="profile.jpg" alt="Profile" class="profile-pic">
        <p class="user-name"><?= htmlspecialchars($full_name) ?></p>
    </div>
</div>
