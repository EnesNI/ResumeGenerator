<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents("php://input"), true);
  $template = $data['template'];
  file_put_contents('templates/' . uniqid() . '.html', $template);
  echo 'Saved';
}
?>
