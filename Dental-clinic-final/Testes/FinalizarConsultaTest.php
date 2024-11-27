<?php

use PHPUnit\Framework\TestCase;

class FinalizarConsultaTest extends TestCase
{
  private $db;

  protected function setUp(): void
  {
    // Configurar o mock do banco de dados
    $this->db = $this->createMock(mysqli::class);

    // Configurar o retorno esperado para a atualização de status
    $this->db->method('query')->willReturnCallback(function ($sql) {
      if (strpos($sql, 'UPDATE agendamentos') !== false) {
        return true;
      }
      return false;
    });
  }

  public function testFinalizarConsulta()
  {
    $_POST['id'] = 1;

    // Incluir o script a ser testado
    ob_start();
    include __DIR__ . '/../src/finalizar_consulta.php';
    $output = ob_get_clean();

    // Verificar se a saída está correta
    $this->assertStringContainsString('Consulta finalizada com sucesso!', $output);
  }
}
