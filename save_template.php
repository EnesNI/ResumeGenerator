<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['template'])) {
    $_SESSION['selected_template'] = $_POST['template'];
    // Redirect to resume creation page
    header("Location: generate.php");
    exit();
} else {
    echo "Please select a template.";
}
