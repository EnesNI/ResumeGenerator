<?php
session_start();
include 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch all resumes for the logged-in user
$stmt = $conn->prepare("SELECT * FROM resumes WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Resumes</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .resume-list {
            max-width: 700px;
            margin: auto;
            text-align: left;
            background-color: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 12px;
        }

        .resume-item {
            border-bottom: 1px solid #ccc;
            padding: 15px 0;
        }

        .resume-item:last-child {
            border-bottom: none;
        }

        .resume-item strong {
            font-size: 1.3em;
            color: #fff;
        }

        .resume-item p {
            margin: 5px 0;
            color: #ddd;
        }

        .resume-actions a {
            display: inline-block;
            margin-top: 10px;
            margin-right: 10px;
            padding: 10px 20px;
            background-color: #00c6ff;
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
            transition: background 0.3s;
        }

        .resume-actions a:hover {
            background-color: #0072ff;
        }

        .no-resumes {
            font-size: 1.2em;
            color: #eee;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Your Resumes</h1>
            <p>Manage and update your saved resumes</p>
        </header>

        <div class="resume-list">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="resume-item">
                        <strong><?= htmlspecialchars($row['name']) ?></strong>
                        <p>Email: <?= htmlspecialchars($row['email']) ?></p>
                        <p>Phone: <?= htmlspecialchars($row['phone']) ?></p>
                        <div class="resume-actions">
                            <a href="edit_resume.php?resume_id=<?= $row['id'] ?>">Edit</a>
                            <a class="delete-btn" href="delete_resume.php?resume_id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this resume?');">Delete</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="no-resumes">You have no saved resumes.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>


<?php
$stmt->close();
$conn->close();
?>
