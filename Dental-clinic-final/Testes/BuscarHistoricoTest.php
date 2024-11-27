<?php

use PHPUnit\Framework\TestCase;

class BuscarHistoricoTest extends TestCase
{
  private $conn;
  private $stmt;

  protected function setUp(): void
  {
    $this->conn = $this->createMock(PDO::class);
    $this->stmt = $this->createMock(PDOStatement::class);

    $mockData = [
      [
        'data' => '2024-11-20',
        'hora' => '14:00',
        'paciente' => 'João Silva',
        'dentista' => 'Dr. Marcos',
        'procedimentos' => 'Limpeza',
        'prescricoes' => 'Nenhuma',
        'recomendacoes' => 'Escovar os dentes três vezes ao dia'
      ]
    ];

    $this->stmt->expects($this->any())
      ->method('fetch')
      ->willReturnOnConsecutiveCalls($mockData[0], false);
    $this->stmt->expects($this->any())
      ->method('rowCount')
      ->willReturn(count($mockData));

    $this->conn->method('query')->willReturn($this->stmt);

    // Substituir a conexão real pelo mock
    $GLOBALS['conn'] = $this->conn;
  }

  public function testBuscarHistorico()
  {
    require_once __DIR__ . '/../src/buscar_historico.php';

    $response = buscarHistorico($this->conn);

    $this->assertNotEmpty($response);
    $this->assertArrayHasKey('data', $response[0]);
    $this->assertArrayHasKey('hora', $response[0]);
    $this->assertArrayHasKey('paciente', $response[0]);
    $this->assertArrayHasKey('dentista', $response[0]);
    $this->assertArrayHasKey('procedimentos', $response[0]);
    $this->assertArrayHasKey('prescricoes', $response[0]);
    $this->assertArrayHasKey('recomendacoes', $response[0]);
  }
}
