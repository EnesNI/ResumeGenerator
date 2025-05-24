document.getElementById('resumeForm').addEventListener('submit', function (e) {
  e.preventDefault();

  const formData = new FormData(this);

  fetch('generate_resume.php', {
    method: 'POST',
    body: formData
  })
    .then(res => res.json())
    .then(data => {
      if (data.error) {
        alert(data.error);
      } else {
        displayResume(data.resumeText, data.photoUrl);
      }
    })
    .catch(err => {
      alert("Something went wrong.");
      console.error(err);
    });
});

function displayResume(text, photoUrl) {
  const container = document.getElementById('a4');
  container.innerHTML = '';

  const img = document.createElement('img');
  img.src = photoUrl;
  img.className = 'editable';
  img.style.width = '100px';
  img.style.position = 'absolute';
  img.style.top = '20px';
  img.style.left = '20px';
  container.appendChild(img);

  const resumeText = document.createElement('div');
  resumeText.className = 'editable';
  resumeText.innerHTML = text.replace(/\n/g, "<br>");
  resumeText.contentEditable = true;
  resumeText.style.position = 'absolute';
  resumeText.style.top = '140px';
  resumeText.style.left = '40px';
  resumeText.style.width = '80%';
  resumeText.style.fontSize = '16px';
  container.appendChild(resumeText);
}
