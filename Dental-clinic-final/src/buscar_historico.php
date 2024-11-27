<?php
include 'db.php'; // Inclui o arquivo de conexão

// Define o cabeçalho da resposta como JSON
header('Content-Type: application/json');

$response = array();

// Obtém os parâmetros enviados pela requisição
$data = $_GET['data'] ?? null;
$paciente = $_GET['paciente'] ?? null;
$dentista = $_GET['dentista'] ?? null;

// Base da consulta SQL
$sql = "SELECT a.data, a.hora, p.nome AS paciente, d.nome AS dentista, at.procedimentos, at.prescricoes, at.recomendacoes
        FROM atendimentos at
        JOIN agendamentos a ON at.agendamento_id = a.id
        JOIN pacientes p ON a.paciente_id = p.id
        JOIN dentistas d ON a.dentista_id = d.id
        WHERE a.status = 'finalizado'";

// Adiciona filtros dinamicamente com base nos parâmetros
if ($data) {
  // Verifica se a data está no formato correto (yyyy-mm-dd)
  if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $data)) {
    $sql .= " AND a.data = '$data'";
  } else {
    $response['error'] = "Data inválida.";
    echo json_encode($response);
    exit;
  }
}

if ($paciente) {
  $sql .= " AND p.nome LIKE '%$paciente%'";
}

if ($dentista) {
  $sql .= " AND d.nome LIKE '%$dentista%'";
}

// Para debug, imprima a consulta gerada
//echo $sql; // Descomente esta linha para ver a consulta gerada

// Executa a consulta
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Adiciona cada atendimento ao array de resposta
  while ($row = $result->fetch_assoc()) {
    $response[] = array(
      'data' => $row['data'],
      'hora' => $row['hora'],
      'paciente' => $row['paciente'],
      'dentista' => $row['dentista'],
      'procedimentos' => $row['procedimentos'],
      'prescricoes' => $row['prescricoes'],
      'recomendacoes' => $row['recomendacoes']
    );
  }
} else {
  // Se nenhum dado for encontrado
  $response['error'] = "Nenhum atendimento encontrado com os filtros fornecidos.";
}

// Fecha a conexão com o banco de dados
$conn->close();

// Converte o array de resposta para JSON e imprime
echo json_encode($response);
