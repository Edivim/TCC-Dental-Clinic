<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dental_clinic";

// Conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
  die("Conexão falhou: " . $conn->connect_error);
}
