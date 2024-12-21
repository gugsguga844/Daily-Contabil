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