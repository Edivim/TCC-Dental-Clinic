<?php
require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class CadastrarPacienteTest extends TestCase
{
  private $conn;

  protected function setUp(): void
  {
    // Configuração da conexão com o banco de dados para os testes
    $this->conn = new mysqli('localhost', 'root', '', 'dental_clinic');
    // Verifica se a conexão foi bem-sucedida
    if ($this->conn->connect_error) {
      die("Falha na conexão: " . $this->conn->connect_error);
    }
  }

  protected function tearDown(): void
  {
    // Limpeza dos dados de teste após a execução de cada teste
    $this->conn->query("DELETE FROM pacientes WHERE nome='Test Paciente'");
    $this->conn->close();
  }

  public function testCadastrarPaciente()
  {
    // Dados do paciente de teste
    $_POST['nome'] = 'Test Paciente';
    $_POST['idade'] = 30;
    $_POST['sexo'] = 'M';
    $_POST['historico_medico'] = 'Sem histórico médico';
    $_POST['endereco'] = 'Endereço Teste';
    $_POST['telefone'] = '123456789';
    $_POST['email'] = 'teste@teste.com';

    // Inclui o arquivo que contém a lógica do cadastro
    require_once __DIR__ . '/../src/cadastrar_paciente.php';

    // Verifica se o paciente foi cadastrado com sucesso
    $result = $this->conn->query("SELECT * FROM pacientes WHERE nome='Test Paciente'");
    $this->assertEquals(1, $result->num_rows);
  }
}