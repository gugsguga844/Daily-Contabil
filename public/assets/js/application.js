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
  userDropdown.querySelector(".dropdown-content").classList.toggle("show");
  tutoriaisDropdown.querySelector(".dropdown-content").classList.remove("show");
});

configDropdown.querySelector("button").addEventListener("click", (e) => {
  e.stopPropagation();
  configDropdown.querySelector(".dropdown-content").classList.toggle("show");
  tutoriaisDropdown.querySelector(".dropdown-content").classList.remove("show");
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
