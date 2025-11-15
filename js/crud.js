// js/crud.js

document.addEventListener("DOMContentLoaded", () => {
  const uploadForm = document.querySelector(".upload-form");
  const fileInput = document.querySelector('input[type="file"]');
  const iframe = document.querySelector("iframe");

  // --- Upload Progress Animation ---
  uploadForm.addEventListener("submit", (e) => {
    const file = fileInput.files[0];
    if (!file) return;

    e.preventDefault();

    const formData = new FormData(uploadForm);
    const xhr = new XMLHttpRequest();

    // Create overlay
    const overlay = document.createElement("div");
    overlay.classList.add("upload-overlay");
    overlay.innerHTML = `
      <div class="upload-box">
        <h3>Uploading...</h3>
        <div class="progress-bar"><div class="progress-fill"></div></div>
      </div>`;
    document.body.appendChild(overlay);

    const progressFill = overlay.querySelector(".progress-fill");

    xhr.upload.onprogress = (e) => {
      if (e.lengthComputable) {
        const percent = (e.loaded / e.total) * 100;
        progressFill.style.width = percent + "%";
      }
    };

    xhr.onload = () => {
      setTimeout(() => {
        overlay.remove();
        iframe.src = iframe.src; // refresh file list
      }, 1000);
    };

    xhr.open("POST", uploadForm.action, true);
    xhr.send(formData);
  });

  // --- Edit Modal (Triggered inside iframe) ---
  window.openEditModal = function (fileId, oldName) {
    const modal = document.createElement("div");
    modal.classList.add("edit-modal");
    modal.innerHTML = `
      <div class="edit-box">
        <h3>Edit File Name</h3>
        <input type="text" id="editName" value="${oldName}">
        <div class="btn-group">
          <button id="saveEdit">Save</button>
          <button id="cancelEdit">Cancel</button>
        </div>
      </div>`;

    document.body.appendChild(modal);

    document.getElementById("cancelEdit").addEventListener("click", () => modal.remove());
    document.getElementById("saveEdit").addEventListener("click", () => {
      const newName = document.getElementById("editName").value.trim();
      if (newName === "") return alert("Enter a valid name.");

      fetch(`../crud.php?id=${fileId}&name=${encodeURIComponent(newName)}`)
        .then(() => {
          modal.remove();
          iframe.src = iframe.src;
        });
    });
  };
});

// Delete Function

window.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('deleted') === '1') {
        const alertBox = document.getElementById('deleteAlert');
        alertBox.style.display = 'block';

        // Auto fade-out after 2 seconds
        setTimeout(() => {
            alertBox.style.display = 'none';
            // Remove the query parameter from URL
            window.history.replaceState({}, document.title, window.location.pathname);
        }, 2000);
    }
});
