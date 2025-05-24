<?php
session_start();
include 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['resume_id'])) {
    $resume_id = $_GET['resume_id'];
    
    // Delete the resume from the database
    $stmt = $conn->prepare("DELETE FROM resumes WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $resume_id, $_SESSION['user_id']);
    
    if ($stmt->execute()) {
        echo "Resume deleted successfully.";
        header("Location: my_resumes.php");
        exit();
    } else {
        echo "Error deleting resume.";
    }

    $stmt->close();
}

$conn->close();
?>
