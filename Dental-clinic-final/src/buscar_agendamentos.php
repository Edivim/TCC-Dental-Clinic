<?php
include 'db.php'; // Inclui o arquivo de conexão

// Define o cabeçalho da resposta como JSON
header('Content-Type: application/json');

$response = array();

// Consulta para buscar os agendamentos ativos
$sql = "SELECT a.id, a.data, a.hora, p.nome AS paciente, d.nome AS dentista, a.paciente_id, a.dentista_id
        FROM agendamentos a
        JOIN pacientes p ON a.paciente_id = p.id
        JOIN dentistas d ON a.dentista_id = d.id
        WHERE a.status = 'ativo'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Adiciona cada agendamento ao array de resposta
    while ($row = $result->fetch_assoc()) {
        $response[] = array(
            'id' => $row['id'],
            'data' => $row['data'],
            'hora' => $row['hora'],
            'paciente' => $row['paciente'],
            'dentista' => $row['dentista'],
            'paciente_id' => $row['paciente_id'],
            'dentista_id' => $row['dentista_id']
        );
    }
} else {
    $response['error'] = "Nenhum agendamento encontrado";
}

// Fecha a conexão com o banco de dados
$conn->close();

// Converte o array de resposta para JSON e imprime
echo json_encode($response);
