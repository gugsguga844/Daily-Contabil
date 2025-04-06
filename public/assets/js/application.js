// Este arquivo contém funções JavaScript adicionais que podem ser usadas
// para estender a funcionalidade do sistema de treinamento contábil
const mobileMenuButton = document.getElementById("mobileMenuButton");
const mobileMenu = document.getElementById("mobileMenu");
const menuIcon = document.getElementById("menuIcon");
const closeIcon = document.getElementById("closeIcon");

mobileMenuButton.addEventListener("click", () => {
  mobileMenu.classList.toggle("hidden");
  menuIcon.classList.toggle("hidden");
  closeIcon.classList.toggle("hidden");
});

// Toggle Dropdowns in Desktop Nav
const userDropdown = document.getElementById("userDropdown");
const configDropdown = document.getElementById("configDropdown");

userDropdown.querySelector("button").addEventListener("click", (e) => {
  e.stopPropagation();
  const configContent = configDropdown.querySelector(".dropdown-content");
  const userContent = userDropdown.querySelector(".dropdown-content");
  
  // Fecha o dropdown de configurações se estiver aberto
  if (configContent.classList.contains("show")) {
    configContent.classList.remove("show");
  }
  
  // Toggle do dropdown do usuário
  userContent.classList.toggle("show");
});

configDropdown.querySelector("button").addEventListener("click", (e) => {
  e.stopPropagation();
  const configContent = configDropdown.querySelector(".dropdown-content");
  const userContent = userDropdown.querySelector(".dropdown-content");
  
  // Fecha o dropdown do usuário se estiver aberto
  if (userContent.classList.contains("show")) {
    userContent.classList.remove("show");
  }
  
  // Toggle do dropdown de configurações
  configContent.classList.toggle("show");
});

// Close dropdowns when clicking outside
document.addEventListener("click", () => {
  document.querySelectorAll(".dropdown-content").forEach((dropdown) => {
    dropdown.classList.remove("show");
  });
});

// Toggle Fiscal Obligations
const fiscalObligations = document.querySelectorAll(".fiscal-obligation");

fiscalObligations.forEach((obligation) => {
  obligation.addEventListener("click", () => {
    const id = obligation.getAttribute("data-id");
    const companiesList = document.querySelector(
      `.companies-list[data-id="${id}"]`
    );
    const chevronDown = obligation.querySelector(".chevron-down");
    const chevronUp = obligation.querySelector(".chevron-up");

    companiesList.classList.toggle("hidden");
    chevronDown.classList.toggle("hidden");
    chevronUp.classList.toggle("hidden");
  });
});

// Função para formatar datas no padrão brasileiro
function formatarData(data) {
  if (!data) return "";
  const dataObj = new Date(data);
  return dataObj.toLocaleDateString("pt-BR", {
    day: "2-digit",
    month: "2-digit",
    year: "numeric",
  });
}

// Função para verificar se uma data está próxima (dentro de 7 dias)
function verificarDataProxima(data) {
  const hoje = new Date();
  const dataAlvo = new Date(data);
  const diffTempo = dataAlvo.getTime() - hoje.getTime();
  const diffDias = Math.ceil(diffTempo / (1000 * 60 * 60 * 24));
  return diffDias <= 7 && diffDias >= 0;
}

// Função para filtrar obrigações fiscais por mês
function filtrarObrigacoesPorMes(obrigacoes, mes, ano) {
  return obrigacoes.filter((obrigacao) => {
    const data = new Date(obrigacao.data);
    return data.getMonth() + 1 === mes && data.getFullYear() === ano;
  });
}

// Função para filtrar obrigações por empresa
function filtrarObrigacoesPorEmpresa(obrigacoes, idEmpresa) {
  return obrigacoes.filter((obrigacao) => {
    return obrigacao.empresas.some((empresa) => empresa.id === idEmpresa);
  });
}

// Função para marcar uma obrigação como concluída para uma empresa específica
function marcarObrigacaoConcluida(idObrigacao, idEmpresa) {
  // Esta função seria implementada com chamadas AJAX para atualizar o status no servidor
  console.log(
    `Marcando obrigação ${idObrigacao} como concluída para empresa ${idEmpresa}`
  );

  // Exemplo de como atualizar a interface após a conclusão
  const elementoStatus = document.querySelector(
    `.companies-list[data-id="${idObrigacao}"] [data-empresa-id="${idEmpresa}"] .status-badge`
  );

  if (elementoStatus) {
    elementoStatus.classList.remove("bg-gray-100", "text-gray-800");
    elementoStatus.classList.add("bg-green-100", "text-green-800");
    elementoStatus.textContent = "Concluído";
  }
}

// Função para adicionar notificações
function adicionarNotificacao(mensagem, tipo = "info") {
  const container = document.createElement("div");
  container.className = `fixed top-4 right-4 p-4 rounded-md shadow-md ${
    tipo === "error"
      ? "bg-red-100 text-red-800"
      : tipo === "success"
      ? "bg-green-100 text-green-800"
      : "bg-blue-100 text-blue-800"
  }`;

  container.textContent = mensagem;
  document.body.appendChild(container);

  setTimeout(() => {
    container.classList.add("opacity-0", "transition-opacity", "duration-500");
    setTimeout(() => {
      document.body.removeChild(container);
    }, 500);
  }, 3000);
}

const subcategoryHeaders = document.querySelectorAll(".subcategory-header");

subcategoryHeaders.forEach((header) => {
  header.addEventListener("click", () => {
    const targetId = header.getAttribute("data-target");
    const content = document.getElementById(targetId);
    const chevronDown = header.querySelector(".chevron-down");
    const chevronUp = header.querySelector(".chevron-up");

    content.classList.toggle("show");
    chevronDown.classList.toggle("hidden");
    chevronUp.classList.toggle("hidden");
  });
});

// Expand first subcategory by default
if (subcategoryHeaders.length > 0) {
  const firstHeader = subcategoryHeaders[0];
  const targetId = firstHeader.getAttribute("data-target");
  const content = document.getElementById(targetId);
  const chevronDown = firstHeader.querySelector(".chevron-down");
  const chevronUp = firstHeader.querySelector(".chevron-up");

  content.classList.add("show");
  chevronDown.classList.add("hidden");
  chevronUp.classList.remove("hidden");
}

// Exportar funções para uso global
window.appUtils = {
  formatarData,
  verificarDataProxima,
  filtrarObrigacoesPorMes,
  filtrarObrigacoesPorEmpresa,
  marcarObrigacaoConcluida,
  adicionarNotificacao,
};

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

const iconSelect = document.getElementById("icon");
const iconPreview = document.getElementById("icon-preview");

const icons = {
  "file-text":
    '<path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" x2="8" y1="13" y2="13"></line><line x1="16" x2="8" y1="17" y2="17"></line><line x1="10" x2="8" y1="9" y2="9"></line>',
  "book-open":
    '<path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>',
  "file-spreadsheet":
    '<path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path><polyline points="14 2 14 8 20 8"></polyline><path d="M8 13h2"></path><path d="M8 17h2"></path><path d="M14 13h2"></path><path d="M14 17h2"></path>',
  receipt:
    '<path d="M4 2v20l2-1 2 1 2-1 2 1 2-1 2 1 2-1 2 1V2l-2 1-2-1-2 1-2-1-2 1-2-1-2 1-2-1Z"></path><path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8"></path><path d="M12 17.5v-11"></path>',
  "credit-card":
    '<rect width="20" height="14" x="2" y="5" rx="2"></rect><line x1="2" x2="22" y1="10" y2="10"></line>',
  landmark:
    '<rect width="18" height="10" x="3" y="8" rx="2"></rect><path d="M4 18h16"></path><path d="M12 8v10"></path><path d="m2 8 10-5 10 5"></path>',
};

iconSelect.addEventListener("change", () => {
  const selectedIcon = iconSelect.value;
  if (selectedIcon && icons[selectedIcon]) {
    iconPreview.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-primary">${icons[selectedIcon]}</svg>`;
  } else {
    iconPreview.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-primary"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>`;
  }
});

// Form Validation
const subcategoryForm = document.getElementById("subcategoryForm");
const nameInput = document.getElementById("name");
const descriptionInput = document.getElementById("description");
const nameError = document.getElementById("nameError");
const descriptionError = document.getElementById("descriptionError");

subcategoryForm.addEventListener("submit", function (e) {
  let isValid = true;

  // Validar nome
  if (!nameInput.value.trim()) {
    nameError.classList.remove("hidden");
    nameInput.classList.add("border-red-500");
    isValid = false;
  } else {
    nameError.classList.add("hidden");
    nameInput.classList.remove("border-red-500");
  }

  // Validar descrição
  if (!descriptionInput.value.trim()) {
    descriptionError.classList.remove("hidden");
    descriptionInput.classList.add("border-red-500");
    isValid = false;
  } else {
    descriptionError.classList.add("hidden");
    descriptionInput.classList.remove("border-red-500");
  }

  if (!isValid) {
    e.preventDefault();
    return false;
  }

  // Simulação de envio bem-sucedido
  e.preventDefault();
  alert("Subcategoria adicionada com sucesso!");
  subcategoryForm.reset();

  // Redirecionar para a página de subcategorias
  // window.location.href = '/tutoriais/fiscal.html';
});

// Form Validation
const videoForm = document.getElementById("videoForm");
const titleInput = document.getElementById("title");
const videoDescriptionInput = document.getElementById("description");
const recordingDateInput = document.getElementById("recordingDate");
const subcategorySelect = document.getElementById("subcategory");
const durationMinutesInput = document.getElementById("durationMinutes");
const durationSecondsInput = document.getElementById("durationSeconds");

const titleError = document.getElementById("titleError");
const videoDescriptionError = document.getElementById("descriptionError");
const dateError = document.getElementById("dateError");
const subcategoryError = document.getElementById("subcategoryError");
const durationError = document.getElementById("durationError");

videoForm.addEventListener("submit", function (e) {
  let isValid = true;

  // Validar título
  if (!titleInput.value.trim()) {
    titleError.classList.remove("hidden");
    titleInput.classList.add("border-red-500");
    isValid = false;
  } else {
    titleError.classList.add("hidden");
    titleInput.classList.remove("border-red-500");
  }

  // Validar descrição
  if (!descriptionInput.value.trim()) {
    descriptionError.classList.remove("hidden");
    descriptionInput.classList.add("border-red-500");
    isValid = false;
  } else {
    descriptionError.classList.add("hidden");
    descriptionInput.classList.remove("border-red-500");
  }

  // Validar data
  if (!recordingDateInput.value) {
    dateError.classList.remove("hidden");
    recordingDateInput.classList.add("border-red-500");
    isValid = false;
  } else {
    dateError.classList.add("hidden");
    recordingDateInput.classList.remove("border-red-500");
  }

  // Validar duração
  if (!durationMinutesInput.value || !durationSecondsInput.value) {
    durationError.classList.remove("hidden");
    if (!durationMinutesInput.value)
      durationMinutesInput.classList.add("border-red-500");
    if (!durationSecondsInput.value)
      durationSecondsInput.classList.add("border-red-500");
    isValid = false;
  } else {
    durationError.classList.add("hidden");
    durationMinutesInput.classList.remove("border-red-500");
    durationSecondsInput.classList.remove("border-red-500");
  }

  if (!isValid) {
    e.preventDefault();
    return false;
  }
});
