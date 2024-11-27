<?php
include 'db.php'; // Inclui o arquivo de conexão global

// Captura o ID do agendamento enviado via POST
$agendamento_id = $_POST['id'];

// Deleta o agendamento do banco de dados
$sql = "DELETE FROM agendamentos WHERE id = $agendamento_id";

if ($GLOBALS['conn']->query($sql) === TRUE) {
  echo "Agendamento cancelado com sucesso!";
} else {
  echo "Erro ao cancelar agendamento: " . $GLOBALS['conn']->error;
}

// Fecha a conexão com o banco de dados
$GLOBALS['conn']->close();
