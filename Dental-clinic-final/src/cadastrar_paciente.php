<?php
include 'db.php'; // Inclui o arquivo de conexão

// Captura os dados enviados via POST
$nome = $_POST['nome'];
$idade = $_POST['idade'];
$sexo = $_POST['sexo'];
$historico_medico = $_POST['historico_medico'];
$endereco = $_POST['endereco'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];

// Insere os dados no banco de dados
$sql = "INSERT INTO pacientes (nome, idade, sexo, historico_medico, endereco, telefone, email) 
        VALUES ('$nome', $idade, '$sexo', '$historico_medico', '$endereco', '$telefone', '$email')";

// Verifica se a inserção foi bem-sucedida e exibe uma mensagem de sucesso ou erro
if ($conn->query($sql) === TRUE) {
  echo "Paciente cadastrado com sucesso!";
  // Redireciona de volta à página de cadastro após 3 segundos
  header("refresh:3;url=cadastro.html");
} else {
  echo "Erro: " . $sql . "<br>" . $conn->error;
}

// Fecha a conexão com o banco de dados
$conn->close();
