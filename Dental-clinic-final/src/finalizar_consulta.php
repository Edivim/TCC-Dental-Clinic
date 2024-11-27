<?php
include 'db.php'; // Inclui o arquivo de conexão

// Captura o ID do agendamento enviado via POST
$agendamento_id = $_POST['id'];

// Atualiza o status do agendamento para "finalizado"
$sql = "UPDATE agendamentos SET status = 'finalizado' WHERE id = $agendamento_id";

if ($conn->query($sql) === TRUE) {
  echo "Consulta finalizada com sucesso!";
} else {
  echo "Erro: " . $sql . "<br>" . $conn->error;
}

// Fecha a conexão com o banco de dados
$conn->close();