function addText() {
  const text = document.createElement('div');
  text.className = 'editable';
  text.contentEditable = true;
  text.textContent = 'Edit text';
  text.style.top = '50px';
  text.style.left = '50px';
  text.style.fontSize = '16px';
  document.getElementById('a4').appendChild(text);
  makeDraggable(text);
}

// Trigger the hidden file input
function triggerFileUpload() {
  document.getElementById('imageUploadInput').click();
}

// Handle file selection and add image
document.getElementById('imageUploadInput').addEventListener('change', function(event) {
  const file = event.target.files[0];
  if (!file) return;

  const reader = new FileReader();
  reader.onload = function(e) {
    const img = document.createElement('img');
    img.src = e.target.result;  // base64 image data
    img.className = 'editable';
    img.style.width = '100px';
    img.style.height = '100px';
    img.style.top = '100px';
    img.style.left = '100px';
    img.style.objectFit = 'cover';
    img.style.position = 'absolute';

    document.getElementById('a4').appendChild(img);
    makeDraggable(img);
  };
  reader.readAsDataURL(file);

  // Reset the input value so the same file can be uploaded again if needed
  event.target.value = '';
});




function addShape(type) {
  const shape = document.createElement('div');
  shape.className = 'editable';
  shape.style.width = '100px';
  shape.style.height = '100px';
  shape.style.background = '#3498db';
  shape.style.top = '150px';
  shape.style.left = '150px';
  if (type === 'circle') shape.style.borderRadius = '50%';
  document.getElementById('a4').appendChild(shape);
  makeDraggable(shape);
}

function makeBold() {
  const selection = window.getSelection();
  if (selection.rangeCount > 0) {
    document.execCommand('bold', false, null);
  }
}

function makeCircle() {
  const selected = document.querySelector('.editable:focus, .editable.selected');
  if (selected && selected.tagName === 'IMG') {
    selected.style.borderRadius = selected.style.borderRadius === '50%' ? '0%' : '50%';
  }
}

function makeDraggable(el) {
  interact(el)
    .draggable({
      listeners: {
        move(event) {
          const target = event.target;
          const x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
          const y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

          target.style.transform = `translate(${x}px, ${y}px)`;
          target.setAttribute('data-x', x);
          target.setAttribute('data-y', y);
        }
      }
    })
    .resizable({
      edges: { left: true, right: true, bottom: true, top: true },
      listeners: {
        move(event) {
          let { x, y } = event.target.dataset;

          Object.assign(event.target.style, {
            width: `${event.rect.width}px`,
            height: `${event.rect.height}px`,
          });

          x = (parseFloat(x) || 0) + event.deltaRect.left;
          y = (parseFloat(y) || 0) + event.deltaRect.top;

          event.target.style.transform = `translate(${x}px, ${y}px)`;
          event.target.dataset.x = x;
          event.target.dataset.y = y;
        }
      }
    });
}


let selectedElement = null;

// Click handler to select/deselect elements
document.getElementById('a4').addEventListener('click', function(e) {
  // Only select elements with 'editable' class
  if (e.target.classList.contains('editable')) {
    if (selectedElement) {
      selectedElement.classList.remove('selected');
    }
    selectedElement = e.target;
    selectedElement.classList.add('selected');
  } else {
    // Click outside editable elements clears selection
    if (selectedElement) {
      selectedElement.classList.remove('selected');
      selectedElement = null;
    }
  }
});

// Keyboard event to delete selected element
document.addEventListener('keydown', function(e) {
  if (!selectedElement) return;
  if (e.key === 'Delete' || e.key === 'Backspace') {
    selectedElement.remove();
    selectedElement = null;
  }
});

// Toolbar button to remove selected element
function removeSelected() {
  if (selectedElement) {
    selectedElement.remove();
    selectedElement = null;
  } else {
    alert('No element selected to remove');
  }
}
