<?php
$conn = new mysqli("localhost", "root", "", "smart_resume");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$result = $conn->query("SELECT * FROM resume_templates");
?>

<h2>Select a Resume Template</h2>
<div style="display: flex; flex-wrap: wrap;">
<?php while ($row = $result->fetch_assoc()): ?>
    <div style="border: 1px solid #ccc; margin: 10px; padding: 10px;">
        <h3><?= $row['title'] ?></h3>
        <p><?= $row['description'] ?></p>
        <img src="<?= $row['image_path'] ?>" width="200"><br>
        <a href="edit_template.php?id=<?= $row['id'] ?>">Edit this template</a>
    </div>
<?php endwhile; ?>
</div>
