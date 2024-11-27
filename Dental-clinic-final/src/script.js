// Obtém o elemento de calendário pelo seu ID
var calendarEl = document.getElementById("calendar");

// Faz uma requisição para buscar os agendamentos existentes
fetch("buscar_agendamentos.php")
  .then((response) => response.json()) // Converte a resposta para JSON
  .then((data) => {
    // Obtém a referência ao corpo da tabela onde os agendamentos serão exibidos
    var tabela = document.getElementById("corpo-tabela");

    // Limpa a tabela antes de adicionar novas linhas
    tabela.innerHTML = "";

    // Verifica se há algum erro na resposta
    if (data.error) {
      var linha = document.createElement("tr");
      var coluna = document.createElement("td");
      coluna.setAttribute("colspan", 5);
      coluna.textContent = "Erro ao carregar agendamentos.";
      linha.appendChild(coluna);
      tabela.appendChild(linha);
    } else if (data.length === 0) {
      var linha = document.createElement("tr");
      var coluna = document.createElement("td");
      coluna.setAttribute("colspan", 5);
      coluna.textContent = "Nenhum agendamento ativo.";
      linha.appendChild(coluna);
      tabela.appendChild(linha);
    } else {
      // Itera sobre cada agendamento retornado
      data.forEach((element) => {
        var linha = document.createElement("tr");

        // Cria colunas para cada informação do agendamento
        var colunaPaciente = document.createElement("td");
        var colunaDentista = document.createElement("td");
        var colunaData = document.createElement("td");
        var colunaHora = document.createElement("td");
        var colunaBotao = document.createElement("td");
        var botao = document.createElement("button");

        // Preenche as colunas com os dados do agendamento
        colunaPaciente.textContent = element.paciente;
        colunaDentista.textContent = element.dentista;
        colunaData.textContent = element.data;
        colunaHora.textContent = element.hora;

        // Configura o botão de finalizar consulta
        botao.textContent = "Finalizar";
        botao.addEventListener("click", function () {
          document.getElementById("id_agendamento").value = element.id;
          document.getElementById("modal-atendimento").style.display = "block";
        });

        colunaBotao.appendChild(botao);

        linha.append(
          colunaPaciente,
          colunaDentista,
          colunaData,
          colunaHora,
          colunaBotao
        );

        tabela.appendChild(linha);
      });
    }

    // Inicializa o array de eventos para o calendário
    var eventos = [];

    // Adiciona eventos ao array caso existam agendamentos
    if (data.length > 0) {
      data.forEach((element) => {
        const startDateTime = new Date(element.data + "T" + element.hora);
        const endDateTime = new Date(startDateTime.getTime() + 30 * 60000);

        eventos.push({
          id: element.id,
          title: element.paciente + " - " + element.dentista,
          start: startDateTime.toISOString(),
          end: endDateTime.toISOString(),
          extendedProps: {
            paciente_id: element.paciente_id,
            dentista_id: element.dentista_id,
          },
          backgroundColor: "#007BFF",
          borderColor: "#007BFF",
          textColor: "white",
        });
      });
    }

    // Cria uma instância do calendário FullCalendar
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: "dayGridMonth",
      locale: "pt-br",

      dateClick: function (info) {
        const clickedDate = info.dateStr;

        // Verifica se há conflito de horários
        const isConflict = eventos.some((evento) => {
          return evento.start.startsWith(clickedDate);
        });

        if (isConflict) {
          alert("Já existe um agendamento para este horário.");
          return;
        }

        var modal = document.getElementById("modal-consulta");
        var formDateInput = document.getElementById("data_consulta");
        modal.style.display = "block";
        formDateInput.value = info.dateStr;
        document.getElementById("id_agendamento").value = "";
      },

      eventClick: function (info) {
        var modal = document.getElementById("modal-consulta");
        var formDateInput = document.getElementById("data_consulta");
        modal.style.display = "block";
        formDateInput.value = info.event.startStr.split("T")[0];
        document.getElementById("id_agendamento").value = info.event.id;
        document.getElementById("nome_paciente").value =
          info.event.extendedProps.paciente_id;
        document.getElementById("dentista_id").value =
          info.event.extendedProps.dentista_id;
        document.getElementById("horario_consulta").value =
          info.event.startStr.split("T")[1];
      },

      events: eventos,
    });

    calendar.render();
  })
  .catch((error) => {
    console.error("Erro ao carregar agendamentos:", error);
    var tabela = document.getElementById("corpo-tabela");
    if (tabela.innerHTML === "") {
      var linha = document.createElement("tr");
      var coluna = document.createElement("td");
      coluna.setAttribute("colspan", 5);
      coluna.textContent =
        "Erro ao carregar agendamentos. Por favor, tente novamente.";
      linha.appendChild(coluna);
      tabela.appendChild(linha);
    }
  });

// Funções auxiliares
function closeModal() {
  document.getElementById("modal-atendimento").style.display = "none";
}

document.getElementById("fechar-modal").addEventListener("click", closeModal);

window.addEventListener("click", function (event) {
  var modal = document.getElementById("modal-atendimento");
  if (event.target == modal) {
    closeModal();
  }
});

document
  .getElementById("form-atendimento")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    var formData = new FormData(this);

    fetch("salvar_atendimento.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((data) => {
        alert(data);
        location.reload();
      });
  });

document.getElementById("deletar").addEventListener("click", function () {
  var idAgendamento = document.getElementById("id_agendamento").value;
  if (idAgendamento) {
    fetch("deletar_agendamento.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "id=" + idAgendamento,
    })
      .then((response) => response.text())
      .then((data) => {
        alert(data);
        location.reload();
      });
  }
});
