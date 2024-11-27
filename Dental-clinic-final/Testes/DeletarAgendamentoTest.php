<?php

use PHPUnit\Framework\TestCase;

class DeletarAgendamentoTest extends TestCase
{
  private $db;

  protected function setUp(): void
  {
    // Configurar o mock do banco de dados
    $this->db = $this->createMock(mysqli::class);

    // Configurar o retorno esperado para a consulta de deleção
    $this->db->method('query')->willReturn(true);

    // Substituir a conexão real pelo mock
    $GLOBALS['conn'] = $this->db;
  }

  public function testDeletarAgendamento()
  {
    $_POST['id'] = 1;

    // Incluir o script a ser testado
    ob_start();
    include __DIR__ . '/../src/deletar_agendamento.php';
    $output = ob_get_clean();

    // Verificar se a saída está correta
    $this->assertStringContainsString('Agendamento cancelado com sucesso!', $output);
  }

  protected function tearDown(): void
  {
    // Limpar a variável global após o teste
    unset($GLOBALS['conn']);
  }
}
