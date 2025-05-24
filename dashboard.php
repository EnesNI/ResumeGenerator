<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$full_name = $_SESSION['full_name'];
$user_id = $_SESSION['user_id'];

include 'db.php';

// Fetch user's resumes
$stmt = $conn->prepare("SELECT * FROM resumes WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$resumes = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>

<?php include 'sidebar.php'; ?>

<div class="main-content">
    <h1>Welcome, <?= htmlspecialchars($full_name) ?>!</h1>
    <h2>Your Resumes</h2>

   <div class="resumes-section">
    <h2>Recent Resumes</h2>
    <div class="resume-cards">
        <?php
        // Example: Fetch resumes from DB
        include 'db.php'; // connect to database
        $userId = $_SESSION['user_id'];
        $query = "SELECT * FROM resumes WHERE user_id = $userId ORDER BY created_at DESC";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="resume-card">';
           $thumbnail = !empty($row['thumbnail']) ? $row['thumbnail'] : 'default-thumbnail.jpg';
            $title = !empty($row['title']) ? $row['title'] : 'Untitled Resume';
            $type = !empty($row['type']) ? $row['type'] : 'Standard';

            echo '<div class="resume-thumb"><img src="resume_thumbs/' . htmlspecialchars($thumbnail) . '" alt="Resume"></div>';
            echo '<div class="resume-title">' . htmlspecialchars($title) . '</div>';
            echo '<div class="resume-type">' . htmlspecialchars($type) . '</div>';

            echo '</div>';
        }
        ?>
    </div>
</div>


</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
