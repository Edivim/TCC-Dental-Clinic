<?php

/*include 'db.php'; // Inclui o arquivo de conexão

// Captura os dados enviados via POST
$paciente_id = $_POST['paciente_id'];
$dentista_id = $_POST['dentista_id'];
$data = $_POST['data'];
$hora = $_POST['hora'];

// Verifica se já existe um agendamento para o mesmo dentista, data e hora
$sqlVerifica = "SELECT id FROM agendamentos 
                WHERE dentista_id = '$dentista_id' 
                AND data = '$data' 
                AND hora = '$hora'";

$resultVerifica = $conn->query($sqlVerifica);

if ($resultVerifica->num_rows > 0) {
  echo "Erro: Já existe um agendamento para este dentista no mesmo horário.";
} else {
  // Insere o agendamento no banco de dados
  $sql = "INSERT INTO agendamentos (paciente_id, dentista_id, data, hora) 
            VALUES ('$paciente_id', '$dentista_id', '$data', '$hora')";

  if ($conn->query($sql) === TRUE) {
    echo "Agendamento criado com sucesso!";
  } else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
  }
}

// Fecha a conexão com o banco de dados
$conn->close();
*/