const companyDropdowns = [
  "regimeDropdown",
  "statusDropdown",
  "contadorDropdown",
];

companyDropdowns.forEach((id) => {
  const dropdown = document.getElementById(id);
  if (dropdown) {
    const button = dropdown.querySelector("button");
    const content = dropdown.querySelector(".dropdown-content");

    button.addEventListener("click", (e) => {
      e.preventDefault();
      e.stopPropagation();

      // Fecha outros dropdowns da empresa
      companyDropdowns.forEach((otherId) => {
        if (otherId !== id) {
          const otherDropdown = document.getElementById(otherId);
          if (otherDropdown) {
            otherDropdown
              .querySelector(".dropdown-content")
              ?.classList.remove("show");
          }
        }
      });

      content.classList.toggle("show");
    });

    // Fecha o dropdown quando clicar fora
    document.addEventListener("click", (e) => {
      if (!dropdown.contains(e.target)) {
        content.classList.remove("show");
      }
    });
  }
});

// Timeline month tooltips and interactions
document.querySelectorAll(".timeline-month").forEach((month) => {
  month.addEventListener("mouseover", () => {
    month.style.opacity = "0.8";
  });
  month.addEventListener("mouseout", () => {
    month.style.opacity = "1";
  });
  month.addEventListener("click", () => {
    alert(`Detalhes da contabilidade de ${month.textContent} 2025`);
  });
});

// Navegação por abas
const tabButtons = document.querySelectorAll(".tab-button");
const tabContents = document.querySelectorAll(".tab-content");

tabButtons.forEach((button) => {
  button.addEventListener("click", () => {
    const tabId = button.getAttribute("data-tab");

    // Esconde todos os conteúdos
    tabContents.forEach((content) => {
      content.classList.add("hidden");
    });

    // Remove a classe ativa de todos os botões
    tabButtons.forEach((btn) => {
      btn.classList.remove("text-primary", "border-primary");
      btn.classList.add("text-gray-500", "border-transparent");
    });

    // Mostra o conteúdo selecionado
    document.getElementById(tabId).classList.remove("hidden");

    // Adiciona a classe ativa ao botão clicado
    button.classList.remove("text-gray-500", "border-transparent");
    button.classList.add("text-primary", "border-primary");
  });
});

// Adicionar e remover sócios
const sociosContainer = document.getElementById("socios-container");
const adicionarSocioBtn = document.getElementById("adicionar-socio");

// Função para atualizar os números dos sócios
function atualizarNumerosSocios() {
  const sociosItems = sociosContainer.querySelectorAll(".socio-item");
  sociosItems.forEach((item, index) => {
    const titulo = item.querySelector("h4");
    titulo.textContent = `Sócio ${index + 1}`;
  });
}

// Adicionar novo sócio
adicionarSocioBtn.addEventListener("click", () => {
  const sociosItems = sociosContainer.querySelectorAll(".socio-item");
  const novoSocio = sociosItems[0].cloneNode(true);

  // Limpar os valores dos campos
  const inputs = novoSocio.querySelectorAll("input");
  inputs.forEach((input) => {
    input.value = "";
    // Manter o mesmo nome do campo para que o PHP possa processar como array
    const name = input.getAttribute("name");
    input.setAttribute("name", name);
  });

  // Adicionar evento para remover o sócio
  const removerBtn = novoSocio.querySelector(".remover-socio");
  removerBtn.addEventListener("click", function () {
    if (sociosContainer.querySelectorAll(".socio-item").length > 1) {
      this.closest(".socio-item").remove();
      atualizarNumerosSocios();
    } else {
      alert("É necessário pelo menos um sócio.");
    }
  });

  sociosContainer.appendChild(novoSocio);
  atualizarNumerosSocios();
});

// Adicionar evento para remover o primeiro sócio
const removerBtns = document.querySelectorAll(".remover-socio");
removerBtns.forEach((btn) => {
  btn.addEventListener("click", function () {
    if (sociosContainer.querySelectorAll(".socio-item").length > 1) {
      this.closest(".socio-item").remove();
      atualizarNumerosSocios();
    } else {
      alert("É necessário pelo menos um sócio.");
    }
  });
});

// Máscaras para campos
const cnpjInput = document.getElementById("cnpj");
cnpjInput.addEventListener("input", function (e) {
  let value = e.target.value.replace(/\D/g, "");
  if (value.length > 14) value = value.slice(0, 14);

  if (value.length > 12) {
    value = value.replace(
      /^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2}).*/,
      "$1.$2.$3/$4-$5"
    );
  } else if (value.length > 8) {
    value = value.replace(/^(\d{2})(\d{3})(\d{3})(\d*).*/, "$1.$2.$3/$4");
  } else if (value.length > 5) {
    value = value.replace(/^(\d{2})(\d{3})(\d*).*/, "$1.$2.$3");
  } else if (value.length > 2) {
    value = value.replace(/^(\d{2})(\d*).*/, "$1.$2");
  }

  e.target.value = value;
});

const telefoneInput = document.getElementById("telefone");
telefoneInput.addEventListener("input", function (e) {
  let value = e.target.value.replace(/\D/g, "");
  if (value.length > 11) value = value.slice(0, 11);

  if (value.length > 6) {
    value = value.replace(/^(\d{2})(\d{5})(\d*).*/, "($1) $2-$3");
  } else if (value.length > 2) {
    value = value.replace(/^(\d{2})(\d*).*/, "($1) $2");
  }

  e.target.value = value;
});

// Definir a data atual como padrão para o campo de data de cadastro
const dataCadastroInput = document.getElementById("data-cadastro");
const dataAtual = new Date().toISOString().split("T")[0];
dataCadastroInput.value = dataAtual;

const excluirEmpresaBtn = document.getElementById("excluir-empresa");
const modalExcluir = document.getElementById("modal-excluir");
const cancelarExclusaoBtn = document.getElementById("cancelar-exclusao");
const confirmarExclusaoBtn = document.getElementById("confirmar-exclusao");

excluirEmpresaBtn.addEventListener("click", () => {
  modalExcluir.classList.remove("hidden");
});

cancelarExclusaoBtn.addEventListener("click", () => {
  modalExcluir.classList.add("hidden");
});

confirmarExclusaoBtn.addEventListener("click", () => {
  // Simulação de exclusão
  alert("Empresa excluída com sucesso!");
  window.location.href = "/empresas.html";
});

// Fechar modal ao clicar fora
modalExcluir.addEventListener("click", (e) => {
  if (e.target === modalExcluir) {
    modalExcluir.classList.add("hidden");
  }
});
