<?php
// Inclui o arquivo de conexão se o mock não estiver definido
if (!isset($conn)) {
  include 'db.php';
}

// Recuperar todos os pacientes
$pacientes = $conn->query("SELECT id, nome FROM pacientes");

// Recuperar todos os dentistas
$dentistas = $conn->query("SELECT id, nome FROM dentistas");

// Cria arrays para armazenar os dados
$pacientesArray = array();
$dentistasArray = array();

// Popula os arrays com os dados do banco de dados
while ($paciente = $pacientes->fetch_assoc()) {
  $pacientesArray[] = $paciente;
}

while ($dentista = $dentistas->fetch_assoc()) {
  $dentistasArray[] = $dentista;
}

// Retorna os dados em formato JSON
echo json_encode(array('pacientes' => $pacientesArray, 'dentistas' => $dentistasArray));
