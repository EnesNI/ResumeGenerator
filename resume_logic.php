<?php
function render_resume_template($style) {
    ?>
    <div class="resume-container <?= $style ?>">
        <form method="POST" enctype="multipart/form-data" action="save_resume.php">
            <div class="sidebar">
                <img src="uploads/default.png" id="preview" class="profile-pic">
                <input type="file" name="photo" onchange="previewImage(event)">
                <h1 contenteditable="true" id="name">John Doe</h1>
                <p contenteditable="true" id="email">john@example.com</p>
                <p contenteditable="true" id="phone">+1234567890</p>
            </div>
            <div class="main-content">
                <h2>Summary</h2>
                <p contenteditable="true" id="summary">Professional summary goes here...</p>

                <h2>Experience</h2>
                <p contenteditable="true" id="experience">Your experience here...</p>

                <h2>Education</h2>
                <p contenteditable="true" id="education">Your education here...</p>

                <h2>Skills</h2>
                <p contenteditable="true" id="skills">HTML, CSS, JavaScript</p>

                <!-- Hidden inputs to pass data -->
                <input type="hidden" name="template" value="<?= $style ?>">
                <input type="hidden" name="name" id="nameInput">
                <input type="hidden" name="email" id="emailInput">
                <input type="hidden" name="phone" id="phoneInput">
                <input type="hidden" name="summary" id="summaryInput">
                <input type="hidden" name="education" id="educationInput">
                <input type="hidden" name="experience" id="experienceInput">
                <input type="hidden" name="skills" id="skillsInput">

                <button type="submit" onclick="prepareSubmit()">Save Resume</button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            document.getElementById('preview').src = URL.createObjectURL(event.target.files[0]);
        }

        function prepareSubmit() {
            document.getElementById('nameInput').value = document.getElementById('name').innerText;
            document.getElementById('emailInput').value = document.getElementById('email').innerText;
            document.getElementById('phoneInput').value = document.getElementById('phone').innerText;
            document.getElementById('summaryInput').value = document.getElementById('summary').innerText;
            document.getElementById('educationInput').value = document.getElementById('education').innerText;
            document.getElementById('experienceInput').value = document.getElementById('experience').innerText;
            document.getElementById('skillsInput').value = document.getElementById('skills').innerText;
        }
    </script>
    <?php
}
?>
