<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Template Editor</title>
  <link rel="stylesheet" href="admin_template_editor.css">
  <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script> <!-- Interact.js CDN -->
</head>
<body>

  <!-- Toolbar -->
  <div id="toolbar">
    <button onclick="makeBold()">Bold</button>
    <button onclick="makeCircle()">Circle Image</button>
    <button onclick="addText()">Add Text</button>
    <input type="file" id="imageUploadInput" accept="image/template_images" style="display:none" />
    <button onclick="triggerFileUpload()">Upload Image</button>

    <button onclick="addShape('circle')">Add Circle</button>
    <button onclick="addShape('rect')">Add Rectangle</button>
   

  </div>

  <!-- A4 Canvas -->
  <div id="a4">
    <!-- Editable items will be added here -->
  </div>

  <script src="admin_template_editor.js"></script>
</body>
</html>
