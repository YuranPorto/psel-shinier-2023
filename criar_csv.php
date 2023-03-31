<?php 
  include __DIR__.'/include/CSV.php';
  include __DIR__.'/include/Database.php';

  $obDatabase = new Database;
  $obDatabase-> setConnection();

  $query = file_get_contents(__DIR__.'/SQL/DB');

  $statement = $obDatabase->execute($query);
  $resultados = $statement->FetchAll(PDO::FETCH_ASSOC);

  // ARRAY QUE IRA GERAR O CORPO DO CSV
  $corpoCsv = array();

  // Itera cada item da tabalea, e adiciona em um array na variavel corpoCsv
  foreach ($resultados as $resultado){
    $pegarDados = [
      '',
      $resultado['NOME'],
      $resultado['DOCUMENTO'],
      'Dinheiro',
      $resultado['A_PAGAR'],
      $resultado['PAGO'],
      $resultado['DATA_LANCAMENTO'],
      $resultado['VENCIMENTO'],
      $resultado['CONFIRMA_PAGAMENTO'],
      $resultado['DT_RECEBIDO']
    ];

      $corpoCsv[] = $pegarDados;
  }

  $cabecalhoCsv = $cabecalhoCsv = [
    'Nome da clinica',
    'Nome do paciente',
    'Descricao do lancamento',
    'Forma de pagamento',
    'Valor a pagar',
    'Valor pago',
    'Data de criacao do lancamento',
    'Data de vencimento',
    'Data de confirmacao do pagamento',
    'Data de recebimento'
  ];

  // Junta os dados do cabeçalho, com os dados do banco:
  $dados = array_merge(array($cabecalhoCsv), $corpoCsv);

  $sucesso = CSV::criarCsv(__DIR__.'/files/financeiro.csv', $dados, ';');
?>