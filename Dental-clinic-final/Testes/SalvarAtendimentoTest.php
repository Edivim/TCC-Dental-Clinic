<?php

use PHPUnit\Framework\TestCase;

class SalvarAtendimentoTest extends TestCase
{
  private $db;

  protected function setUp(): void
  {
    // Configurar o mock do banco de dados
    $this->db = $this->createMock(mysqli::class);

    // Configurar o retorno esperado para a consulta de inserção
    $this->db->method('query')->willReturnCallback(function ($sql) {
      if (strpos($sql, 'INSERT INTO atendimentos') !== false) {
        return true;
      } elseif (strpos($sql, 'UPDATE agendamentos') !== false) {
        return true;
      }
      return false;
    });
  }

  public function testSalvarAtendimento()
  {
    $_POST['id_agendamento'] = 1;
    $_POST['procedimentos'] = 'Limpeza';
    $_POST['prescricoes'] = 'Antibiótico';
    $_POST['recomendacoes'] = 'Voltar em uma semana';

    // Incluir o script a ser testado
    ob_start();
    include __DIR__ . '/../src/salvar_atendimento.php';
    $output = ob_get_clean();

    // Verificar se a saída está correta
    $this->assertStringContainsString('Atendimento registrado com sucesso!', $output);
  }
}
