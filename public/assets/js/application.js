document.querySelectorAll('.btn[data-bs-toggle="collapse"]').forEach(button => {
  button.addEventListener('click', function() {
      const icon = this.querySelector('.toggle-icon');
      
      // Alterna entre fa-caret-right e fa-caret-down
      if (icon.classList.contains('fa-caret-right')) {
          icon.classList.remove('fa-caret-right');
          icon.classList.add('fa-caret-down');
      } else {
          icon.classList.remove('fa-caret-down');
          icon.classList.add('fa-caret-right');
      }
  });
});

document.addEventListener("DOMContentLoaded", function () {
    const imagePreviewInput = document.getElementById("image_preview_input");
    const preview = document.getElementById("image_preview");
    const imagePreviewSubmit = document.getElementById("image_preview_submit");
  
    if (!(imagePreviewInput && preview)) return;
  
    imagePreviewInput.style.display = "none";
    imagePreviewSubmit.style.display = "none";
  
    preview.addEventListener("click", function () {
      imagePreviewInput.click();
    });
  
    imagePreviewInput.addEventListener("change", function (event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
          document.getElementById("image_preview").src = e.target.result;
          imagePreviewSubmit.style.display = "block";
        };
        reader.readAsDataURL(file);
      }
    });
  });