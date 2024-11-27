<?php
include 'db.php'; // Inclui o arquivo de conexão

// Captura os dados enviados via POST
$idAgendamento = isset($_POST['id_agendamento']) ? $_POST['id_agendamento'] : null;
$idPaciente = $_POST['nome_paciente'];
$idDentista = $_POST['dentista_id'];
$data = $_POST['data_consulta'];
$hora = $_POST['horario_consulta'];

// Converte a data e hora em um formato datetime
$datetimeConsulta = $data . ' ' . $hora;

// Consulta para verificar conflitos com intervalo de 30 minutos para o mesmo dentista
$sqlVerifica = "
    SELECT id 
    FROM agendamentos 
    WHERE dentista_id = ? 
    AND (
        TIMESTAMPDIFF(MINUTE, ?, CONCAT(data, ' ', hora)) BETWEEN -29 AND 29
    )
";

// Caso seja uma edição, exclui o próprio ID da validação
if ($idAgendamento) {
  $sqlVerifica .= " AND id != ?";
}

$stmtVerifica = $conn->prepare($sqlVerifica);
if ($idAgendamento) {
  $stmtVerifica->bind_param("isi", $idDentista, $datetimeConsulta, $idAgendamento);
} else {
  $stmtVerifica->bind_param("is", $idDentista, $datetimeConsulta);
}

$stmtVerifica->execute();
$resultVerifica = $stmtVerifica->get_result();

if ($resultVerifica->num_rows > 0) {
  echo "Já existe um agendamento para este dentista no mesmo horário ou em um intervalo de 30 minutos.";
} else {
  if ($idAgendamento) {
    // Atualiza um agendamento existente
    $sql = "UPDATE agendamentos 
                SET paciente_id = ?, dentista_id = ?, data = ?, hora = ? 
                WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissi", $idPaciente, $idDentista, $data, $hora, $idAgendamento);
  } else {
    // Insere um novo agendamento
    $sql = "INSERT INTO agendamentos (paciente_id, dentista_id, data, hora) 
                VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiss", $idPaciente, $idDentista, $data, $hora);
  }

  if ($stmt->execute()) {
    echo "Agendamento salvo com sucesso!";
    header("refresh:3;url=agenda.html");
  } else {
    echo "Erro: " . $stmt->error;
  }

  $stmt->close();
}

$stmtVerifica->close();
$conn->close();
