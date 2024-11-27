<?php

use PHPUnit\Framework\TestCase;

class ConsultaDadosTest extends TestCase
{
  private $conn;

  protected function setUp(): void
  {
    // Mock da conexão mysqli
    $this->conn = $this->createMock(mysqli::class);

    // Dados simulados
    $mockPacientesData = [
      ['id' => 1, 'nome' => 'João Silva'],
      ['id' => 2, 'nome' => 'Maria Oliveira']
    ];

    $mockDentistasData = [
      ['id' => 1, 'nome' => 'Dr. Marcos'],
      ['id' => 2, 'nome' => 'Dra. Ana']
    ];

    // Classe anônima para simular resultados de consulta
    $mockResultPacientes = new class($mockPacientesData) {
      private $data;
      private $index = 0;

      public function __construct($data)
      {
        $this->data = $data;
      }

      public function fetch_assoc()
      {
        if ($this->index < count($this->data)) {
          return $this->data[$this->index++];
        }
        return null;
      }

      public function num_rows()
      {
        return count($this->data);
      }
    };

    $mockResultDentistas = new class($mockDentistasData) {
      private $data;
      private $index = 0;

      public function __construct($data)
      {
        $this->data = $data;
      }

      public function fetch_assoc()
      {
        if ($this->index < count($this->data)) {
          return $this->data[$this->index++];
        }
        return null;
      }

      public function num_rows()
      {
        return count($this->data);
      }
    };

    // Configurar o mock da conexão para retornar os resultados simulados
    $this->conn->method('query')
      ->will($this->returnValueMap([
        ['SELECT id, nome FROM pacientes', $mockResultPacientes],
        ['SELECT id, nome FROM dentistas', $mockResultDentistas]
      ]));

    // Substituir a conexão real pelo mock globalmente
    $GLOBALS['conn'] = $this->conn;
  }

  public function testConsultaDados()
  {
    // Redirecionar a saída para um buffer
    ob_start();
    include __DIR__ . '/../src/consulta_dados.php';
    $output = ob_get_clean();

    // Decodificar a resposta JSON
    $response = json_decode($output, true);

    // Verificar se a saída está correta
    $this->assertNotEmpty($response);
    $this->assertArrayHasKey('pacientes', $response);
    $this->assertArrayHasKey('dentistas', $response);

    // Verificar os dados dos pacientes
    $this->assertCount(2, $response['pacientes']);
    $this->assertEquals('João Silva', $response['pacientes'][0]['nome']);
    $this->assertEquals('Maria Oliveira', $response['pacientes'][1]['nome']);

    // Verificar os dados dos dentistas
    $this->assertCount(2, $response['dentistas']);
    $this->assertEquals('Dr. Marcos', $response['dentistas'][0]['nome']);
    $this->assertEquals('Dra. Ana', $response['dentistas'][1]['nome']);
  }
}
