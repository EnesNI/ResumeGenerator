<?php
session_start();
include 'db.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$resume_id = $_POST['resume_id'] ?? 0;

// Get the updated data from the form
$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$phone = htmlspecialchars($_POST['phone']);
$summary = $_POST['summary'];
$education = $_POST['education'];
$experience = $_POST['experience'];
$skills = htmlspecialchars($_POST['skills']);

// Update the resume in the database
$stmt = $conn->prepare("UPDATE resumes SET name = ?, email = ?, phone = ?, summary = ?, education = ?, experience = ?, skills = ? WHERE id = ? AND user_id = ?");
$stmt->bind_param("ssssssssi", $name, $email, $phone, $summary, $education, $experience, $skills, $resume_id, $user_id);

if ($stmt->execute()) {
    header("Location: my_resumes.php"); // Redirect after updating
    exit();
} else {
    echo "Error updating resume: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
