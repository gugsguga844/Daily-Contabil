document.addEventListener('DOMContentLoaded', function() {
  // Alternar visibilidade da senha
  const togglePasswordButtons = document.querySelectorAll('.toggle-password');
  
  togglePasswordButtons.forEach(button => {
      button.addEventListener('click', function() {
          const input = this.parentElement.querySelector('input');
          const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
          input.setAttribute('type', type);
          
          // Alternar ícone
          const icon = this.querySelector('i');
          if (type === 'password') {
              icon.classList.remove('fa-eye-slash');
              icon.classList.add('fa-eye');
          } else {
              icon.classList.remove('fa-eye');
              icon.classList.add('fa-eye-slash');
          }
        // Modal de exclusão de usuário
  const deleteModal = document.getElementById('deleteModal');
  const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
  const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
  let formToDelete = null;

  // Abrir modal ao clicar no botão de excluir
  document.querySelectorAll('.btn-delete-user').forEach(btn => {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      const userId = this.getAttribute('data-user-id');
      document.getElementById('deleteUserId').value = userId;
      deleteModal.classList.remove('hidden');
      formToDelete = this.closest('form');
    });
  });

  // Cancelar exclusão
  if (cancelDeleteBtn) {
    cancelDeleteBtn.addEventListener('click', function() {
      deleteModal.classList.add('hidden');
      formToDelete = null;
    });
  }

  // Confirmar exclusão
  if (confirmDeleteBtn) {
    confirmDeleteBtn.addEventListener('click', function() {
      if (formToDelete) {
        formToDelete.submit();
      }
    });
  }
});
    // Modal de exclusão de usuário
  const deleteModal = document.getElementById('deleteModal');
  const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
  const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
  let formToDelete = null;

  // Abrir modal ao clicar no botão de excluir
  document.querySelectorAll('.btn-delete-user').forEach(btn => {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      const userId = this.getAttribute('data-user-id');
      document.getElementById('deleteUserId').value = userId;
      deleteModal.classList.remove('hidden');
      formToDelete = this.closest('form');
    });
  });

  // Cancelar exclusão
  if (cancelDeleteBtn) {
    cancelDeleteBtn.addEventListener('click', function() {
      deleteModal.classList.add('hidden');
      formToDelete = null;
    });
  }

  // Confirmar exclusão
  if (confirmDeleteBtn) {
    confirmDeleteBtn.addEventListener('click', function() {
      if (formToDelete) {
        formToDelete.submit();
      }
    });
  }
});
  
  // Visualização prévia da foto de perfil
  const userPhoto = document.getElementById('userPhoto');
  const profileImage = document.getElementById('profileImage');
  const defaultProfileIcon = document.getElementById('defaultProfileIcon');
  
  userPhoto.addEventListener('change', function(e) {
      if (e.target.files && e.target.files[0]) {
          const reader = new FileReader();
          
          reader.onload = function(e) {
              profileImage.src = e.target.result;
              profileImage.classList.remove('hidden');
              defaultProfileIcon.classList.add('hidden');
          }
          
          reader.readAsDataURL(e.target.files[0]);
      }
    // Modal de exclusão de usuário
  const deleteModal = document.getElementById('deleteModal');
  const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
  const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
  let formToDelete = null;

  // Abrir modal ao clicar no botão de excluir
  document.querySelectorAll('.btn-delete-user').forEach(btn => {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      const userId = this.getAttribute('data-user-id');
      document.getElementById('deleteUserId').value = userId;
      deleteModal.classList.remove('hidden');
      formToDelete = this.closest('form');
    });
  });

  // Cancelar exclusão
  if (cancelDeleteBtn) {
    cancelDeleteBtn.addEventListener('click', function() {
      deleteModal.classList.add('hidden');
      formToDelete = null;
    });
  }

  // Confirmar exclusão
  if (confirmDeleteBtn) {
    confirmDeleteBtn.addEventListener('click', function() {
      if (formToDelete) {
        formToDelete.submit();
      }
    });
  }
});
  // Modal de exclusão de usuário
  const deleteModal = document.getElementById('deleteModal');
  const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
  const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
  let formToDelete = null;

  // Abrir modal ao clicar no botão de excluir
  document.querySelectorAll('.btn-delete-user').forEach(btn => {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      const userId = this.getAttribute('data-user-id');
      document.getElementById('deleteUserId').value = userId;
      deleteModal.classList.remove('hidden');
      formToDelete = this.closest('form');
    });
  });

  // Cancelar exclusão
  if (cancelDeleteBtn) {
    cancelDeleteBtn.addEventListener('click', function() {
      deleteModal.classList.add('hidden');
      formToDelete = null;
    });
  }

  // Confirmar exclusão
  if (confirmDeleteBtn) {
    confirmDeleteBtn.addEventListener('click', function() {
      if (formToDelete) {
        formToDelete.submit();
      }
    });
  }
});