<?php
include 'db.php'; // Inclui o arquivo de conexão

// Captura os dados enviados via POST
$nome = $_POST['nome'];
$idade = $_POST['idade'];
$sexo = $_POST['sexo'];
$especialidade = $_POST['especialidade'];
$endereco = $_POST['endereco'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];

// Insere os dados no banco de dados
$sql = "INSERT INTO dentistas (nome, idade, sexo, especialidade, endereco, telefone, email) 
            VALUES ('$nome', $idade, '$sexo', '$especialidade', '$endereco', '$telefone', '$email')";

if ($conn->query($sql) === TRUE) {
  echo "Dentista cadastrado com sucesso!";
  // Redireciona de volta à página de cadastro após 3 segundos
  header("refresh:3;url=dentista.html");
} else {
  echo "Erro: " . $sql . "<br>" . $conn->error;
}


// Fecha a conexão com o banco de dados
$conn->close();
