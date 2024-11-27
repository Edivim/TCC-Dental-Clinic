<?php
include 'db.php'; // Inclui o arquivo de conexão

// Captura os dados enviados via POST
$idAgendamento = $_POST['id_agendamento'];
$procedimentos = $_POST['procedimentos'];
$prescricoes = $_POST['prescricoes'];
$recomendacoes = $_POST['recomendacoes'];

// Insere os dados do atendimento no banco de dados
$sql = "INSERT INTO atendimentos (agendamento_id, procedimentos, prescricoes, recomendacoes) VALUES ('$idAgendamento', '$procedimentos', '$prescricoes', '$recomendacoes')";

if ($conn->query($sql) === TRUE) {
  echo "Atendimento registrado com sucesso!";
} else {
  echo "Erro: " . $sql . "<br>" . $conn->error;
}

// Atualiza o status do agendamento para finalizado
$sql = "UPDATE agendamentos SET status = 'finalizado' WHERE id = $idAgendamento";
$conn->query($sql); // Executa a atualização

// Fecha a conexão com o banco de dados
$conn->close();
